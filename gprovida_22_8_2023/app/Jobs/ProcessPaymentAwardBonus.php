<?php

namespace App\Jobs;

use App\Mail\AwardEarned;
use App\Models\Award;
use App\Models\Currency;
use App\Models\PaymentAward;
use App\Models\PaymentJobLog;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ProcessPaymentAwardBonus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private int $qualifiedUsers;
    private $awards;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->qualifiedUsers=0;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $start_time = date('H:i:s');
        $from = date('Y-m-d H:i:s', strtotime('0:00 first day of last month'));
        $to = date('Y-m-d H:i:s', strtotime('23:59 last day of last month'));

        // get the lowest award pv
        $awards = Award::get(['id','name','pv','cash_equivalent','rank','rank_image'])->sortBy('pv')->toArray();
        $this->awards = $awards;
        $lowest_pv = $awards[0]['pv'];

        // Award --> User must have met all the binary condition.
        $binary_packages = Setting::where('key','binary_bonus_packages')->first();
        $binaryPackageArray =array_filter(explode(',',trim($binary_packages->value)));


        User::where(DB::raw('award_pv_left + award_pv_right'),'>=',50) //lowest award pv $lowest_pv
            ->has('referred', '>=', 2)
            ->whereIn('package_id', $binaryPackageArray)
            ->orderBy('id')
            ->chunk(50, function($users) {
                foreach ($users as $user) { // start giving award
                    $award = $this->getAward($user->award_pv_left,$user->award_pv_right, $this->awards);
                    if(is_array($award)){
                        // check if user have received this award before
                        $previousAward = PaymentAward::where('user_id',$user->id)->where('award_id',$award['id'])->first();
                        if(!$previousAward){
                           $this->saveAwardPayment($user, $award);
                           $this->qualifiedUsers++;
                        }

                    }
                }
            });

        // record this job
        $joblog               = new PaymentJobLog();
        $joblog->job_name     = "ProcessPaymentAwardBonus";
        $joblog->date_from    = $from;
        $joblog->date_to      = $to;
        $joblog->no_of_payment_generated = $this->qualifiedUsers;
        $joblog->start_time   = $start_time;
        $joblog->end_time     = date('H:i:s');
        $joblog->save();
    }



    function getAward($left_pv,$right_pv, $awards) {
        if(($left_pv+$right_pv) < $awards[0]['pv']){  // lower than min
            return 0;
        }


        $index = count($awards)-1;
        for($i=$index; $i>-1; $i-- ){
            if(($left_pv+$right_pv) >= 1.2*($awards[$i]['pv']) ){ // left and right is 120% or award pv
                return $awards[$i];
            }
            elseif( ($left_pv >= 0.5*($awards[$i]['pv'])) && ($right_pv >= 0.5*($awards[$i]['pv'])) )
            {
                return $awards[$i];
            }else{

            }
        }
        return 0; // out of range
    }


    function saveAwardPayment($user, Array $award){
        $usersAward = new PaymentAward();
        $usersAward->user_id          = $user->id;
        $usersAward->current_pv_used  = $user->cumulative_binary_pv;

        $usersAward->award_id         = $award['id'];
        $usersAward->award_name       = $award['name'];
        $usersAward->cash_equivalent  = $award['cash_equivalent'];
        $usersAward->currency_id      = $user->currency_id;

        $usersAward->status           = "pending";
        $usersAward->description      = "Award earned for activities up to ".date('F, Y', strtotime('last month'));;
        $usersAward->date_time_to_pay = date('Y-m-d H:i:s', strtotime('today 23:50'));
        $usersAward->save();

        // notify user
        Mail::to($user)->send(new AwardEarned($user,$award, $usersAward));

    }

}

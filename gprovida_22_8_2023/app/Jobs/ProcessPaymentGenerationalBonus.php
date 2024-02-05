<?php

namespace App\Jobs;

use App\Models\Currency;
use App\Models\PaymentJobLog;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;

class ProcessPaymentGenerationalBonus //implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $current_binary_pv;
    public $counter;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $start_time = date('H:i:s');
        $from       = date('Y-m-d H:i:s', strtotime('0:00 first day of last month'));
        $to         = date('Y-m-d H:i:s', strtotime('23:59 last day of last month'));

        $generational_bonus = Setting::where('key','generational_bonus_percentage')->first();
        $generational_bonus_percentage =  $generational_bonus->value;

        $loyalty_bonus = Setting::where('key','loyalty_bonus_percentage')->first();
        $loyalty_bonus_percentage =  $loyalty_bonus->value;

        // conditions
        $generational_bonus = Setting::where('key','generational_bonus_min_pv')->first();
        $generational_bonus_min_pv =  $generational_bonus->value;


        // get qualified users
        $qualifiedUsers = User::with(['currency','referredIds.referredIds.referredIds.referredIds.referredIds.referredIds.referredIds.referredIds.referredIds.referredIds'])
            //->where('current_direct_pv','>=',$generational_bonus_min_pv)
            //->has('referred')
            ->has('referredIds')
            ->get(['id','username','referred_by','currency_id','current_binary_pv']);

        foreach ($qualifiedUsers as $user){


            echo "<pre>";
            //print_r(Arr::dot($user->toArray()));
            //print_r($user->toArray());
            print_r(collect($user->toArray())->flatten(1));
            echo "</pre>";

            dd("here");

            echo "user: ----".$user->id." <br/>";
            $this->current_binary_pv=0;
            $this->getReferredPV($user->referredIds);

            /*
            //echo "-[".count($user->referredIds)."] <br/> ";
            $referrals = $user->referredIds;
            $this->current_binary_pv=0;
            foreach($referrals as $referral){
                echo "--<br/>";
                $this->counter=0;
                $this->getReferredPV($referral);
                //echo "<br/><br/>";
            }
            */
            echo ",  total ref PV: ".$this->current_binary_pv."<br/>";
            dd($qualifiedUsers[0]);
        }

        dd($qualifiedUsers[0]->referredIds->flatten());

        /*
         * dd($products);
        $products->values()->all();

        dd($products[0]->referred[0]);

        $referralCount =0;
        foreach ($qualifiedUsers as $user){
            dd($user);
            echo "Downline Count: ".count($user->referred)." <br/>";
//            if($user->referred->referred){
//                $secondGen = $user->referred->referred;
//                echo " Second Generation: ".count($secondGen);
//            }
            echo " <br/>";
            $referralCount +=count($user->referred);
        }

        echo "total: ".$referralCount;

        dd($qualifiedUsers);

        foreach ($qualifiedUsers as $key => $roundOne){
            //if(count($roundOne->referredLastMonth) <$global_bonus_sponsor+0){
                $qualifiedUsers->forget($key);
            //}
        }




        // record this job
        $joblog               = new PaymentJobLog();
        $joblog->job_name     = "ProcessPaymentGenerationalBonus";
        $joblog->date_from    = $from;
        $joblog->date_to      = $to;
        $joblog->no_of_payment_generated = count($qualifiedUsers);
        $joblog->start_time   = $start_time;
        $joblog->end_time     = date('H:i:s');
        $joblog->save();

        */
    }

    public function getReferredPV($referrals){
        $markup ="";
        foreach ($referrals as $key => $referral){
            $this->current_binary_pv += $referral->current_binary_pv;
            if(count($referral->referredIds)>0){
                $this->getReferredPV($referral->referredIds);
                $markup .="<li>[".$key."] ".$referral->username." </li>";
                $markup .="<ul>".$markup."</ul>";
            }else{
                $markup .="<li>[".$key."] ".$referral->username."</li>";
            }
        }

        echo "<ul>".$markup."</ul>";
    }


    public function getReferredPVOld(User $referral){
        $markup='';

        $this->current_binary_pv += $referral->current_binary_pv;
        if(count($referral->referredIds)>0){
            foreach ($referral->referredIds as $referral){
                $this->getReferredPV($referral);
            }

        }


        //$pv +=  $this->getReferredPV($referral);
    }
}

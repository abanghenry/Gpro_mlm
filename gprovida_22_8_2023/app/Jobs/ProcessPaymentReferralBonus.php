<?php

namespace App\Jobs;

use App\Helpers\Helper;
use App\Models\BonusReferral;
use App\Models\Payment;
use App\Models\PaymentJobLog;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessPaymentReferralBonus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
        //$from = date('Y-m-d H:i:s', strtotime('0:00 first day of last month'));
        //$to = date('Y-m-d H:i:s', strtotime('23:59 last day of last month'));
        $from = date('Y-m-d H:i:s');
        $to = date('Y-m-d H:i:s', strtotime('today 23:50'));

        $loyalty_bonus = Setting::where('key','loyalty_bonus_percentage')->first();
        $loyalty_bonus_percentage =  $loyalty_bonus->value;

        $referralBonus = BonusReferral::where('status',0)
                                ->where(function ($query) {
                                    $query->where('source', 'referral')
                                        ->orWhere('source', 'referral_stockist')
                                        ->orWhere('source', 'upgrade');
                                })
                            ->get()
                            ->groupBy('user_id');
        foreach ($referralBonus as $userID =>$bonuses){
            $user = User::find($userID);
            $payment = new Payment();
            $payment->user_id = $userID;
            $payment->description = "Payment for Referral/stockist Referral/upgrade bonus ";
            $payment->amount = 0;
            $payment->currency_id = $user->currency_id;
            $payment->bonus_type = "referral";
            $payment->status   ="pending";
            $payment->date_time_to_pay = date('Y-m-d H:i:s', strtotime('today 23:50'));
            $payment->save();
            $amount =0;
            foreach ($bonuses as $bonus){
                $amount += $bonus->amount;
                $bonus->status     = 1;
                $bonus->payment_id = $payment->id;
                $bonus->save();
            }

            // reserve some for loyalty bonus
            $loyalty_bonus =$amount*($loyalty_bonus_percentage/100);
            $amount = $amount-$loyalty_bonus;

            $payment->amount = $amount;
            $payment->save();

            $details = "Loyalty Referral bonus from User :".$user->username;
            Helper::saveLoyaltyBonus($user,$loyalty_bonus, 'referral', $details);

        }
        // record this job only if the is payment
        if(count($referralBonus)>0){
            $joblog               = new PaymentJobLog();
            $joblog->job_name     = "ProcessPaymentReferralBonus";
            $joblog->date_from    = $from;
            $joblog->date_to      = $to;
            $joblog->no_of_payment_generated = count($referralBonus);
            $joblog->start_time   = $start_time;
            $joblog->end_time     = date('H:i:s');
            $joblog->save();
        }


    }
}

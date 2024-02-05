<?php

namespace App\Jobs;

use App\Helpers\Helper;
use App\Models\BonusLoyalty;
use App\Models\Payment;
use App\Models\PaymentJobLog;
use App\Models\Setting;
use App\Models\Store;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ProcessPaymentRepurchaseBonus implements ShouldQueue, ShouldBeUnique
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
        $from = date('Y-m-d H:i:s', strtotime('0:00 first day of last month'));
        $to = date('Y-m-d H:i:s', strtotime('23:59 last day of last month'));
        // last month referral
        $direct_purchase_bonus = Setting::where('key','direct_purchase_bonus_percentage')->first();
        $direct_purchase_bonus_percentage =  $direct_purchase_bonus->value;

        $direct_activation = Setting::where('key','direct_purchase_monthly_activation_pv')->first();
        $direct_activation_pv =  floatval($direct_activation->value);



        $loyalty_bonus = Setting::where('key','loyalty_bonus_percentage')->first();
        $loyalty_bonus_percentage =  $loyalty_bonus->value;

        $qualifiedUsers = User::with('currency')->where('current_direct_pv','>=',$direct_activation_pv)->get();

        $number_of_payments =0;


        foreach ($qualifiedUsers as $qualifiedUser){
            $excess_pv = $qualifiedUser->current_direct_pv-$direct_activation_pv;
            $earned_bonus_pv =$excess_pv*($direct_purchase_bonus_percentage/100);
            $earned_bonus_cash=$earned_bonus_pv*$qualifiedUser->currency->pv_rate;

            // reserve some for loyalty bonus
            if($earned_bonus_cash>0){
                $loyalty_bonus =$earned_bonus_cash*($loyalty_bonus_percentage/100);
                $earned_bonus_cash = $earned_bonus_cash-$loyalty_bonus;

                $payment = new Payment();
                $payment->user_id = $qualifiedUser->id;
                $payment->description = "Direct Purchase bonus from: ".$from." to: ".$to;
                $payment->amount = $earned_bonus_cash;
                $payment->currency_id = $qualifiedUser->currency_id;
                $payment->bonus_type = "direct";
                $payment->status   ="pending";
                $payment->date_time_to_pay = date('Y-m-d H:i:s', strtotime('today 23:50'));
                $payment->save();

                $details = "Loyalty Direct Purchase bonus from User :".$qualifiedUser->username;
                Helper::saveLoyaltyBonus($qualifiedUser,$loyalty_bonus, 'direct_purchase', $details);

                $number_of_payments++;
            }



        }


        // record this job
        $joblog               = new PaymentJobLog();
        $joblog->job_name     = "ProcessPaymentRepurchaseBonus";
        $joblog->date_from    = $from;
        $joblog->date_to      = $to;
        $joblog->no_of_payment_generated = $number_of_payments;
        //$joblog->no_of_payment_generated = count($qualifiedUsers);
        $joblog->start_time   = $start_time;
        $joblog->end_time     = date('H:i:s');
        $joblog->save();

    }



}

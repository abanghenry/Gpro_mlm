<?php

namespace App\Jobs;

use App\Helpers\Helper;
use App\Models\Currency;
use App\Models\Order;
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

class ProcessPaymentSpecialBonus implements ShouldQueue,ShouldBeUnique
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
        $loyalty_bonus = Setting::where('key','loyalty_bonus_percentage')->first();
        $loyalty_bonus_percentage =  $loyalty_bonus->value;


        $start_time = date('H:i:s');
        $from = date('Y-m-d H:i:s', strtotime('0:00 first day of last month'));
        $to = date('Y-m-d H:i:s', strtotime('23:59 last day of last month'));
        // last month referral
        $nairaCurrency = Currency::where('code','NGN')->first();

        $monthOrder = Order::with('currency','items')->where('special_paid',0)
            ->where('status_order','shipped') //or processing?
            ->whereBetween('created_at', [$from, $to]) // todo problem with updated_at against created_at
            ->get();
        $total_special_count = 0;



        foreach ($monthOrder as $order){
          foreach ($order->items as $item){
              $total_special_count += $item->qty;
          }
            $order->special_paid =1;
            $order->save();
        }



        $totalAmountToShare = $total_special_count*300; // total count of items * 300
        $amountForDirectors = $totalAmountToShare*(0.5);
        $amountForLeaders   = $totalAmountToShare*(0.2);
        $amountForAdmin     = $totalAmountToShare*(0.3);

        $qualifiedUsersDirectors = User::with('currency')->where('rank','director') ->get();
        $qualifiedUsersLeaders   = User::with('currency')->where('rank','leader') ->get();
        $qualifiedUsersAdmins    = User::with('currency')->where('rank','admin') ->get();


        $number_of_payments =0;

        if((count($qualifiedUsersDirectors)>0) && ($amountForDirectors>100) ){
            $amountPerUser = $amountForDirectors/count($qualifiedUsersDirectors);

            foreach ($qualifiedUsersDirectors as $qualifiedUser){
                $loyalty_bonus =$amountPerUser*($loyalty_bonus_percentage/100); // reserve some for loyalty bonus
                $earned_bonus_cash = $amountPerUser-$loyalty_bonus;
                $payment = new Payment();
                $payment->user_id = $qualifiedUser->id;
                $payment->description = "Special bonus from: ".$from." to: ".$to;
                $payment->amount =  Helper::convertToDifferentCurrency($earned_bonus_cash,$nairaCurrency, $qualifiedUser->currency);
                $payment->currency_id = $qualifiedUser->currency_id;
                $payment->bonus_type = "special";
                $payment->status   ="pending";
                $payment->date_time_to_pay = date('Y-m-d H:i:s', strtotime('today 23:50'));
                $payment->save();

                $loyalty_bonus_user_currency  =Helper::convertToDifferentCurrency($loyalty_bonus,$nairaCurrency, $qualifiedUser->currency);
                $details = "Loyalty of Special bonus from User :".$qualifiedUser->username;
                Helper::saveLoyaltyBonus($qualifiedUser,$loyalty_bonus_user_currency, 'special', $details);

                $number_of_payments++;
            }
        }
        if((count($qualifiedUsersLeaders)>0) && ($amountForLeaders>100) ){
            $amountPerUser = $amountForLeaders/count($qualifiedUsersLeaders);
            foreach ($qualifiedUsersLeaders as $qualifiedUser){
                $loyalty_bonus =$amountPerUser*($loyalty_bonus_percentage/100); // reserve some for loyalty bonus
                $earned_bonus_cash = $amountPerUser-$loyalty_bonus;
                $payment = new Payment();
                $payment->user_id = $qualifiedUser->id;
                $payment->description = "Special bonus from: ".$from." to: ".$to;
                $payment->amount =  Helper::convertToDifferentCurrency($earned_bonus_cash,$nairaCurrency, $qualifiedUser->currency);
                $payment->currency_id = $qualifiedUser->currency_id;
                $payment->bonus_type = "special";
                $payment->status   ="pending";
                $payment->date_time_to_pay = date("Y-m-d H:i:s");
                $payment->save();

                $loyalty_bonus_user_currency  =Helper::convertToDifferentCurrency($loyalty_bonus,$nairaCurrency, $qualifiedUser->currency);
                $details = "Loyalty of Special bonus from User :".$qualifiedUser->username;
                Helper::saveLoyaltyBonus($qualifiedUser,$loyalty_bonus_user_currency, 'special', $details);

                $number_of_payments++;
            }
        }

        if((count($qualifiedUsersAdmins)>0) && ($amountForAdmin>100) ){
            $amountPerUser = $amountForAdmin/count($qualifiedUsersAdmins);
            foreach ($qualifiedUsersAdmins as $qualifiedUser){
                $loyalty_bonus =$amountPerUser*($loyalty_bonus_percentage/100); // reserve some for loyalty bonus
                $earned_bonus_cash = $amountPerUser-$loyalty_bonus;
                $payment = new Payment();
                $payment->user_id = $qualifiedUser->id;
                $payment->description = "Special bonus from: ".$from." to: ".$to;
                $payment->amount =  Helper::convertToDifferentCurrency($earned_bonus_cash,$nairaCurrency, $qualifiedUser->currency);
                $payment->currency_id = $qualifiedUser->currency_id;
                $payment->bonus_type = "special";
                $payment->status   ="pending";
                $payment->date_time_to_pay = date("Y-m-d H:i:s");
                $payment->save();

                $loyalty_bonus_user_currency  =Helper::convertToDifferentCurrency($loyalty_bonus,$nairaCurrency, $qualifiedUser->currency);
                $details = "Loyalty of Special bonus from User :".$qualifiedUser->username;
                Helper::saveLoyaltyBonus($qualifiedUser,$loyalty_bonus_user_currency, 'special', $details);

                $number_of_payments++;
            }
        }




        // record this job
        $joblog               = new PaymentJobLog();
        $joblog->job_name     = "ProcessPaymentSpecialBonus";
        $joblog->date_from    = $from;
        $joblog->date_to      = $to;
        $joblog->no_of_payment_generated =  $number_of_payments++;
        //count($qualifiedUsersDirectors)+count($qualifiedUsersLeaders)+count($qualifiedUsersAdmins);
        $joblog->start_time   = $start_time;
        $joblog->end_time     = date('H:i:s');
        $joblog->save();
    }
}

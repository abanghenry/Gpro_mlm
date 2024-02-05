<?php

namespace App\Jobs;

use App\Helpers\Helper;
use App\Models\BonusLoyalty;
use App\Models\Order;
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

class ProcessPaymentLoyaltyBonus implements ShouldQueue
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

        $loyaltyBonus = BonusLoyalty::with('currency')->where('status',0)
            ->whereBetween('created_at', [$from, $to])
            ->get()
            ->groupBy('user_id');

        foreach ($loyaltyBonus as $userID =>$bonuses){
            $user = User::find($userID);
            $payment = new Payment();
            $payment->user_id = $userID;
            $payment->description = "Payment for loyalty bonus from: ".$from." to: ".$to;
            $payment->amount = 0;
            $payment->currency_id = $user->currency_id;
            $payment->bonus_type = "loyalty";
            $payment->status   ="pending";
            $payment->date_time_to_pay = date('Y-m-d H:i:s', strtotime('today 23:50'));
            $payment->save();
            $amount =0;
            foreach ($bonuses as $bonus){
                $amount += Helper::convertToDifferentCurrency($bonus->amount,$bonus->currency, $user->currency);
                $bonus->status     = 1;
                $bonus->payment_id = $payment->id;
                $bonus->save();
            }
            // convert amount to users currency
            $payment->amount =$amount;
            $payment->save();
        }

        // record this job only if the is payment
        $joblog               = new PaymentJobLog();
        $joblog->job_name     = "ProcessPaymentLoyaltyBonus";
        $joblog->date_from    = $from;
        $joblog->date_to      = $to;
        $joblog->no_of_payment_generated = count($loyaltyBonus);
        $joblog->start_time   = $start_time;
        $joblog->end_time     = date('H:i:s');
        $joblog->save();

    }
}

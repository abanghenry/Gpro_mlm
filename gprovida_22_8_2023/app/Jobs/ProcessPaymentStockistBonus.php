<?php

namespace App\Jobs;

use App\Helpers\Helper;
use App\Models\BonusLoyalty;
use App\Models\BonusReferral;
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

class ProcessPaymentStockistBonus implements ShouldQueue, ShouldBeUnique
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
        $stockist_bonus = Setting::where('key','stockist_bonus_percentage')->first();
        $stockist_bonus_percentage =  $stockist_bonus->value;

        $loyalty_bonus = Setting::where('key','loyalty_bonus_percentage')->first();
        $loyalty_bonus_percentage =  $loyalty_bonus->value;

        $stockistOrder = Order::with('currency')->where('stockist_paid',0)
                                ->where('status_order','shipped') //or processing?
                                ->whereBetween('created_at', [$from, $to])  //updated_at created_at should run first
                                ->get()
                                ->groupBy('store_id');


        foreach ($stockistOrder as $storeID =>$orders){
            $store = Store::with('managers')->find($storeID);
            $user = User::with('currency')->find($store->managers[0]->user_id);  // store first manager

            if($user){
                $sales_store_currency =0;
                foreach ($orders as $order){
                    $sales_store_currency += Helper::convertToDifferentCurrency($order->total_sales,$order->currency, $user->currency);
                    $order->stockist_paid     = 1;
                    $order->save();
                }
                $earned_bonus = $sales_store_currency *($stockist_bonus_percentage/100);
                $loyalty_bonus =$earned_bonus*($loyalty_bonus_percentage/100);
                $net_earned_bonus = $earned_bonus-$loyalty_bonus;


                $payment = new Payment();
                $payment->user_id = $user->id;
                $payment->description = "Stockist bonus for Store:".$store->name.", from: ".$from." to: ".$to;
                $payment->amount = 0;
                $payment->currency_id = $user->currency_id;
                $payment->bonus_type = "stockist";
                $payment->status   ="pending";
                $payment->date_time_to_pay = date('Y-m-d H:i:s', strtotime('today 23:50'));
                $payment->amount = $net_earned_bonus;
                $payment->save();

                $details = "Loyalty Stockist bonus for Store managed by :".$user->username;
                Helper::saveLoyaltyBonus($user,$loyalty_bonus, 'stockist', $details);

            }
        }

        // record this job
        $joblog               = new PaymentJobLog();
        $joblog->job_name     = "ProcessPaymentStockistBonus";
        $joblog->date_from    = $from;
        $joblog->date_to      = $to;
        $joblog->no_of_payment_generated = count($stockistOrder);
        $joblog->start_time   = $start_time;
        $joblog->end_time     = date('H:i:s');
        $joblog->save();
    }




}

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

class ProcessPaymentGlobalSalesBonus implements ShouldQueue, ShouldBeUnique
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
        $defaultCurrency = Currency::where('base',1)->first();

        $global_sales_bonus = Setting::where('key','global_sales_bonus_percentage')->first();
        $global_sales_bonus_percentage =  $global_sales_bonus->value;

        $global_registration_bonus = Setting::where('key','global_registration_bonus_percentage')->first();
        $global_registration_bonus_percentage =  $global_registration_bonus->value;

        $loyalty_bonus = Setting::where('key','loyalty_bonus_percentage')->first();
        $loyalty_bonus_percentage =  $loyalty_bonus->value;


        // conditions
        $global_bonus = Setting::where('key','global_bonus_packages')->first();
        $global_bonus_packages =  $global_bonus->value;
        $global_bonus = Setting::where('key','global_bonus_min_pv')->first();
        $global_bonus_min_pv =  $global_bonus->value;
        $global_bonus = Setting::where('key','global_bonus_min_sponsor')->first();
        $global_bonus_sponsor=  $global_bonus->value;

        //\DB::enableQueryLog(); // Enable query log
        $monthOrder = Order::with('currency')->where('global_paid',0)
                        ->where('status_order','shipped') //or processing?
                        ->whereBetween('created_at', [$from, $to]) //updated_at, use created at bcos previous job has updated the table
                        ->get();
        //dd(\DB::getQueryLog()); // Show results of log


        $total_global_sales = 0;
        foreach ($monthOrder as $order){
            if($order->currency_id == $defaultCurrency->id){
                $total_global_sales += $order->total_sales;
            }else{
                $total_global_sales += Helper::convertToDefaultCurrency($order->total_sales,$order->currency);
            }
            $order->global_paid =1;
            $order->save();
        }





        $total_global_sales_bonus = $total_global_sales*($global_sales_bonus_percentage/100);


        $monthRegistration = User::with('package.priceDefault')->where('active',1)
            ->whereBetween('created_at', [$from, $to])
            ->get();

        $total_global_registration = 0;
        foreach ($monthRegistration as $registration){
            $total_global_registration += $registration->package->priceDefault[0]->price;
        }



        $total_global_registration_bonus = $total_global_registration*($global_registration_bonus_percentage/100);

        $totalAmountBonus =$total_global_sales_bonus+$total_global_registration_bonus;


        // get qualified users
        $globalBonusPackagesArray = explode(',',$global_bonus_packages);


        $qualifiedUsers = User::with('currency','referredLastMonth')
                                ->where('current_direct_pv','>=',$global_bonus_min_pv)
                                ->whereIn('package_id', $globalBonusPackagesArray)
                                ->get();

        foreach ($qualifiedUsers as $key => $roundOne){
            if(count($roundOne->referredLastMonth) <$global_bonus_sponsor+0){
                $qualifiedUsers->forget($key);
            }
        }


        if(count($qualifiedUsers)>0){
            $amountPerUser = $totalAmountBonus/count($qualifiedUsers);

            foreach ($qualifiedUsers as $qualifiedUser){
                // reserve some for loyalty bonus
                $loyalty_bonus =$amountPerUser*($loyalty_bonus_percentage/100);
                $earned_bonus_cash = $amountPerUser-$loyalty_bonus;
                $payment = new Payment();
                $payment->user_id = $qualifiedUser->id;
                $payment->description = "Global Sales and Registration bonus from: ".$from." to: ".$to;
                $payment->amount =  Helper::convertToDifferentCurrency($earned_bonus_cash,$defaultCurrency, $qualifiedUser->currency);   ;
                $payment->currency_id = $qualifiedUser->currency_id;
                $payment->bonus_type = "global";
                $payment->status   ="pending";
                $payment->date_time_to_pay =  date('Y-m-d H:i:s', strtotime('today 23:50'));
                $payment->save();

                $details = "Loyalty of Global Sales and Registration bonus from User :".$qualifiedUser->username;
                Helper::saveLoyaltyBonus($qualifiedUser,$loyalty_bonus, 'global_sales', $details);
            }
        }



        // record this job
        $joblog               = new PaymentJobLog();
        $joblog->job_name     = "ProcessPaymentGlobalSalesBonus";
        $joblog->date_from    = $from;
        $joblog->date_to      = $to;
        $joblog->no_of_payment_generated = count($qualifiedUsers);
        $joblog->start_time   = $start_time;
        $joblog->end_time     = date('H:i:s');
        $joblog->save();


    }
}

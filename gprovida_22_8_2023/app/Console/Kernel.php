<?php

namespace App\Console;

use App\Jobs\ProcessPaymentAwardBonus;
use App\Jobs\ProcessPaymentBinaryBonus;
use App\Jobs\ProcessPaymentGlobalSalesBonus;
use App\Jobs\ProcessPaymentLoyaltyBonus;
use App\Jobs\ProcessPaymentReferralBonus;
use App\Jobs\ProcessPaymentRepurchaseBonus;
use App\Jobs\ProcessPaymentSpecialBonus;
use App\Jobs\ProcessPaymentStockistBonus;
use App\Jobs\ProcessPaymentStockistSponsorBonus;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;


class Kernel extends ConsoleKernel
{

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        //$schedule->command('cache:clear')->everyFiveMinutes();
        //$schedule->command('view:clear')->everyFiveMinutes();
        //$schedule->command('route:clear')->everyFiveMinutes();
        //$schedule->command('config:cache')->everyFiveMinutes();


        //Payment for Referral/stockist Referral/upgrade bonus
        $schedule->job(new ProcessPaymentReferralBonus)->everyFiveMinutes()
                                                        ->timezone('Africa/Lagos')
                                                        //->runInBackground()
                                                        ->emailOutputOnFailure('chinextworld@yahoo.com');
        $schedule->job(new ProcessPaymentBinaryBonus)->weeklyOn(1, '4:00')
                                                        ->timezone('Africa/Lagos')
                                                        ->emailOutputOnFailure('chinextworld@yahoo.com');
        $schedule->job(new ProcessPaymentStockistBonus)->monthly()  //first day of every month at 00:00
                                                        ->timezone('Africa/Lagos')
                                                        ->emailOutputOnFailure('chinextworld@yahoo.com');
        $schedule->job(new ProcessPaymentRepurchaseBonus)->monthly()
                                                        ->timezone('Africa/Lagos')
                                                        ->emailOutputOnFailure('chinextworld@yahoo.com');
        $schedule->job(new ProcessPaymentGlobalSalesBonus)->monthly()
                                                        ->timezone('Africa/Lagos')
                                                        ->emailOutputOnFailure('chinextworld@yahoo.com');
        $schedule->job(new ProcessPaymentSpecialBonus)->monthly()
                                                        ->timezone('Africa/Lagos')
                                                        ->emailOutputOnFailure('chinextworld@yahoo.com');
        $schedule->job(new ProcessPaymentAwardBonus)->monthly()
                                                        ->timezone('Africa/Lagos')
                                                        ->emailOutputOnFailure('chinextworld@yahoo.com');


        // should be the last Job
        $schedule->job(new ProcessPaymentLoyaltyBonus)->monthlyOn(1, '06:00')
                                            ->timezone('Africa/Lagos')
                                            ->emailOutputOnFailure('chinextworld@yahoo.com');

        // TODO move all current PV to cummlation, record the transaction in database
        /*
         *
         *  clear current_direct_pv
            $qualifiedUser->cumulative_direct_pv +=  $qualifiedUser->current_direct_pv;
            $qualifiedUser->current_direct_pv =0;
            $qualifiedUser->save();

                // clear all non qualified user
            $idsOfQualifiedUsers = $qualifiedUsers->pluck('id')->toArray();
            $unQualifiedUsers = User::where('current_direct_pv','>',0)
                                ->whereNotIn('id', $idsOfQualifiedUsers)
                                ->get();
            foreach ($unQualifiedUsers as $unQualifiedUser){ // clear current_direct_pv
                $unQualifiedUser->cumulative_direct_pv +=  $unQualifiedUser->current_direct_pv;
                $unQualifiedUser->current_direct_pv =0;
                $unQualifiedUser->save();
            }
         *
         */





        $schedule->command('queue:work --stop-when-empty')
            ->everyMinute()
            ->withoutOverlapping();
        //$schedule->command('telescope:prune --hours=48')->daily();


    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Add the command classes to be used in cron job here
        // \App\Console\Commands\SendReservedCoupon::class,
        // \App\Console\Commands\SendCouponBasedOnTriggerDistribution::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // // run SendReservedCoupon every 1 hour
        // $schedule->command('message:send-reserved-coupon')
        //      ->hourly();
        //
        // // run SendCouponBasedOnTriggerDistribution every 1 hour
        // $schedule->command('trigger-distribution:send-event-coupon')
        //      ->hourly();
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

<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
//        \App\Console\Commands\BranchData::class,
//        \App\Console\Commands\Transactions::class,
//        \App\Console\Commands\Section::class,
//        \App\Console\Commands\StationDevice::class,
//        \App\Console\Commands\DeviceStatus::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
//        $schedule->command('branchdata')->everyMinute();
//        //everyFiveMinutes
//        $schedule->command('transactions')->everyFiveMinutes();
//        $schedule->command('section')->everyFiveMinutes();
//        $schedule->command('stationdevice')->everyFiveMinutes();
        $schedule->call(function () {
            DB::table('linkhay_friend_lists')->insert(['list_name' => date("Y-m-d h:i:s"),'list_user_id' => 14]);
        })->everyMinute();
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

<?php

namespace App\Console;

use App\Console\Commands\SendDailyReminder;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        // Schedule the daily reminder to run every day at midnight
        $schedule->command('reminder:daily')->dailyAt('00:00');
    }

    protected $commands = [
    Commands\CategoryBookCount::class,
];


/*************  ✨ Codeium Command ⭐  *************/
    /**
     * Register the commands for the application.
     *
     * @return void
     */
/******  fbe40385-07d7-40b2-adff-ac2af095ebcf  *******/
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

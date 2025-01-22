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

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

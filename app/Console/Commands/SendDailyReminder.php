<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendDailyReminder extends Command
{
    protected $signature = 'reminder:daily';
    protected $description = 'Send a daily reminder to users (demo command)';

    public function handle()
    {
        // For demonstration, we’ll just write to the log.
        // In real application, you’d query some data and send emails/notifications.
        Log::info('Daily reminder sent to users!');
        
        // Output to console as well
        $this->info('Daily reminder command executed successfully.');

        return 0;
    }
}

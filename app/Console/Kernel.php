<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Send subscription expiry reminder emails daily at 9:00 AM
        // Notifies users/artists whose plan expires in exactly 3 days
        $schedule->command('subscriptions:send-expiry-reminders --days=3')
             ->dailyAt('09:00')
             ->withoutOverlapping()
             ->runInBackground()
             ->appendOutputTo(storage_path('logs/subscription-expiry-reminders.log'));
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

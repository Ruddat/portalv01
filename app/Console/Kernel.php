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
        // $schedule->command('inspire')->hourly();
        $schedule->command('lotto:download')->dailyAt('00:00');
        $schedule->command('sitemap:generate')->daily('00:00');
        $schedule->command('invoices:generate')->weeklyOn(6, '23:59');
        $schedule->command('notify:outbid')->hourly();
        $schedule->command('comments:delete-unverified')->hourly();


    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    protected $commands = [
        \App\Console\Commands\GenerateSitemap::class,
    ];

}

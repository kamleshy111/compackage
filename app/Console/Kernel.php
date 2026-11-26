<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\SubscriptionExpireReminder;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\DemoEmail;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        SubscriptionExpireReminder::class,
        DemoEmail::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('users:subscription-expire-reminder')->hourly();
        $schedule->command('usersdemo:weekly-demo-report')->daily();
        //$schedule->command('usersdemo:weekly-demo-report')->everyTwoMinutes();

        // $schedule->command('inspire')->hourly();
        
        // Backup every five minutes
        //$schedule->command('backup:run')->everyFiveMinutes()->appendOutputTo(storage_path('logs/backupfive.log'));
        //$schedule->command('backup:run')->everyThirtyMinutes()->appendOutputTo(storage_path('logs/backup.log'));


        //$schedule->command('backup:run')->everyTenMinutes();
        //$schedule->command('backup:run')->daily();
        // Cleanup daily backups older than 30 days
        //$schedule->command('backup:clean --keep=30')->dailyAt('01:00');

        // Monthly backup on the 1st of each month at midnight
        $schedule->command('backup:run')->monthlyOn(1, '00:00');

        // Cleanup monthly backups older than 12 months on the 1st of each month after backup
        //$schedule->command('backup:clean --keep=12 --prefix=monthly')->monthlyOn(1, '01:00');

        // Yearly backup on January 1st at midnight
        $schedule->command('backup:run')->yearly()->at('00:00');

        // Cleanup yearly backups older than 3 years on January 1st after backup
        //$schedule->command('backup:clean --keep=3 --prefix=yearly')->yearly()->at('01:00');
        
        
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
    
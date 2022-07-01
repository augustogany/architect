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
        //Aumente aqui laravel Backup
        'App\Console\Commands\DatabaseBackup'
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //$schedule->command('database:backup')->daily();
        $schedule->command('database:backup')->daily()->at('12:40');
        //$schedule->command('backup:run')->daily()->at('18:42');
        // $schedule->command('inspire')->hourly();
        //$schedule->command('backup:clean')->daily()->at('14:50');
        //$schedule->command('backup:run')->daily()->at('03:15');
        //$schedule->command('backup:run')->timezone('America/La_Paz')->dailyAt('15:47');
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

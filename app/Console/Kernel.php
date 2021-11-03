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
        Commands\DailyQuote::class,
        Commands\ProductDelete::class,
        Commands\DemoCron::class,
        Commands\FoodRemove::class,
        Commands\MultipleProduct::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('command:DailyQuote')
        ->everyMinute();

        $schedule->command('command:productDelete')->everyMinute();
        $schedule->command('command:Demo')->everyMinute();
        $schedule->command('command:FoodRemove')->everyMinute();
        $schedule->command('command:multiple')->everyMinute();
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

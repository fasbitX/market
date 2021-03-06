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
        //
        Commands\UpdateWeeklyPrices::class,
        Commands\UpdateDailyPrices::class,
        Commands\UpdateCoinsData::class,
        Commands\UpdateTopCoins::class,
        Commands\HistoricalData::class,
        Commands\CoinsNewList::class,
        Commands\TestCoinsData::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        //$schedule->command('update:weeklyprices')->weekly();
        //$schedule->command('update:dailyprices')->daily();
        $schedule->command('coins:update')->everyMinute()->runInBackground();
        $schedule->command('coins:newlist')->weekly()->runInBackground();
        $schedule->command('coins:testcoins')->everyMinute()->runInBackground();
        // $schedule->command('historical:data')->everyMinute();
        //$schedule->command('coins:top')->everyFiveMinutes();

    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}

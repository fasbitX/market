<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\CoinController;
use Illuminate\Support\Facades\Log;
class HistoricalData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'historical:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Save Historical Data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        CoinController::saveHistoricalData();
        Log::info('Historical Data');
    }
}

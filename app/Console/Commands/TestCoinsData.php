<?php

namespace App\Console\Commands;
use App\Http\Controllers\CoinController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class TestCoinsData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coins:testcoins';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'TEST coins data';

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

        CoinController::coinMarketCapBTC();
        Log::info('TEST updated');


    }
}

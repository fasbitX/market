<?php

namespace App\Console\Commands;
use App\Http\Controllers\CoinController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CoinsNewList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coins:newlist';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Coins New List';

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

        CoinController::newList();
        Log::info('Coins New List Updated');


    }
}

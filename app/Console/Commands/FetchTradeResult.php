<?php

namespace App\Console\Commands;

use App\Events\DeclareResultForTrade;
use App\Models\TradeHistory;
use Illuminate\Console\Command;

class FetchTradeResult extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:trade {type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetching Trading Result';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $type = $this->argument('type');
        // info("Command Run Successfully");
        // info($type);
        $bitcoinPrice = number_format(fetchLiveResult(), 2, '.', '');
        $priceString = strval($bitcoinPrice);
        $characters = str_split($priceString);
        $lastSecondDecimal = end($characters);

        $tradeHistory = new TradeHistory();
        $tradeHistory->price = $bitcoinPrice;
        $tradeHistory->type = $type;
        $tradeHistory->result = $lastSecondDecimal;
        $tradeHistory->save();

        event(new DeclareResultForTrade($tradeHistory,$type));
    }
}

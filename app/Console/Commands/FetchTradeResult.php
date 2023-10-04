<?php

namespace App\Console\Commands;

use App\Events\DeclareResultForTrade;
use App\Models\Future;
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

        // checking if any future policy in the system
        $timestamp = date('YmdHi');
        info($timestamp);
        $futureTrade = Future::where('timestamp', $timestamp)->where('status', true)->first();
        info($futureTrade);
        if (($lastSecondDecimal % 2 == 0)) {
            $tradeType = 'even';
        } else {
            $tradeType = 'odd';
        }
        if ($futureTrade != "") {
            info("Future Trade Policy Found");
            if ($futureTrade->type == $tradeType) {
                info("The Future Trade is Already True");
                goto skipFutureTrading;
            } else {
                info("Real Digit was: " . $lastSecondDecimal);
                $lastSecondDecimal += 0.01;
                $bitcoinPrice += 0.01;
                info("Now new Digit is: " . $lastSecondDecimal);
            }
        } else {
            info('no future trade found');
        }

        skipFutureTrading:

        $tradeHistory = new TradeHistory();
        $tradeHistory->price = $bitcoinPrice;
        $tradeHistory->type = $type;
        $tradeHistory->result = $lastSecondDecimal;
        $tradeHistory->save();

        event(new DeclareResultForTrade($tradeHistory, $type));
    }
}

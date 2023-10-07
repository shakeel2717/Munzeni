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
        // checking if any future policy in the system
        $timestamp = date('YmdHi');
        $bitcoinPrice = number_format(fetchLiveResult(), 2, '.', '');
        info($bitcoinPrice);
        $priceString = strval($bitcoinPrice);
        $characters = str_split($priceString);
        $lastSecondDecimal = end($characters);

        info($timestamp);
        $futureTrade = Future::where('timestamp', $timestamp)->first();
        info($futureTrade);
        if (($lastSecondDecimal % 2 == 0)) {
            $tradeType = 'even';
        } else {
            $tradeType = 'odd';
        }
        if ($futureTrade != "") {
            info("Future Trade Policy Found");
            info("Trade Result: " . $tradeType);
            info("Trade Future: " . $futureTrade->type);
            info("Current Rate: " . $bitcoinPrice);
            info("Last Digit: " . $lastSecondDecimal);
            if ($futureTrade->type == $tradeType) {
                info("The Future Trade is Already True");
                goto skipFutureTrading;
            } else {
                info("Real Digit was: " . $lastSecondDecimal);
                if($lastSecondDecimal == 9){
                    $lastSecondDecimal = $lastSecondDecimal - 1;
                } else {
                    $lastSecondDecimal = $lastSecondDecimal + 1;
                }
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
        $tradeHistory->timestamp = $timestamp;
        $tradeHistory->result = $lastSecondDecimal;
        $tradeHistory->created_at = now()->addMinutes(-1);
        $tradeHistory->save();

        event(new DeclareResultForTrade($tradeHistory, $type));
    }
}

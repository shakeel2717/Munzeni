<?php

namespace App\Listeners;

use App\Events\DeclareResultForTrade;
use App\Models\Trading;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendProfitToWinner
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(DeclareResultForTrade $event): void
    {
        // getting all trades
        $trades = Trading::where('status', true)->where('method', $event->type)->get();
        foreach ($trades as $trade) {
            // info("Result: " . $event->tradeHistory->result);
            $isEven = ($event->tradeHistory->result % 2 == 0);
            if ($isEven) {
                // info("This is Even" . $event->tradeHistory->result);
                $winner = 'even';
            } else {
                // info("This is Odd" . $event->tradeHistory->result);
                $winner = 'odd';
            }
            if ($winner == $trade->type) {
                // getting trade profit
                if ($event->type == 'one') {
                    $trade_profit = settings('one_mi_trade_profit');
                } else {
                    $trade_profit = settings('five_mi_trade_profit');
                }
                // info($winner . " is winner");
                $winnerAmount = $trade->amount * $trade_profit;
                $winner_charges = settings("winner_charges");
                if ($winner_charges > 0) {
                    $winnerAmountFees = $winnerAmount * settings("winner_charges") / 100;
                    $transaction = $trade->user->transactions()->create([
                        'type' => 'trading fees',
                        'amount' => $winnerAmountFees,
                        'sum' => false,
                        'status' => true,
                        'reference' => "Trading fees :"  . $winner_charges . "%",
                    ]);
                }
                // sending profits
                $transaction = $trade->user->transactions()->create([
                    'type' => 'trading profit',
                    'amount' => $winnerAmount,
                    'sum' => true,
                    'status' => true,
                    'reference' => "Trading Winner On: " . strtoupper($event->type) . " Mi" . " with :"  . $winner,
                ]);

                // info($trade->user->name . " is winner, Profit Delivered");
                $trade->status = false;
                $trade->profit = ($winnerAmount - $trade->amount) - $winnerAmountFees;
                $trade->win = true;
                $trade->save();
            } else {
                // info($winner . " is Loser");
                // info($trade->user->name . " is loser");
                $trade->win = false;
                $trade->status = false;
                $trade->save();
            }
        }
    }
}

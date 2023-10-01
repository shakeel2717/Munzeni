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
        $trades = Trading::where('status', false)->get();
        foreach ($trades as $trade) {
            // info("Result: " . $event->tradeHistory->result);
            $isEven = ($event->tradeHistory->result % 2 == 0);
            if (!$isEven) {
                // info("This is Even" . $event->tradeHistory->result);
                $winner = 'even';
            } else {
                // info("This is Odd" . $event->tradeHistory->result);
                $winner = 'odd';
            }
            if ($winner == $trade->type) {
                // info($winner . " is winner");
                // sending profits
                $transaction = $trade->user->transactions()->create([
                    'type' => 'trading profit',
                    'amount' => $trade->amount * 2,
                    'sum' => true,
                    'status' => true,
                    'reference' => "Trading Winner on :"  . $winner,
                ]);
                // info($trade->user->name . " is winner, Profit Delivered");
                $trade->status = true;
                $trade->save();
            } else {
                // info($winner . " is Loser");
                // info($trade->user->name . " is loser");
                $trade->status = true;
                $trade->save();
            }
        }
    }
}

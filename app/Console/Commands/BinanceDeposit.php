<?php

namespace App\Console\Commands;

use App\Models\Tid;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class BinanceDeposit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'verify:deposits';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch All Binance Deposits and Approved Them';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $apiKey = env('BINANCE_API_KEY');
        $apiSecret = env('BINANCE_API_SECRET');
        $timestamp = round(microtime(true) * 1000);

        // finding pending tid
        $tids = Tid::where('status', false)->get();
        foreach ($tids as $tid) {
            $params = [
                'timestamp' => $timestamp,
                'txId' => $tid->hash_id,
                'status' => 1,
            ];
            $params['signature'] = hash_hmac('sha256', http_build_query($params), $apiSecret);
            $response = Http::withHeaders([
                'X-MBX-APIKEY' => $apiKey,
            ])->get('https://api.binance.com/sapi/v1/capital/deposit/hisrec', $params);
            info($response);
            // checking if this response is empty
            if ($response->json() == []) {
                info("This TID not Found");
                goto endThisTxLoop;
            }

            $transaction = $response->json();
            if (!$transaction[0]['status']) {
                info("Transaction Not yet Approved");
                goto endThisTxLoop;
            }

            // checking if this coin is usdt
            if ($transaction[0]['coin'] == 'USDT') {
                $finalAmount = $transaction[0]['amount'];
                $fees = 0;
            }

            // approving this transaction
            $tid->status = true;
            $tid->amount = $finalAmount;
            $tid->save();

            // adding Transaction to user balance
            $user = User::find($tid->user_id);
            $transaction = $user->transactions()->create([
                'type' => 'deposit',
                'amount' => $finalAmount,
                'sum' => true,
                'status' => true,
                'reference' => "Deposit Approved, TxId: " . $tid->hash_id,
            ]);

            if (settings('first_deposit_bonus') > 0) {
                // checking if this is first deposit if this user
                $checkDeposit = Transaction::where('user_id', $user->id)->where('type', 'deposit')->count();
                if ($checkDeposit > 0) {
                    $bonus = settings('first_deposit_bonus');

                    // eligible for bonus
                    $transaction = $user->transactions()->create([
                        'type' => 'deposit bonus',
                        'amount' => $finalAmount * $bonus / 100,
                        'sum' => true,
                        'status' => true,
                        'reference' => "Deposit Bonus",
                    ]);
                }
            }

            info("Deposit Added");

            endThisTxLoop:
        }
    }
}

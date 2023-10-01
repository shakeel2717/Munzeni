<?php

namespace App\Listeners;

use App\Events\UserInvestInTrading;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendDirectTradingCommission
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
    public function handle(UserInvestInTrading $event): void
    {
        // info('Event direct trading');
        // sending direct commission to this user upliner
        $user = User::find($event->transaction->user_id);

        // checking if this user have valid direct refer
        // info($user->refer);
        if ($user->refer != 'default') {
            // info('valid refer found');
            $upliner = User::where('username', $user->refer)->first();
            // user have valid direct referral
            $direct_commission_amount = settings('trade_level_1_commission');
            $direct_commission = $event->transaction->amount * $direct_commission_amount / 100;

            // adding balance to this user
            $transaction = $upliner->transactions()->create([
                'type' => 'direct trading commission',
                'amount' => $direct_commission,
                'sum' => true,
                'status' => true,
                'reference' => "direct trading commission from: " . $user->username,
            ]);

            // checking if this user have valid indirect refer
            // info($upliner->refer);
            if ($upliner->refer != 'default') {
                // info('valid indirect refer found');
                $upliner1 = User::where('username', $upliner->refer)->first();
                // user have valid indirect referral
                $indirect_commission_amount = settings('trade_level_2_commission');
                $indirect_commission = $event->transaction->amount * $indirect_commission_amount / 100;

                // adding balance to this user
                $transaction = $upliner1->transactions()->create([
                    'type' => 'indirect trading commission',
                    'amount' => $indirect_commission,
                    'sum' => true,
                    'status' => true,
                    'reference' => "indirect trading commission from: " . $user->username,
                ]);
            }
        }
    }
}

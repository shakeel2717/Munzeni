<?php

namespace App\Listeners;

use App\Events\PlanActivation;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendDirectCommission
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
    public function handle(PlanActivation $event): void
    {
        // getting this user
        $user = User::find($event->userPlan->user_id);
        info($user);

        // checking if this user have valid direct referral
        if ($user->refer == 'default') {
            goto skipThisListener;
        }

        $upliner = User::where('username', $user->refer)->first();
        $directCommission = $event->userPlan->amount * settings("direct_level_1_commission") / 100;

        $transaction = $upliner->transactions()->create([
            'type' => 'direct commission',
            'amount' => $directCommission,
            'sum' => true,
            'status' => true,
            'reference' => "direct commission form downline: " . $user->username,
        ]);

        skipThisListener:
    }
}

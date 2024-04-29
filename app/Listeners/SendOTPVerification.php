<?php

namespace App\Listeners;

use App\Notifications\SendOTPVerificationNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendOTPVerification
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
    public function handle($event): void
    {
        // sending notfication
        $event->user->notify(new SendOTPVerificationNotification($event->user));
    }
}

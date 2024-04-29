<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{

    public function resent()
    {
        $otp = generateRandomOTP(6);

        $user = auth()->user();
        $user->otp = $otp;
        $user->save();

        event(new Registered($user));

        return back()->with("message", "OTP Request Sent, Please wait for 2 minutes before requsting again.");
    }

    public function verify(Request $request)
    {
        $validated = $request->validate([
            'verification_code' => 'required|numeric|digits:6',
        ]);

        $user = auth()->user();

        if ($user->otp == $validated['verification_code']) {
            // otp verified
            $user->email_verified_at = now();

            $user->save();

            return redirect()->intended(RouteServiceProvider::HOME);
        } else {
            return back()->with('error', 'Invalid OTP');
        }
    }
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}

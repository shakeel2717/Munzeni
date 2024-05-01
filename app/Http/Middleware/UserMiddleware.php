<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // checking password change
        if ($request->session()->get('hashed_password') != auth()->user()->password) {
            Auth::logout();
            // Redirect the user to the login page with a message
            return redirect()->route('login');
        }
        if (auth()->user()->status == "suspend") {
            Auth::logout();
            return redirect()->route('login')->withErrors(['Account Suspended, Please Contact Support']);
        }
        
        if (auth()->user()->email_verified_at){
            return $next($request);
        } else {
            return redirect(route('verification.notice'));
        }
    }
}

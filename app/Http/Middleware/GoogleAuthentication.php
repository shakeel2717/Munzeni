<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GoogleAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // checking if google authentication is enabled
        if (auth()->user()->authenticator) {
            if (session('google')) {
                return $next($request);
            } else {
                return redirect()->route('user.google.code');
            }
        } else {
            return $next($request);
        }
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Ensure2FAIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If the user has a pending 2FA flag in their session...
        if (session()->has('pending_2fa_user')) {

            // ...and they are NOT already on the code input or validation pages...
            if (!$request->is('settings/input_code') && !$request->is('settings/input_validation')) {

                // ...kick them right back to the code input screen!
                return redirect()->route('settings.show')->withErrors([
                    'otp' => 'You must complete two-factor verification to access this page.'
                ]);
            }
        }

        return $next($request);
    }
}

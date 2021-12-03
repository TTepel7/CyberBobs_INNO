<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login');
        }

    }

    public function handle($request, Closure $next, ...$guards)
    {
        if (Auth::guest()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        } elseif (!isset(Auth::user()['email_verified_at'])) {
            return response()->json(['error' => 'Verify your email'], 401);
        }
        // other checks

        return $next($request);
    }
}

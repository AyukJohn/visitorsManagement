<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureEmailVerified
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->email_verified_at === null) {
            return response()->json(['error' => 'Email is not verified.'], 403);
        }

        return $next($request);
    }
}

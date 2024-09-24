<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated using the 'admin' guard
        if (auth()->guard('admin')->check()) {
            $user = auth()->guard('admin')->user();

            // Check if the user is either an admin or a superadmin
            if ($user->role === 'admin' || $user->role === 'superAdmin') {
                return $next($request); // User is either an admin or a superadmin, allow access
            }
        }

        return response()->json([ "message"  => 'Unauthorized.'], 403); // User is neither an admin nor a superadmin, deny access
    }

}

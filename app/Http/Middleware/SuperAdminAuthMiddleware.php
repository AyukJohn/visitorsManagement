<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard('admin')->check()) {
            $admin = Auth::guard('admin')->user();

            // dd($admin->role);

            if ($admin->role == 'superAdmin') {
                // The admin user has the role of "super admin"
                return $next($request);
            } else {
                return response()->json([ "message"  => 'Unauthorized.'], 403);
            }
        }

        return response()->json([ "message" => 'Unauthorized'], 401);
    }
}

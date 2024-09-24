<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class checkAdminPrivilegesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle($request, Closure $next, $privilegeName)
    // {
    //     // Get the authenticated admin
    //     $admin = auth()->guard('admin')->user();

    //     // Check if the admin has the specified privilege
    //     if ($admin->privileges->contains('name', $privilegeName)) {
    //         return $next($request);
    //     }

    //     // Redirect or return an error response if the privilege check fails
    //     return response('Unauthorized', 401);
    // }


    public function handle($request, Closure $next, ...$privileges)
    {
        
        Log::info("Middleware Start");

    foreach ($privileges as $privilege) {
        if (auth()->check() && auth()->guard('admin')->user()->hasPrivilege($privilege)) {
            Log::info("User has privilege: $privilege");
            return $next($request);
        }
    }

    Log::info('User Unauthorized');
    return response('Unauthorized', 401);
    }


    // public function handle($request, Closure $next, ...$privileges)
    // {
    //     $admin = auth()->guard('admin')->user(); // Assuming you're using 'admin' as the user model

    //     foreach ($privileges as $privilege) {
    //         if ($admin->hasPrivilege($privilege)) {
    //             return $next($request);
    //         }
    //     }

    //     abort(403, 'Unauthorized');
    // }


}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BanUserMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->is_Banned === 'true') {
            // return response('Banned', 403);

            return response()->json([
                'status' => 'false',
                'message' => 'Sorry you have been Banned from Accessing this Area',
            ]);
        }

        return $next($request);
    }

}

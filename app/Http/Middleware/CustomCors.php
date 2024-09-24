<?php

namespace App\Http\Middleware;

use Closure;

class CustomCors
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Add your CORS headers here
        $response->header('Access-Control-Allow-Origin', '*');
        $response->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE');
        $response->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');

        return $response;
    }
}

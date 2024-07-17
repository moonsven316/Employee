<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'PUT, GET, POST, DELETE, OPTIONS, PATCH');
        $response->headers->set('Access-Control-Allow-Headers', $request->header('Access-Control-Request-Headers'));
        $response->headers->set('Access-Control-Allow-Credentials', 'true');
        $response->headers->set('Accept', 'application/json');
        $response->headers->set('Access-Control-Expose-Headers', 'location');

        return $response;
    }
}

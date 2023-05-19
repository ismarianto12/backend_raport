<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomMiddleware
{
    public function handle(Request $request, Closure $next)
    {

        $token     = isset($request->token) ? $request->token : '';
        $tokendata = $request->token('token');
        $header    = $request->header('token') != '' ? $tokendata : '';

        if ($token || $header) {
            return $next($request);
        } else {
            return response('Unauthorized.', 401);
        }
    }
}

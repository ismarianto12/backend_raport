<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->token) {
            return $next($request);
        } else {
            return response()->json([
                'autheticated' => true,
            ], 400);
        }
    }
}

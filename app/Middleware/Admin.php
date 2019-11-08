<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Admin
{

    public function handle($request, Closure $next)
    {
        if ( Auth::check() && Auth::user()->isAdmin() )
        {
            return $next($request);
        }

        return response()->json([
            'error' => 'Unauthenticated user',
            'code' => 401,
        ], 401);
    }
}
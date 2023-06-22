<?php

namespace App\Http\Middleware;

use Closure;

class InitializeSession
{
    public function handle($request, Closure $next)
    {
        $request->session()->start();

        return $next($request);
    }
}

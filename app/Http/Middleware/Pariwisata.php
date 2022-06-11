<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Redirect;

class Pariwisata extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // public function handle($request, Closure $next)
    // {
    //     $token = $request->bearerToken();
    //     echo($token);
    //     exit;
    //     if($token === null) return;
    //     return $next($request);
    // }

    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return str_replace(PHP_EOL, '', "not_access");
        }
    }
}

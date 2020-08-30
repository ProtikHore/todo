<?php

namespace App\Http\Middleware;

use Closure;

class CheckAuthenticate
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
        if ( ! session()->has('login_success_status')) {
            return redirect('/');
        }
        return $next($request);

    }
}

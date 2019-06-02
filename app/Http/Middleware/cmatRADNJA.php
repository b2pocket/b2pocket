<?php

namespace Laravel\Http\Middleware;

use Closure;

class cmatRADNJA
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
          if (Auth::check() && Auth::user()->role == 'cmatRADNJA') {
        return $next($request);
    }

     else {
        return redirect('/');
    }
    }
}

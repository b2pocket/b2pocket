<?php

namespace Laravel\Http\Middleware;

use Closure;

class cmatMPO
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
       // return $next($request);

         if (Auth::check() && Auth::user()->role == 'cmatMPO') {
        return $next($request);
    }

     else {
        return redirect('/');
    }
    
    }
}

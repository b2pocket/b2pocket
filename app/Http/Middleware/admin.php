<?php

namespace Laravel\Http\Middleware;

use Closure;
use Auth; //at the top

class Admin
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
         if (Auth::check() && Auth::user()->role == 'admin') {
        return $next($request);
    }
    else {
        return redirect('/');
    }

  /* elseif (Auth::check() && Auth::user()->role == 'agent') {
        return redirect('/agent');
    }
    else {
        return redirect('/customer');
    }*/
    }
}

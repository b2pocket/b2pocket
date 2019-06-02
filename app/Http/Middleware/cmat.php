<?php

namespace Laravel\Http\Middleware;

use Closure;

class cmat
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
        if (Auth::check() && Auth::user()->role == 'cmat') {
        return $next($request);
    }

     else {
        return redirect('/');
    }
    /*elseif (Auth::check() && Auth::user()->role == 'customer') {
        return redirect('/customer');
    }
    else {
        return redirect('/admin');
    }
    }*/
}
}

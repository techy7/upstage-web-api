<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsNotUser
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
        if(Auth::user()->role == 'user')
        {
            Auth::logout();
            return redirect('/404');
        }

        return $next($request);
    }
}

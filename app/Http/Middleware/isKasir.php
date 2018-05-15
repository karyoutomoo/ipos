<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class isKasir
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
        if (Auth::user()->user_role != 2){
            return redirect('403');
        }
        return $next($request);
    }
}

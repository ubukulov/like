<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Cookie;

class Store
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
        if(!Auth::check()){
            // не авторизован
            Cookie::queue('store', $_SERVER['REQUEST_URI'], 0);
            return redirect()->route('showLoginUser');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use App\Admin;

class AdminManagerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if(!$role == 4){
            if(!Admin::role($role)){
                return redirect()->back();
            }
        }

        return $next($request);
    }
}

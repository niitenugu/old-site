<?php

namespace App\Http\Middleware;

use Closure;

class CheckIfUserIsActive
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
        if(! auth()->user()->is_active){
           return redirect()->route('admin.account_deactivated');
        }
        
        return $next($request);
    }
}

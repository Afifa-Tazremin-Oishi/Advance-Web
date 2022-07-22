<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ManagerValidAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->session()->get('manager')){
            return $next($request);
        }
        return redirect()->route('login');
    }
}

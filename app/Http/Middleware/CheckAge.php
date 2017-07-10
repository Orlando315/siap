<?php

namespace App\Http\Middleware;

use Closure;

class CheckAge
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
    	dd("a");
        if (! $request->user()->hasRole($role)) {
            return redirect('login');
        }

        return $next($request);
    }
}

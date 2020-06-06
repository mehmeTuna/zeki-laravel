<?php

namespace App\Http\Middleware;

use Closure;

class WorkerCheck
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
        if(!session()->has('workerId')){
            return redirect('/calisan/giris');
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use App\Site;
use Closure;

class UserCheck
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
        if(!session()->has('userId')){
            return redirect('/giris');
        }

        return $next($request);
    }
}

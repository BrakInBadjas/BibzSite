<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class EmailVerification
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
        if(Auth::user()->verified){
            return $next($request);
        }

        return redirect(route('waiting'));
    }
}

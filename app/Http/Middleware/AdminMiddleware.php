<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        if (Auth::guard(GUARD_ADMIN)->user()) {

            return $next($request);

        } else {

            return redirect()->route('admin.login')->with('dismiss','You are not authorised, Thanks !');
        }

    }
}

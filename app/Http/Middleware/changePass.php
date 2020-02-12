<?php

namespace App\Http\Middleware;

use Closure;

class changePass
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
        if ($request->user() && $request->user()->change_pass = true)
        {
        return redirect('/MustChangePass');
        }
        return $next($request);


    }
}

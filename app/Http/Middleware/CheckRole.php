<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role, $role2 = '')
    {
        if (\Auth::check()) {

            if ($request->user()->role == $role || $request->user()->role == $role2) {
                return $next($request);
            }
        }
        return redirect(route('home'));
    }
}

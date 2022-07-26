<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        $segments = $request->segments();
        if ($segments[0] == 'customer' && $user->user_type != 'customer') {
            return abort(401);
        }

        if ($segments[0] == 'delivery' && $user->user_type != 'delivery') {
            return abort(401);
        }
        return $next($request);
    }
}

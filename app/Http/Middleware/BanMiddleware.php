<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class BanMiddleware
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
        if (isset(Auth::user()->profile->ban->first()->id) && Auth::user()->profile->ban->last()->ban_end_date > strtotime('now') || Auth::user()->profile->is_banned) {
            if ($request->ajax()){
                return response('banned');
            }
            return redirect()->route('banned');
        }
        return $next($request);
    }
}

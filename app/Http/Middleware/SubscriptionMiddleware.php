<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SubscriptionMiddleware
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
        if (Auth::user()->profile->subscription_end_date < strtotime('now') || Auth::user()->profile->is_locked) {
            if ($request->ajax()){
                return response('unpaid');
            }
            return redirect()->route('unpaid');
        }
        return $next($request);
    }
}

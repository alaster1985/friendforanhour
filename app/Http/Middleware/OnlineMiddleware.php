<?php

namespace App\Http\Middleware;

use App\Profile;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class OnlineMiddleware
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
        if (Auth::check() && Auth::user()->profile_id){
            $expiresAt = Carbon::now()->addMinutes(2);
            Cache::put('profile-in-online-' . Auth::user()->profile_id, true, $expiresAt);
            $profile = Profile::find(Auth::user()->profile_id);
            $profile->last_activity = strtotime('now');
            $profile->save();
        }
        return $next($request);
    }
}

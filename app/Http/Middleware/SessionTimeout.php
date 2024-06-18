<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SessionTimeout
{
    public function handle($request, Closure $next)
    {
        $timeout = 600; // 10 минут

        if (Auth::check()) {
            $lastActivity = $request->session()->get('last_activity_time');
            if ($lastActivity && (time() - strtotime($lastActivity)) > $timeout) {
                Auth::logout();
                return redirect()->route('login')->withErrors(['Your session has expired due to inactivity.']);
            }
            $request->session()->put('last_activity_time', now());
        }

        return $next($request);
    }
}

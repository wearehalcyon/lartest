<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\UserActivity;
use Illuminate\Support\Facades\Auth;

class LogUserActivity
{
    public function handle(Request $request, Closure $next)
    {
        // Get IP
        $ipAddress = $request->ip();

        // Get route
        $route = $request->route()->getName();

        // Get request data
        $requestData = $request->all();

        // Save into database
        UserActivity::create([
            'ip_address' => $ipAddress,
            'route' => $route,
            'request_data' => json_encode($requestData),
            'logged_in' => Auth::check() ? 1 : 0,
        ]);

        return $next($request);
    }
}

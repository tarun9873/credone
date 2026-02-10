<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\IpWhitelist;

class LoginIpWhitelist
{
    public function handle(Request $request, Closure $next)
{
    if (!auth()->check()) {
        return $next($request);
    }

    // 👑 SUPER ADMIN → NO IP CHECK EVER
    if (auth()->user()->role === 'super_admin') {
        return $next($request);
    }

    // 🔥 IMPERSONATION MODE → NO IP CHECK
    if (session()->has('impersonator_id')) {
        return $next($request);
    }

    $clientIp = $request->ip();

    // ❌ BLOCK IPv6
    if (filter_var($clientIp, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
        auth()->logout();
        return redirect('/login')->withErrors([
            'ip' => 'IPv6 network not allowed'
        ]);
    }

    // ✅ IPv4 whitelist
    $allowedIps = \App\Models\IpWhitelist::pluck('ip_address')->toArray();

    if (!in_array($clientIp, $allowedIps)) {
        auth()->logout();
        return redirect('/login')->withErrors([
            'ip' => 'Your IP is not authorized'
        ]);
    }

    return $next($request);
}

}
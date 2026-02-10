<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\IpWhitelist;
use Illuminate\Support\Facades\Auth;

class LoginIpWhitelist
{
    public function handle(Request $request, Closure $next)
    {
        // Guest users
        if (!Auth::check()) {
            return $next($request);
        }

        $user = Auth::user();

        // 👑 SUPER ADMIN → NO IP CHECK
        if ($user->role === 'super_admin') {
            return $next($request);
        }

        // 🔐 ADMIN + EMPLOYEE (+ user if exists) → IP REQUIRED
        if (in_array($user->role, ['admin', 'employee', 'user'])) {

            $clientIp = $request->ip();

            // ❌ BLOCK IPv6 COMPLETELY
            if (filter_var($clientIp, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {

                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect('/login')->withErrors([
                    'ip' => 'IPv6 network is not allowed. Please use IPv4.'
                ]);
            }

            // ✅ FETCH WHITELISTED IPv4s
            $allowedIps = IpWhitelist::pluck('ip_address')->toArray();

            // ❌ IF IP NOT WHITELISTED → BLOCK
            if (!in_array($clientIp, $allowedIps)) {

                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect('/login')->withErrors([
                    'ip' => 'Your IP is not authorized. Please contact administrator.'
                ]);
            }
        }

        return $next($request);
    }
}
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\IpWhitelist;

class CustomLoginController extends Controller
{
    public function login(Request $request)
    {
        // ===============================
        // BASIC VALIDATION
        // ===============================
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // ===============================
        // LOGIN ATTEMPT
        // ===============================
        if (!Auth::attempt($request->only('email','password'))) {
            return back()->withErrors([
                'email' => 'Invalid login details'
            ]);
        }

        $user = Auth::user();

        // ===============================
        // RAW IP (DEBUG)
        // ===============================
        $rawIp = $request->ip();

        // 🔥 DEBUG – COMMENT MAT KARNA
        dd([
            'RAW_IP_FROM_REQUEST' => $rawIp,
            'ROLE'                => $user->role,
            'IS_IPV6'             => filter_var($rawIp, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6),
            'IS_IPV4'             => filter_var($rawIp, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4),
            'WHITELIST_IPS'       => IpWhitelist::pluck('ip_address')->toArray(),
        ]);

        // ===============================
        // FIX IPv6-mapped IPv4 (::ffff:127.0.0.1)
        // ===============================
        $ip = $rawIp;
        if (str_contains($ip, '::ffff:')) {
            $ip = str_replace('::ffff:', '', $ip);
        }

        // ===============================
        // LOCALHOST ALLOW (DEV)
        // ===============================
        if (in_array($ip, ['127.0.0.1', '::1'])) {
            return redirect()->route('dashboard');
        }

        // ===============================
        // SUPER ADMIN → NO IP CHECK
        // ===============================
        if ($user->role === 'super_admin') {
            return redirect()->route('dashboard');
        }

        // ===============================
        // BLOCK REAL IPv6 ONLY
        // ===============================
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            Auth::logout();
            return back()->withErrors([
                'ip' => 'IPv6 network not allowed'
            ]);
        }

        // ===============================
        // IPV4 WHITELIST CHECK
        // ===============================
        $allowedIps = IpWhitelist::pluck('ip_address')->toArray();

        if (!in_array($ip, $allowedIps)) {
            Auth::logout();
            return back()->withErrors([
                'ip' => 'Your IP is not authorized'
            ]);
        }

        // ===============================
        // SUCCESS
        // ===============================
        return redirect()->route('dashboard');
    }
}
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
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // ❌ wrong credentials
        if (!Auth::attempt($request->only('email','password'))) {
            return back()->withErrors([
                'email' => 'Invalid login details'
            ]);
        }

        $user = Auth::user();
        $ip   = $request->ip();

        /**
         * 🔥 FIX: IPv6-mapped IPv4 (::ffff:127.0.0.1)
         */
        if (str_contains($ip, '::ffff:')) {
            $ip = str_replace('::ffff:', '', $ip);
        }

        /**
         * 🔥 Allow localhost (development)
         */
        if (in_array($ip, ['127.0.0.1', '::1'])) {
            return redirect()->route('dashboard');
        }

        // 👑 SUPER ADMIN → NO IP CHECK
        if ($user->role === 'super_admin') {
            return redirect()->route('dashboard');
        }

        // ❌ Block REAL IPv6 only
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            Auth::logout();
            return back()->withErrors([
                
                'ip' => 'IPv6 network not allowed'
            ]);
        }

        // ✅ IPv4 whitelist check
        $allowedIps = IpWhitelist::pluck('ip_address')->toArray();

        if (!in_array($ip, $allowedIps)) {
            Auth::logout();
            return back()->withErrors([
                'ip' => 'Your IP is not authorized'
            ]);
        }

        return redirect()->route('dashboard');
    }
}
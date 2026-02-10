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

        // 👑 super admin → no IP check
        if ($user->role === 'super_admin') {
            return redirect()->route('dashboard');
        }

        // ❌ IPv6 block
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            Auth::logout();
            return back()->withErrors([
                'ip' => 'IPv6 network not allowed'
            ]);
        }

        // ✅ IPv4 whitelist
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
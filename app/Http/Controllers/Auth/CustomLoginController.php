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
        // ======================
        // VALIDATION
        // ======================
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // ======================
        // LOGIN
        // ======================
        if (!Auth::attempt($request->only('email','password'))) {
            return back()->withErrors([
                'email' => 'Invalid login details'
            ]);
        }

        $user = Auth::user();
        $ip   = $request->ip();

        // ======================
        // SUPER ADMIN → NO CHECK
        // ======================
        if ($user->role === 'super_admin') {
            return redirect()->route('dashboard');
        }

        // ======================
        // FETCH WHITELIST
        // ======================
        $allowedIps = IpWhitelist::pluck('ip_address')->toArray();

        /**
         * 🔥 IMPORTANT FIX
         * IPv6 users are REAL users on live server
         * So we ALLOW IPv6 if it's whitelisted
         */

        // IPv4
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {

            if (!in_array($ip, $allowedIps)) {
                Auth::logout();
                return back()->withErrors([
                    'ip' => 'Your IPv4 address is not authorized'
                ]);
            }

            return redirect()->route('dashboard');
        }

        // IPv6
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {

            if (!in_array($ip, $allowedIps)) {
                Auth::logout();
                return back()->withErrors([
                    'ip' => 'Your IPv6 address is not authorized'
                ]);
            }

            return redirect()->route('dashboard');
        }

        // ======================
        // FALLBACK BLOCK
        // ======================
        Auth::logout();
        return back()->withErrors([
            'ip' => 'Unknown network detected'
        ]);
    }
}
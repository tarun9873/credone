<?php

namespace App\Http\Controllers;

use App\Models\IpWhitelist;
use Illuminate\Http\Request;

class IpWhitelistController extends Controller
{
    /**
     * =================================================
     * IP LIST PAGE (ADMIN + SUPER ADMIN)
     * =================================================
     */
    public function index()
    {
        if (!in_array(auth()->user()->role, ['admin', 'super_admin'])) {
            abort(403);
        }

        $ips = IpWhitelist::latest()->get();
        return view('ip-whitelist.index', compact('ips'));
    }

    /**
     * =================================================
     * STORE IP + LABEL (IPv4 + IPv6)
     * =================================================
     */
    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|string|max:100',
            'ip_address' => [
                'required',
                'unique:ip_whitelists,ip_address',
                function ($attribute, $value, $fail) {
                    if (!filter_var($value, FILTER_VALIDATE_IP)) {
                        $fail('Please enter a valid IPv4 or IPv6 address.');
                    }
                }
            ],
        ]);

        IpWhitelist::create([
            'label'      => $request->label,
            'ip_address' => $request->ip_address,
        ]);

        return back()->with('success', 'IP address added successfully');
    }

    /**
     * =================================================
     * DELETE IP (SUPER ADMIN ONLY)
     * =================================================
     */
    public function destroy($id)
    {
        if (auth()->user()->role !== 'super_admin') {
            abort(403);
        }

        IpWhitelist::findOrFail($id)->delete();

        return back()->with('success', 'IP removed successfully');
    }
}
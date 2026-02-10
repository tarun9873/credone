<?php

namespace App\Http\Controllers;

use App\Models\IpWhitelist;
use Illuminate\Http\Request;

class IpWhitelistController extends Controller
{
    public function index()
    {
        if (!in_array(auth()->user()->role,['admin','super_admin'])) {
            abort(403);
        }

        $ips = IpWhitelist::latest()->get();
        return view('ip-whitelist.index',compact('ips'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ip_address' => [
                'required',
                'unique:ip_whitelists,ip_address',
                'ipv4'
            ]
        ]);

        IpWhitelist::create([
            'ip_address' => $request->ip_address
        ]);

        return back()->with('success','IP added');
    }

    public function destroy($id)
    {
        if (auth()->user()->role !== 'super_admin') {
            abort(403);
        }

        IpWhitelist::findOrFail($id)->delete();
        return back()->with('success','IP removed');
    }
}
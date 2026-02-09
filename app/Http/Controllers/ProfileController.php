<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // show data
    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    // save data
    public function update(Request $request)
{
    $user = auth()->user();

    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'nullable|min:6'
    ]);

    $user->name  = $request->name;
    $user->email = $request->email;

    // 🔐 ROLE IS NOT UPDATED AT ALL

    if ($request->password) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return back()->with('success', 'Profile updated successfully');
}

}
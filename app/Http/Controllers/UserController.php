<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create()
    {
        if(auth()->user()->role == 'employee'){
            abort(403);
        }
        return view('users.create');
    }

    public function store(Request $request)
    {
        if(auth()->user()->role == 'employee'){
            abort(403);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect('/dashboard')->with('success','User Created');
    }
}
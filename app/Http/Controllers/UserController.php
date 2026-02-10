<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function __construct()
    {
        // 🔒 Only Admin & Super Admin
        $this->middleware(function ($request, $next) {

            if (!auth()->check() || !in_array(auth()->user()->role, ['super_admin','admin'])) {
                abort(403, 'Unauthorized');
            }

            return $next($request);
        });
    }

    // 🔹 SHOW REGISTER EMPLOYEE FORM
    public function create()
    {
        return view('employees.create');
    }

    // 🔹 STORE EMPLOYEE
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        // 🔑 AUTO-GENERATE UNIQUE EMPLOYEE ID
        do {
            $employeeId = 'EMP-' . strtoupper(Str::random(6));
        } while (User::where('employee_id', $employeeId)->exists());

        User::create([
            'employee_id' => $employeeId,
            'name'        => $request->name,
            'email'       => $request->email,
            'password'    => Hash::make($request->password),

            // 🔒 Role FIXED
            'role'        => 'employee',
        ]);

        return redirect()
            ->route('employees.create')
            ->with('success', 'Employee registered successfully');
    }

    public function index()
{
    // ALL logged users can view
    $employees = User::where('role','employee')->get();
    return view('employees.index', compact('employees'));
}

public function destroy($id)
{
    // ❌ ONLY ADMIN CAN DELETE
    if(auth()->user()->role !== 'admin'){
        abort(403,'Only admin can delete employees');
    }

    User::findOrFail($id)->delete();

    return back()->with('success','Employee deleted');
}

}
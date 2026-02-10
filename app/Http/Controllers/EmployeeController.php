<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request; // ✅ 🔥 THIS WAS MISSING

class EmployeeController extends Controller
{
    /**
     * LIST → admin & super_admin
     */
    public function index(Request $request)
    {
        if (!in_array(auth()->user()->role, ['admin','super_admin'])) {
            abort(403);
        }

        $employees = User::where('role', 'employee')
            ->when($request->search, function ($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%')
                  ->orWhere('employee_id', 'like', '%'.$request->search.'%');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString(); // pagination + search maintain

        return view('employees.index', compact('employees'));
    }

    /**
     * VIEW → admin & super_admin
     */
    public function show($id)
    {
        if (!in_array(auth()->user()->role, ['admin','super_admin'])) {
            abort(403);
        }

        $employee = User::where('role','employee')->findOrFail($id);

        return view('employees.show', compact('employee'));
    }

    /**
     * DELETE → admin only
     */
    public function destroy($id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        User::where('role','employee')->findOrFail($id)->delete();

        return redirect()
            ->route('employees.index')
            ->with('success','Employee deleted');
    }
}
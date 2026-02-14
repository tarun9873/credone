<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;



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
       if (!in_array(auth()->user()->role, ['admin','super_admin'])) {
    abort(403);
}


        User::where('role','employee')->findOrFail($id)->delete();

        return redirect()
            ->route('employees.index')
            ->with('success','Employee deleted');
    }

    /**
 * LOGIN AS EMPLOYEE (ADMIN / SUPER ADMIN)
 */
public function loginAsEmployee($id)
{
    // if (!in_array(auth()->user()->role, ['admin','super_admin'])) {
    //     abort(403);
    // }

    if (auth()->user()->role !== 'super_admin') {
    abort(403);
}


    $employee = User::where('role','employee')->findOrFail($id);

    // 🧠 Store original admin ID
    Session::put('impersonator_id', auth()->id());

    // 🔄 Login as employee
    Auth::login($employee);

    return redirect()->route('dashboard')
        ->with('success', 'Logged in as '.$employee->name);
}

public function returnToAdmin()
{
    if (!Session::has('impersonator_id')) {
        abort(403);
    }

    $adminId = Session::get('impersonator_id');

    Session::forget('impersonator_id');

    Auth::loginUsingId($adminId);

    return redirect()->route('dashboard')
        ->with('success', 'Returned to Admin account');
}

}
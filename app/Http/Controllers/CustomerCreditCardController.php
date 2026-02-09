<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerCreditCard;

class CustomerCreditCardController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'dob' => 'nullable|date',
            'pan_number' => 'nullable|string',
            'mother_name' => 'nullable|string',
            'resi_address' => 'nullable|string',
            'mobile_number' => 'nullable|string',
            'email' => 'nullable|email',
            'company_name' => 'nullable|string',
            'designation' => 'nullable|string',
        ]);

        CustomerCreditCard::create($request->all());

        return back()->with('success', 'Customer credit card data saved successfully');
    }

    public function index(Request $request)
{
    $customers = CustomerCreditCard::when($request->search, function ($q) use ($request) {
            $q->where('name', 'like', '%'.$request->search.'%')
              ->orWhere('email', 'like', '%'.$request->search.'%')
              ->orWhere('mobile_number', 'like', '%'.$request->search.'%')
              ->orWhere('pan_number', 'like', '%'.$request->search.'%');
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

    return view('all-clientdata', compact('customers'));
}


public function updateStatus(Request $request, $id)
{
    abort_unless(in_array(auth()->user()->role,['admin','super_admin']),403);

    CustomerCreditCard::where('id',$id)
        ->update(['status'=>$request->status]);

    return back();
}
public function edit($id)
{
    $customer = CustomerCreditCard::findOrFail($id);

    return view('customer.edit', compact('customer'));
}

public function update(Request $request, $id)
{
    CustomerCreditCard::findOrFail($id)->update([
        'name'          => $request->name,
        'email'         => $request->email,
        'mobile_number' => $request->mobile_number,
        'dob'           => $request->dob,
        'pan_number'    => $request->pan_number,
        'mother_name'   => $request->mother_name,
        'resi_address'  => $request->resi_address,
        'company_name'  => $request->company_name,
        'designation'   => $request->designation,
    ]);

    return redirect()
        ->route('customers.index')
        ->with('success', 'Customer updated successfully');
}



public function storeFromWordpress(Request $request)
{
    // optional: basic security
    if ($request->header('X-APP-KEY') !== 'MY_SECRET_KEY_123') {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    CustomerCreditCard::create([
        'name'          => $request->name,
        'dob'           => $request->dob,
        'pan_number'    => $request->pan,
        'mother_name'   => $request->mother_name,
        'mobile_number' => $request->mobile,
        'email'         => $request->email,
        'company_name'  => $request->company,
        'designation'   => $request->designation,
        'resi_address'  => $request->address,
        'status'        => 'pending',
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Customer saved successfully'
    ]);
}
}
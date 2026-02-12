<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerCreditCard;

class CustomerCreditCardController extends Controller
{
    /**
     * =================================================
     * PANEL DATA STORE (ALL ROLES)
     * =================================================
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string',
            'mobile_number' => 'required|string',
        ]);

        CustomerCreditCard::create([
            'user_id'       => auth()->id(),   // 🔐 owner
            'name'          => $request->name,
            'dob'           => $request->dob,
            'pan_number'    => $request->pan_number,
            'mother_name'   => $request->mother_name,
            'resi_address'  => $request->resi_address,
            'mobile_number' => $request->mobile_number,
            'email'         => $request->email,
            'company_name'  => $request->company_name,
            'designation'   => $request->designation,
            'status'        => 'pending',
        ]);

        return back()->with('success', 'Data saved successfully');
    }

    /**
     * =================================================
     * WORDPRESS DATA STORE (NO USER)
     * =================================================
     */
    public function storeFromWordpress(Request $request)
    {
        if ($request->header('X-APP-KEY') !== 'MY_SECRET_KEY_123') {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        CustomerCreditCard::create([
            'user_id'       => null, // 🌐 WordPress
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
            'message' => 'Saved from WordPress',
        ]);
    }

    /*
|--------------------------------------------------------------------------
| WORDPRESS DATA – ADMIN / SUPER ADMIN ONLY
|--------------------------------------------------------------------------
*/

public function wordpressIndex()
{
    abort_unless(
        in_array(auth()->user()->role, ['admin','super_admin']),
        403
    );

    $customers = CustomerCreditCard::whereNull('user_id')
        ->latest()
        ->paginate(10);

    return view('wordpress.index', compact('customers'));
}

public function wordpressEdit($id)
{
    abort_unless(
        in_array(auth()->user()->role, ['admin','super_admin']),
        403
    );

    $customer = CustomerCreditCard::whereNull('user_id')->findOrFail($id);

    return view('wordpress.edit', compact('customer'));
}

public function wordpressUpdate(Request $request, $id)
{
    abort_unless(
        in_array(auth()->user()->role, ['admin','super_admin']),
        403
    );

    $customer = CustomerCreditCard::whereNull('user_id')->findOrFail($id);

    $customer->update($request->only([
        'name',
        'email',
        'mobile_number',
        'pan_number',
        'dob',
        'mother_name',
        'resi_address',
        'company_name',
        'designation',
        'status',
    ]));

    return redirect()
        ->route('wordpress.customers.index')
        ->with('success', 'WordPress customer updated');
}

public function wordpressDestroy($id)
{
    abort_unless(
        in_array(auth()->user()->role, ['admin','super_admin']),
        403
    );

    CustomerCreditCard::whereNull('user_id')->findOrFail($id)->delete();

    return back()->with('success', 'WordPress customer deleted');
}


    /**
     * =================================================
     * LIST → 🔒 ONLY OWN DATA (ALL ROLES)
     * =================================================
     */
  public function index(Request $request)
{
    // 🔍 SEARCH
    $search = $request->search;

    /*
    |--------------------------------------------------------------------------
    | PANEL DATA (Logged-in user ka apna data)
    |--------------------------------------------------------------------------
    */
    $panelCustomers = CustomerCreditCard::whereNotNull('user_id')
        ->where('user_id', auth()->id())
        ->when($search, function ($q) use ($search) {
            $q->where('name', 'like', "%$search%")
              ->orWhere('email', 'like', "%$search%")
              ->orWhere('mobile_number', 'like', "%$search%")
              ->orWhere('pan_number', 'like', "%$search%");
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

    /*
    |--------------------------------------------------------------------------
    | WORDPRESS DATA (sirf admin / super_admin dekh sakta)
    |--------------------------------------------------------------------------
    */
    $wpCustomers = collect(); // empty by default

    if (in_array(auth()->user()->role, ['admin', 'super_admin'])) {
        $wpCustomers = CustomerCreditCard::whereNull('user_id')
            ->latest()
            ->get();
    }

    return view('all-clientdata', compact('panelCustomers', 'wpCustomers'));
}

    public function edit($id)
{
    $customer = CustomerCreditCard::findOrFail($id);

    // sirf apna data
    if ($customer->user_id !== auth()->id()) {
        abort(403);
    }

    return view('customer.edit', compact('customer'));
}

public function update(Request $request, $id)
{
    $customer = CustomerCreditCard::findOrFail($id);

    if ($customer->user_id !== auth()->id()) {
        abort(403);
    }

    $customer->update($request->only([
        'name','email','mobile_number','pan_number',
        'dob','mother_name','resi_address',
        'company_name','designation'
    ]));

    return redirect()
        ->route('customers.index')
        ->with('success','Customer updated');
}

public function destroy($id)
{
    $customer = CustomerCreditCard::findOrFail($id);

    if ($customer->user_id !== auth()->id()) {
        abort(403);
    }

    $customer->delete();

    return back()->with('success','Deleted');
}
public function wordpressView($id)
{
    abort_unless(
        in_array(auth()->user()->role, ['admin','super_admin']),
        403
    );

    $customer = CustomerCreditCard::whereNull('user_id')->findOrFail($id);

    return response()->json($customer);
}

}
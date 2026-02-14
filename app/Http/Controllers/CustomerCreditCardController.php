<?php

namespace App\Http\Controllers;

use App\Models\CustomerCreditCard;
use App\Models\CustomerDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomerCreditCardController extends Controller
{

    /* ================= STORE (PANEL) ================= */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'mobile_number' => 'required|string',
            'documents.*' => 'nullable|file|max:5120'
        ]);

        $customer = CustomerCreditCard::create([
            'user_id'       => auth()->id(),
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

        $this->handleDocumentUpload($request, $customer);

        return back()->with('success', 'Customer saved successfully');
    }


    /* ================= VIEW (AJAX) ================= */
    public function view($id)
    {
        $customer = CustomerCreditCard::with('documents')->findOrFail($id);
        return response()->json($customer);
    }


    /* ================= EDIT (PANEL) ================= */
    public function edit($id)
    {
        $customer = CustomerCreditCard::with('documents')->findOrFail($id);

        if ($customer->user_id !== auth()->id()) {
            abort(403);
        }

        return view('customer.edit', compact('customer'));
    }


    /* ================= UPDATE (PANEL) ================= */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'mobile_number' => 'required|string',
            'documents.*' => 'nullable|file|max:5120'
        ]);

        $customer = CustomerCreditCard::findOrFail($id);

        if ($customer->user_id !== auth()->id()) {
            abort(403);
        }

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
            'status'
        ]));

        $this->handleDocumentUpload($request, $customer);

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer updated successfully');
    }


    /* ================= DELETE (PANEL) ================= */
    public function destroy($id)
    {
        $customer = CustomerCreditCard::with('documents')->findOrFail($id);

        if ($customer->user_id !== auth()->id()) {
            abort(403);
        }

        foreach ($customer->documents as $doc) {
            Storage::disk('public')->delete($doc->file_path);
        }

        $customer->delete();

        return back()->with('success', 'Deleted');
    }


    /* ================= DELETE DOCUMENT ================= */
    public function deleteDocument($id)
    {
        $doc = CustomerDocument::findOrFail($id);

        Storage::disk('public')->delete($doc->file_path);
        $doc->delete();

        return back()->with('success','Document deleted');
    }


    /* ================= INDEX ================= */
    public function index(Request $request)
    {
        $search = $request->search;

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

        $wpCustomers = collect();

        if (in_array(auth()->user()->role, ['admin','super_admin'])) {
            $wpCustomers = CustomerCreditCard::whereNull('user_id')
                ->latest()
                ->get();
        }

        return view('all-clientdata', compact('panelCustomers','wpCustomers'));
    }



    /* ================= WORDPRESS API STORE ================= */
public function storeFromWordpress(Request $request)
{
    if ($request->header('X-APP-KEY') !== 'MY_SECRET_KEY_123') {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    CustomerCreditCard::create([
        'user_id'       => null, // WordPress data
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
        'message' => 'Saved from WordPress'
    ]);
}

    /* ================= WORDPRESS INDEX ================= */
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


    /* ================= WORDPRESS EDIT ================= */
    public function wordpressEdit($id)
    {
        abort_unless(
            in_array(auth()->user()->role, ['admin','super_admin']),
            403
        );

        $customer = CustomerCreditCard::whereNull('user_id')
            ->with('documents')
            ->findOrFail($id);

        return view('wordpress.edit', compact('customer'));
    }


    /* ================= WORDPRESS UPDATE ================= */
    public function wordpressUpdate(Request $request, $id)
    {
        abort_unless(
            in_array(auth()->user()->role, ['admin','super_admin']),
            403
        );

        $customer = CustomerCreditCard::whereNull('user_id')
            ->findOrFail($id);

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
            'status'
        ]));

        return redirect()
            ->route('wordpress.customers.index')
            ->with('success', 'WordPress customer updated');
    }


    /* ================= WORDPRESS DELETE ================= */
    public function wordpressDestroy($id)
    {
        abort_unless(
            in_array(auth()->user()->role, ['admin','super_admin']),
            403
        );

        CustomerCreditCard::whereNull('user_id')
            ->findOrFail($id)
            ->delete();

        return back()->with('success', 'WordPress customer deleted');
    }


    /* ================= WORDPRESS VIEW ================= */
    public function wordpressView($id)
    {
        abort_unless(
            in_array(auth()->user()->role, ['admin','super_admin']),
            403
        );

        return response()->json(
            CustomerCreditCard::whereNull('user_id')
                ->with('documents')
                ->findOrFail($id)
        );
    }


    /* ================= DOCUMENT HANDLER ================= */
    private function handleDocumentUpload(Request $request, $customer)
    {
        if (!$request->hasFile('documents')) {
            return;
        }

        foreach ($request->file('documents') as $file) {

            if (!$file->isValid()) continue;

            $path = $file->store('customer-documents', 'public');

            CustomerDocument::create([
                'customer_id' => $customer->id,
                'file_path'   => $path
            ]);
        }
    }
}
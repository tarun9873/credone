@extends('app')

@section('title', 'Customer List')

@section('content')
<main class="app-wrapper">
<div class="container-fluid">

{{-- Header --}}
<div class="app-page-head mb-3">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">
          <i class="fi fi-rr-home"></i> Home
        </a>
      </li>
      <li class="breadcrumb-item active">Customers</li>
    </ol>
  </nav>
</div>

{{-- Search --}}
<form method="GET" action="{{ route('customers.index') }}" class="mb-3">
  <div class="row g-2">
    <div class="col-md-4">
      <input type="text" name="search" class="form-control"
        placeholder="Search name / email / mobile / PAN"
        value="{{ request('search') }}">
    </div>
    <div class="col-md-2">
      <button class="btn btn-primary">Search</button>
    </div>
  </div>
</form>

{{-- Table --}}
<div class="card">
  <div class="card-body table-responsive">
@if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close"></button>
  </div>
@endif

    <table class="table table-hover align-middle">
      <thead class="table-light">
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Mobile</th>
          <th>PAN</th>
          <th>Company</th>
          <th>Status</th>
          <th class="text-end">Action</th>
        </tr>
      </thead>

      <tbody>
      @forelse($customers as $customer)
        <tr>

          <td>{{ $customer->name }}</td>
          <td>{{ $customer->email ?? '—' }}</td>
          <td>{{ $customer->mobile_number ?? '—' }}</td>
          <td>{{ $customer->pan_number ?? '—' }}</td>
          <td>{{ $customer->company_name ?? '—' }}</td>

          {{-- STATUS --}}
          <td>
            @if(in_array(auth()->user()->role, ['admin','super_admin']))
              <form method="POST"
                    action="{{ url('/customers/status/'.$customer->id) }}">
                @csrf
                <select name="status"
                        class="form-select form-select-sm"
                        onchange="this.form.submit()">
                  <option value="pending"  @selected($customer->status=='pending')>Pending</option>
                  <option value="approved" @selected($customer->status=='approved')>Approved</option>
                  <option value="review"   @selected($customer->status=='review')>Review</option>
                </select>
              </form>
            @else
              <span class="badge bg-secondary text-capitalize">
                {{ $customer->status }}
              </span>
            @endif
          </td>

          {{-- ACTION --}}
          <td class="text-end">
            <button class="btn btn-sm btn-light"
              data-bs-toggle="modal"
              data-bs-target="#viewModal{{ $customer->id }}">
              View
            </button>

            @if(in_array(auth()->user()->role, ['admin','super_admin']))
              <a href="{{ url('/customers/edit/'.$customer->id) }}"
   class="btn btn-sm btn-warning">
   Edit
</a>


              <form method="POST"
                    action="{{ url('/customers/delete/'.$customer->id) }}"
                    class="d-inline"
                    onsubmit="return confirm('Delete this customer?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger">Delete</button>
              </form>
            @endif
          </td>

        </tr>

        {{-- VIEW MODAL --}}
        <div class="modal fade"
             id="viewModal{{ $customer->id }}"
             tabindex="-1">
          <div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-sm-down">
            <div class="modal-content">

              <div class="modal-header">
                <h5 class="modal-title">Customer Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>

              <div class="modal-body">
                <div class="row g-3">
                  <div class="col-md-6"><strong>Name:</strong> {{ $customer->name }}</div>
                  <div class="col-md-6"><strong>Email:</strong> {{ $customer->email }}</div>
                  <div class="col-md-6"><strong>Mobile:</strong> {{ $customer->mobile_number }}</div>
                  <div class="col-md-6"><strong>PAN:</strong> {{ $customer->pan_number }}</div>
                  <div class="col-md-6"><strong>DOB:</strong> {{ $customer->dob }}</div>
                  <div class="col-md-6"><strong>Mother:</strong> {{ $customer->mother_name }}</div>
                  <div class="col-md-12"><strong>Address:</strong> {{ $customer->resi_address }}</div>
                  <div class="col-md-6"><strong>Company:</strong> {{ $customer->company_name }}</div>
                  <div class="col-md-6"><strong>Designation:</strong> {{ $customer->designation }}</div>
                </div>
              </div>

              <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>

            </div>
          </div>
        </div>

      @empty
        <tr>
          <td colspan="7" class="text-center text-muted py-4">
            No customer data found
          </td>
        </tr>
      @endforelse
      </tbody>

    </table>

  </div>
</div>

{{-- Pagination --}}
<div class="mt-3">
  {{ $customers->links('pagination::bootstrap-5') }}
</div>

</div>
</main>
@endsection

@extends('app')

@section('title', 'My Customers')

@section('content')
<main class="app-wrapper">
<div class="container-fluid">

{{-- ================= PANEL DATA ================= --}}
<div class="app-page-head mb-3">
  <h4 class="mb-0">My Customer Data</h4>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
  {{ session('success') }}
  <button class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card mb-4">
<div class="card-body table-responsive">

<table class="table table-hover align-middle">
<thead class="table-light">
<tr>
  <th>#</th>
  <th>Name</th>
  <th>Email</th>
  <th>Mobile</th>
  <th>PAN</th>
  <th>Status</th>
  <th>Created At</th>
  <th class="text-end">Action</th>
</tr>
</thead>

<tbody>
@forelse($panelCustomers as $customer)
<tr>
  <td>{{ $loop->iteration }}</td>
  <td>{{ $customer->name }}</td>
  <td>{{ $customer->email ?? '—' }}</td>
  <td>{{ $customer->mobile_number ?? '—' }}</td>
  <td>{{ $customer->pan_number ?? '—' }}</td>

  <td>
    <span class="badge bg-secondary text-capitalize">
      {{ $customer->status }}
    </span>
  </td>

  <td>
    <div class="fw-semibold">
      {{ $customer->created_at->format('d M Y') }}
    </div>
    <small class="text-muted">
      {{ $customer->created_at->format('h:i A') }}
    </small>
  </td>

  <td class="text-end">

    {{-- ✅ VIEW BUTTON (ADDED) --}}
    <button
      type="button"
      class="btn btn-sm btn-info viewBtn"
      data-name="{{ $customer->name ?? '' }}"
      data-email="{{ $customer->email ?? '' }}"
      data-mobile="{{ $customer->mobile_number ?? '' }}"
      data-pan="{{ $customer->pan_number ?? '' }}"
      data-dob="{{ $customer->dob ?? '' }}"
      data-mother="{{ $customer->mother_name ?? '' }}"
      data-address="{{ $customer->resi_address ?? '' }}"
      data-company="{{ $customer->company_name ?? '' }}"
      data-designation="{{ $customer->designation ?? '' }}"
      data-status="{{ $customer->status ?? '' }}"
      data-created="{{ optional($customer->created_at)->format('d M Y, h:i A') }}"
      data-bs-toggle="modal"
      data-bs-target="#viewCustomerModal"
    >
      View
    </button>

    <a href="{{ url('/customers/edit/'.$customer->id) }}"
       class="btn btn-sm btn-warning">
       Edit
    </a>

    <form method="POST"
          action="{{ url('/customers/delete/'.$customer->id) }}"
          class="d-inline"
          onsubmit="return confirm('Delete this record?')">
      @csrf
      @method('DELETE')
      <button class="btn btn-sm btn-danger">
        Delete
      </button>
    </form>
  </td>
</tr>

@empty
<tr>
  <td colspan="8" class="text-center text-muted py-4">
    No panel data found
  </td>
</tr>
@endforelse
</tbody>
</table>

</div>
</div>

</div>
</main>

{{-- ===========================
     VIEW CUSTOMER MODAL
=========================== --}}
<div class="modal fade" id="viewCustomerModal" tabindex="-1">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Customer Full Details</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <table class="table table-bordered">
          <tr><th>Name</th><td id="v-name"></td></tr>
          <tr><th>Email</th><td id="v-email"></td></tr>
          <tr><th>Mobile</th><td id="v-mobile"></td></tr>
          <tr><th>PAN</th><td id="v-pan"></td></tr>
          <tr><th>DOB</th><td id="v-dob"></td></tr>
          <tr><th>Mother Name</th><td id="v-mother"></td></tr>
          <tr><th>Address</th><td id="v-address"></td></tr>
          <tr><th>Company</th><td id="v-company"></td></tr>
          <tr><th>Designation</th><td id="v-designation"></td></tr>
          <tr><th>Status</th><td id="v-status"></td></tr>
          <tr><th>Created At</th><td id="v-created"></td></tr>
        </table>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">
          Close
        </button>
      </div>

    </div>
  </div>
</div>
@endsection

{{-- ===========================
     MODAL DATA SCRIPT
=========================== --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

  document.querySelectorAll('.viewBtn').forEach(function (btn) {

    btn.addEventListener('click', function () {

      document.getElementById('v-name').textContent        = this.dataset.name || '—';
      document.getElementById('v-email').textContent       = this.dataset.email || '—';
      document.getElementById('v-mobile').textContent      = this.dataset.mobile || '—';
      document.getElementById('v-pan').textContent         = this.dataset.pan || '—';
      document.getElementById('v-dob').textContent         = this.dataset.dob || '—';
      document.getElementById('v-mother').textContent      = this.dataset.mother || '—';
      document.getElementById('v-address').textContent     = this.dataset.address || '—';
      document.getElementById('v-company').textContent     = this.dataset.company || '—';
      document.getElementById('v-designation').textContent = this.dataset.designation || '—';
      document.getElementById('v-status').textContent      = this.dataset.status || '—';
      document.getElementById('v-created').textContent     = this.dataset.created || '—';

    });

  });

});
</script>
@endpush

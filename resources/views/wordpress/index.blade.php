@extends('app')

@section('title','WordPress Customers')

@section('content')
<main class="app-wrapper">
<div class="container-fluid">

<h4 class="mb-3">Website Data</h4>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
  {{ session('success') }}
  <button class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card">
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
@forelse($customers as $customer)
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

    {{-- 🔥 VIEW BUTTON --}}
    <button
      class="btn btn-sm btn-info"
      data-bs-toggle="modal"
      data-bs-target="#viewCustomerModal"
      data-name="{{ $customer->name }}"
      data-email="{{ $customer->email }}"
      data-mobile="{{ $customer->mobile_number }}"
      data-pan="{{ $customer->pan_number }}"
      data-status="{{ $customer->status }}"
      data-created="{{ $customer->created_at->format('d M Y, h:i A') }}"
    >
      View
    </button>

    <a href="{{ route('wordpress.customers.edit',$customer->id) }}"
       class="btn btn-sm btn-warning">
      Edit
    </a>

    <form method="POST"
          action="{{ route('wordpress.customers.delete',$customer->id) }}"
          class="d-inline"
          onsubmit="return confirm('Delete this record?')">
      @csrf
      @method('DELETE')
      <button class="btn btn-sm btn-danger">Delete</button>
    </form>
  </td>
</tr>

@empty
<tr>
  <td colspan="8" class="text-center text-muted py-4">
    No data found
  </td>
</tr>
@endforelse
</tbody>
</table>

</div>
</div>

<div class="mt-3">
  {{ $customers->links('pagination::bootstrap-5') }}
</div>

</div>
</main>

{{-- ===========================
     VIEW CUSTOMER MODAL
=========================== --}}
<div class="modal fade" id="viewCustomerModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Customer Details</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <table class="table table-bordered">
          <tr>
            <th width="30%">Name</th>
            <td id="view-name"></td>
          </tr>
          <tr>
            <th>Email</th>
            <td id="view-email"></td>
          </tr>
          <tr>
            <th>Mobile</th>
            <td id="view-mobile"></td>
          </tr>
          <tr>
            <th>PAN</th>
            <td id="view-pan"></td>
          </tr>
          <tr>
            <th>Status</th>
            <td id="view-status"></td>
          </tr>
          <tr>
            <th>Created At</th>
            <td id="view-created"></td>
          </tr>
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

  const modal = document.getElementById('viewCustomerModal');

  modal.addEventListener('show.bs.modal', function (event) {

    const btn = event.relatedTarget;

    document.getElementById('view-name').innerText    = btn.getAttribute('data-name');
    document.getElementById('view-email').innerText   = btn.getAttribute('data-email') || '—';
    document.getElementById('view-mobile').innerText  = btn.getAttribute('data-mobile') || '—';
    document.getElementById('view-pan').innerText     = btn.getAttribute('data-pan') || '—';
    document.getElementById('view-status').innerText  = btn.getAttribute('data-status');
    document.getElementById('view-created').innerText = btn.getAttribute('data-created');

  });

});
</script>
@endpush

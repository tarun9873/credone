@extends('app')

@section('title','WordPress Customers')

@section('content')
<main class="app-wrapper">
<div class="container-fluid">

<h4 class="mb-3">WordPress Customer Data</h4>

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
  <th>Created</th>
  <th class="text-end">Action</th>
</tr>
</thead>

<tbody>
@foreach($customers as $customer)
<tr>
  <td>{{ $loop->iteration }}</td>
  <td>{{ $customer->name }}</td>
  <td>{{ $customer->email ?? '—' }}</td>
  <td>{{ $customer->mobile_number }}</td>
  <td>{{ $customer->pan_number ?? '—' }}</td>

  <td>
    <span class="badge bg-secondary">
      {{ $customer->status }}
    </span>
  </td>

  <td>
    {{ $customer->created_at->format('d M Y h:i A') }}
  </td>

  <td class="text-end">
    <button class="btn btn-sm btn-info"
      data-bs-toggle="modal"
      data-bs-target="#viewModal"
      data-id="{{ $customer->id }}">
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
@endforeach
</tbody>
</table>

</div>
</div>

{{ $customers->links('pagination::bootstrap-5') }}

</div>
</main>

{{-- ================= VIEW MODAL ================= --}}
<div class="modal fade" id="viewModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Customer Full Details</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <table class="table table-bordered">
          <tr><th width="200">Name</th><td id="v_name"></td></tr>
          <tr><th>Email</th><td id="v_email"></td></tr>
          <tr><th>Mobile</th><td id="v_mobile"></td></tr>
          <tr><th>PAN</th><td id="v_pan"></td></tr>
          <tr><th>DOB</th><td id="v_dob"></td></tr>
          <tr><th>Mother Name</th><td id="v_mother"></td></tr>
          <tr><th>Address</th><td id="v_address"></td></tr>
          <tr><th>Company</th><td id="v_company"></td></tr>
          <tr><th>Designation</th><td id="v_designation"></td></tr>
          <tr><th>Status</th><td id="v_status"></td></tr>
          <tr><th>Created</th><td id="v_created"></td></tr>
        </table>
      </div>

    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('viewModal')
.addEventListener('show.bs.modal', function (event) {

  let button = event.relatedTarget;
  let id = button.getAttribute('data-id');

  fetch(`/wordpress/customers/${id}/view`)
    .then(res => res.json())
    .then(data => {
      v_name.innerText = data.name;
      v_email.innerText = data.email ?? '—';
      v_mobile.innerText = data.mobile_number;
      v_pan.innerText = data.pan_number ?? '—';
      v_dob.innerText = data.dob ?? '—';
      v_mother.innerText = data.mother_name ?? '—';
      v_address.innerText = data.resi_address ?? '—';
      v_company.innerText = data.company_name ?? '—';
      v_designation.innerText = data.designation ?? '—';
      v_status.innerText = data.status;
      v_created.innerText = new Date(data.created_at).toLocaleString();
    });
});


fetch(`${VIEW_URL}/${id}/view`)
  .then(res => res.json())
  .then(data => {
    console.log(data); // 🔥 VERY IMPORTANT

    v_name.innerText = data.name;
    v_email.innerText = data.email ?? '—';
    v_mobile.innerText = data.mobile_number ?? '—';
  });

</script>
@endpush

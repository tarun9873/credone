@extends('app')

@section('title','WordPress Customers')

@section('content')
<main class="app-wrapper">
<div class="container-fluid">

<h4 class="mb-3">WordPress Customers</h4>

<div class="card">
<div class="card-body table-responsive">

<table class="table table-hover align-middle">
<thead class="table-light">
<tr>
  <th>#</th>
  <th>Name</th>
  <th>Email</th>
  <th>Mobile</th>
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
  <td>{{ $customer->status }}</td>
  <td>{{ $customer->created_at->format('d M Y h:i A') }}</td>

  <td class="text-end">
    <button
      class="btn btn-sm btn-info viewBtn"
      data-id="{{ $customer->id }}"
      data-bs-toggle="modal"
      data-bs-target="#viewModal">
      View
    </button>
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
        <h5 class="modal-title">Customer Details</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <table class="table table-bordered">
          <tr><th width="200">Name</th><td id="v_name"></td></tr>
          <tr><th>Email</th><td id="v_email"></td></tr>
          <tr><th>Mobile</th><td id="v_mobile"></td></tr>
          <tr><th>PAN</th><td id="v_pan"></td></tr>
          <tr><th>DOB</th><td id="v_dob"></td></tr>
          <tr><th>Mother</th><td id="v_mother"></td></tr>
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
/*
|--------------------------------------------------------------------------
| SAFE JS (theme crash-proof)
|--------------------------------------------------------------------------
*/
document.addEventListener('DOMContentLoaded', function () {

  const modal = document.getElementById('viewModal');
  if (!modal) return; // 🔥 important

  modal.addEventListener('show.bs.modal', function (event) {

    const button = event.relatedTarget;
    if (!button) return;

    const id = button.getAttribute('data-id');
    if (!id) return;

    fetch("{{ route('wordpress.customers.view','') }}/" + id)
      .then(response => response.json())
      .then(data => {

        document.getElementById('v_name').innerText = data.name ?? '—';
        document.getElementById('v_email').innerText = data.email ?? '—';
        document.getElementById('v_mobile').innerText = data.mobile_number ?? '—';
        document.getElementById('v_pan').innerText = data.pan_number ?? '—';
        document.getElementById('v_dob').innerText = data.dob ?? '—';
        document.getElementById('v_mother').innerText = data.mother_name ?? '—';
        document.getElementById('v_address').innerText = data.resi_address ?? '—';
        document.getElementById('v_company').innerText = data.company_name ?? '—';
        document.getElementById('v_designation').innerText = data.designation ?? '—';
        document.getElementById('v_status').innerText = data.status ?? '—';
        document.getElementById('v_created').innerText =
          new Date(data.created_at).toLocaleString();
      })
      .catch(err => console.error(err));
  });

});
</script>
@endpush

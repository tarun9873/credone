@extends('app')

@section('title','WordPress Customers')

@section('content')
<div class="container-fluid">

<h4 class="mb-3">WordPress Customers</h4>

<table class="table table-bordered align-middle">
<thead>
<tr>
  <th>#</th>
  <th>Name</th>
  <th>Mobile</th>
  <th>Status</th>
  <th class="text-end">Action</th>
</tr>
</thead>

<tbody>
@foreach($customers as $customer)
<tr>
  <td>{{ $loop->iteration }}</td>
  <td>{{ $customer->name }}</td>
  <td>{{ $customer->mobile_number }}</td>
  <td>{{ $customer->status }}</td>
  <td class="text-end">
    <button
      class="btn btn-sm btn-info viewCustomerBtn"
      data-id="{{ $customer->id }}"
      data-bs-toggle="modal"
      data-bs-target="#viewCustomerModal">
      View
    </button>
  </td>
</tr>
@endforeach
</tbody>
</table>

</div>

{{-- ================= MODAL ================= --}}
<div class="modal fade" id="viewCustomerModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Customer Details</h5>
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
        </table>
      </div>

    </div>
  </div>
</div>
@endsection


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

  document.querySelectorAll('.viewCustomerBtn').forEach(btn => {

    btn.addEventListener('click', function () {

      const id = this.dataset.id;

      fetch("{{ url('/wordpress/customers/view') }}/" + id)
        .then(res => res.json())
        .then(data => {

          document.getElementById('v-name').innerText        = data.name ?? '—';
          document.getElementById('v-email').innerText       = data.email ?? '—';
          document.getElementById('v-mobile').innerText      = data.mobile_number ?? '—';
          document.getElementById('v-pan').innerText         = data.pan_number ?? '—';
          document.getElementById('v-dob').innerText         = data.dob ?? '—';
          document.getElementById('v-mother').innerText      = data.mother_name ?? '—';
          document.getElementById('v-address').innerText     = data.resi_address ?? '—';
          document.getElementById('v-company').innerText     = data.company_name ?? '—';
          document.getElementById('v-designation').innerText = data.designation ?? '—';
          document.getElementById('v-status').innerText      = data.status ?? '—';

        })
        .catch(() => alert('Failed to load data'));

    });

  });

});
</script>
@endpush

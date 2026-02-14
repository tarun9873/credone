@extends('app')

@section('title', 'My Customers')

@section('content')
<main class="app-wrapper">
<div class="container-fluid">

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

    {{-- VIEW BUTTON --}}
    <button type="button"
            class="btn btn-sm btn-info viewBtn"
            data-id="{{ $customer->id }}"
            data-bs-toggle="modal"
            data-bs-target="#viewCustomerModal">
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

{{-- ================= VIEW MODAL ================= --}}
<div class="modal fade" id="viewCustomerModal" tabindex="-1">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Customer Full Details</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <div id="customerDetails"></div>

        <hr>

        <h6>Uploaded Documents</h6>
        <div id="customerDocuments" class="row"></div>

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


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

  document.querySelectorAll('.viewBtn').forEach(function (btn) {

    btn.addEventListener('click', function () {

      const customerId = this.dataset.id;

      // 🔥 SHOW LOADING MESSAGE
      document.getElementById('customerDetails').innerHTML =
        '<div class="text-center p-4">Loading customer data...</div>';

      document.getElementById('customerDocuments').innerHTML = '';

      fetch(`/customers/${customerId}/view`)
        .then(res => res.json())
        .then(data => {

          // ===== CUSTOMER DETAILS =====
          document.getElementById('customerDetails').innerHTML = `
            <table class="table table-bordered">
              <tr><th>Name</th><td>${data.name ?? '—'}</td></tr>
              <tr><th>Email</th><td>${data.email ?? '—'}</td></tr>
              <tr><th>Mobile</th><td>${data.mobile_number ?? '—'}</td></tr>
              <tr><th>PAN</th><td>${data.pan_number ?? '—'}</td></tr>
              <tr><th>DOB</th><td>${data.dob ?? '—'}</td></tr>
              <tr><th>Mother Name</th><td>${data.mother_name ?? '—'}</td></tr>
              <tr><th>Address</th><td>${data.resi_address ?? '—'}</td></tr>
              <tr><th>Company</th><td>${data.company_name ?? '—'}</td></tr>
              <tr><th>Designation</th><td>${data.designation ?? '—'}</td></tr>
              <tr><th>Status</th><td>${data.status ?? '—'}</td></tr>
              <tr><th>Created At</th><td>${data.created_at ?? '—'}</td></tr>
            </table>
          `;

          // ===== DOCUMENTS SECTION =====
          let docsHtml = '';

          if (data.documents && data.documents.length > 0) {

            data.documents.forEach(doc => {

              const fileUrl = `/storage/${doc.file_path}`;
              const extension = doc.file_path.split('.').pop().toLowerCase();

              // 🔥 IMAGE PREVIEW
              if (['jpg','jpeg','png','gif','webp'].includes(extension)) {

                docsHtml += `
                  <div class="col-md-3 mb-3">
                    <div class="card">
                      <img src="${fileUrl}" 
                           class="card-img-top"
                           style="height:150px;object-fit:cover;">
                      <div class="card-body text-center p-2">
                        <a href="${fileUrl}" target="_blank"
                           class="btn btn-sm btn-primary w-100">
                           Open
                        </a>
                      </div>
                    </div>
                  </div>
                `;

              } else {

                // 🔥 NON IMAGE FILE
                docsHtml += `
                  <div class="col-md-3 mb-3">
                    <div class="card p-3 text-center">
                      <i class="fi fi-rr-file fs-3"></i>
                      <p class="small mt-2">${extension.toUpperCase()} File</p>
                      <a href="${fileUrl}" target="_blank"
                         class="btn btn-sm btn-outline-primary">
                         Open File
                      </a>
                    </div>
                  </div>
                `;
              }

            });

          } else {
            docsHtml = `
              <div class="text-center text-muted p-3">
                No documents uploaded
              </div>
            `;
          }

          document.getElementById('customerDocuments').innerHTML = docsHtml;

        })
        .catch(() => {
          document.getElementById('customerDetails').innerHTML =
            '<div class="text-danger text-center p-3">Failed to load data</div>';
        });

    });

  });

});
</script>
@endpush

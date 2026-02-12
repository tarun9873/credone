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
  <th>Created At</th> {{-- 🔥 DATE + TIME --}}
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

  {{-- ✅ DATE + TIME --}}
  <td>
    <div class="fw-semibold">
      {{ $customer->created_at->format('d M Y') }}
    </div>
    <small class="text-muted">
      {{ $customer->created_at->format('h:i A') }}
    </small>
  </td>

  <td class="text-end">
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
@endsection

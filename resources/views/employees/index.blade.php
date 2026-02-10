@extends('app')

@section('title','Employees')

@section('content')
<main class="app-wrapper">
<div class="container-fluid">

{{-- HEADER --}}
<div class="app-page-head mb-3 d-flex justify-content-between align-items-center">
  <h4 class="mb-0">Employees</h4>
</div>

{{-- SUCCESS MESSAGE --}}
@if(session('success'))
  <div class="alert alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button class="btn-close" data-bs-dismiss="alert"></button>
  </div>
@endif

{{-- SEARCH (NAME + EMPLOYEE ID) --}}
<form method="GET" action="{{ route('employees.index') }}" class="mb-3">
  <div class="row g-2 align-items-center">
    <div class="col-md-4">
      <input type="text"
             name="search"
             value="{{ request('search') }}"
             class="form-control"
             placeholder="Search by Name or Employee ID">
    </div>

    <div class="col-md-2">
      <button class="btn btn-primary w-100">
        <i class="fi fi-rr-search"></i> Search
      </button>
    </div>

    @if(request('search'))
      <div class="col-md-2">
        <a href="{{ route('employees.index') }}"
           class="btn btn-outline-secondary w-100">
          Clear
        </a>
      </div>
    @endif
  </div>
</form>

{{-- TABLE --}}
<div class="card">
<div class="card-body table-responsive">

<table class="table table-hover align-middle">
  <thead class="table-light">
    <tr>
      <th>Employee ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Role</th>
      <th class="text-end">Action</th>
    </tr>
  </thead>

  <tbody>
  @forelse($employees as $employee)
    <tr>

      {{-- EMPLOYEE ID --}}
      <td>
        <span class="fw-semibold text-primary">
          {{ $employee->employee_id }}
        </span>
      </td>

      {{-- NAME --}}
      <td>{{ $employee->name }}</td>

      {{-- EMAIL --}}
      <td>{{ $employee->email }}</td>

      {{-- ROLE --}}
      <td>
        <span class="badge bg-info text-capitalize">
          {{ $employee->role }}
        </span>
      </td>

      {{-- ACTION --}}
      <td class="text-end">
        {{-- DELETE (ADMIN ONLY) --}}
        @if(auth()->user()->role === 'admin')
          <form method="POST"
                action="{{ route('employees.destroy',$employee->id) }}"
                class="d-inline"
                onsubmit="return confirm('Delete this employee?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger">
              Delete
            </button>
          </form>
        @else
          <span class="text-muted">—</span>
        @endif
      </td>

    </tr>
  @empty
    <tr>
      <td colspan="5" class="text-center text-muted py-4">
        No employees found
      </td>
    </tr>
  @endforelse
  </tbody>
</table>

</div>
</div>

{{-- PAGINATION --}}
<div class="mt-3">
  {{ $employees->links('pagination::bootstrap-5') }}
</div>

</div>
</main>
@endsection

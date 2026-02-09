@extends('app')

@section('title', 'Edit Customer')

@section('content')
<main class="app-wrapper">
  <div class="container-fluid">

    <div class="app-page-head mb-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">
              <i class="fi fi-rr-home"></i> Home
            </a>
          </li>
          <li class="breadcrumb-item">
            <a href="{{ route('customers.index') }}">Customers</a>
          </li>
          <li class="breadcrumb-item active">Edit</li>
        </ol>
      </nav>
    </div>

    <div class="card">
      <div class="card-header">
        <h6 class="card-title mb-0">Edit Customer Credit Card Details</h6>
      </div>

      <div class="card-body">
       <form method="POST" action="{{ route('customers.update', $customer->id) }}">
    @csrf
    @method('PUT')


          <div class="row g-3">

            {{-- Full Name --}}
            <div class="col-md-6">
              <label class="form-label">Full Name</label>
              <input type="text"
                     name="name"
                     class="form-control"
                     value="{{ $customer->name }}"
                     required>
            </div>

            {{-- Email --}}
            <div class="col-md-6">
              <label class="form-label">Email</label>
              <input type="email"
                     name="email"
                     class="form-control"
                     value="{{ $customer->email }}">
            </div>

            {{-- Mobile --}}
            <div class="col-md-6">
              <label class="form-label">Mobile Number</label>
              <input type="text"
                     name="mobile_number"
                     class="form-control"
                     value="{{ $customer->mobile_number }}">
            </div>

            {{-- DOB --}}
            <div class="col-md-6">
              <label class="form-label">Date of Birth</label>
              <input type="date"
                     name="dob"
                     class="form-control"
                     value="{{ $customer->dob }}">
            </div>

            {{-- PAN --}}
            <div class="col-md-6">
              <label class="form-label">PAN Number</label>
              <input type="text"
                     name="pan_number"
                     class="form-control"
                     value="{{ $customer->pan_number }}">
            </div>

            {{-- Mother Name --}}
            <div class="col-md-6">
              <label class="form-label">Mother's Name</label>
              <input type="text"
                     name="mother_name"
                     class="form-control"
                     value="{{ $customer->mother_name }}">
            </div>

            {{-- Address --}}
            <div class="col-md-12">
              <label class="form-label">Residential Address</label>
              <textarea name="resi_address"
                        class="form-control"
                        rows="3">{{ $customer->resi_address }}</textarea>
            </div>

            {{-- Company --}}
            <div class="col-md-6">
              <label class="form-label">Company Name</label>
              <input type="text"
                     name="company_name"
                     class="form-control"
                     value="{{ $customer->company_name }}">
            </div>

            {{-- Designation --}}
            <div class="col-md-6">
              <label class="form-label">Designation</label>
              <input type="text"
                     name="designation"
                     class="form-control"
                     value="{{ $customer->designation }}">
            </div>

            {{-- Status (Read Only) --}}
            <div class="col-md-6">
              <label class="form-label">Status</label>
              <input type="text"
                     class="form-control"
                     value="{{ ucfirst($customer->status) }}"
                     disabled>
            </div>

          </div>

          <div class="mt-4 text-end">
            <button type="submit" class="btn btn-primary">
              Update Customer
            </button>

            <a href="{{ route('customers.index') }}"
               class="btn btn-secondary">
              Back
            </a>
          </div>

        </form>
      </div>
    </div>

  </div>
</main>
@endsection

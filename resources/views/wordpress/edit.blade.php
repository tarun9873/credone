@extends('app')

@section('title','Edit WordPress Customer')

@section('content')
<main class="app-wrapper">
<div class="container-fluid">

<h4 class="mb-3">Edit Customer Data</h4>

<form method="POST"
      action="{{ route('wordpress.customers.update',$customer->id) }}">
@csrf
@method('PUT')

<div class="row g-3">
  {{-- NAME --}}
  <div class="col-md-6">
    <label class="form-label">Name</label>
    <input type="text"
           class="form-control"
           name="name"
           value="{{ $customer->name }}">
  </div>
  {{-- EMAIL --}}
  <div class="col-md-6">
    <label class="form-label">Email</label>
    <input type="email"
           class="form-control"
           name="email"
           value="{{ $customer->email }}">
  </div>
  {{-- MOBILE --}}
  <div class="col-md-6">
    <label class="form-label">Mobile Number</label>
    <input type="text"
           class="form-control"
           name="mobile_number"
           value="{{ $customer->mobile_number }}">
  </div>

  {{-- PAN --}}
  <div class="col-md-6">
    <label class="form-label">PAN Number</label>
    <input type="text"
           class="form-control"
           name="pan_number"
           value="{{ $customer->pan_number }}">
  </div>

  {{-- DOB --}}
  <div class="col-md-6">
    <label class="form-label">Date of Birth</label>
    <input type="date"
           class="form-control"
           name="dob"
           value="{{ $customer->dob }}">
  </div>

  {{-- MOTHER NAME --}}
  <div class="col-md-6">
    <label class="form-label">Mother Name</label>
    <input type="text"
           class="form-control"
           name="mother_name"
           value="{{ $customer->mother_name }}">
  </div>

  {{-- COMPANY --}}
  <div class="col-md-6">
    <label class="form-label">Company Name</label>
    <input type="text"
           class="form-control"
           name="company_name"
           value="{{ $customer->company_name }}">
  </div>

  {{-- DESIGNATION --}}
  <div class="col-md-6">
    <label class="form-label">Designation</label>
    <input type="text"
           class="form-control"
           name="designation"
           value="{{ $customer->designation }}">
  </div>

  {{-- ADDRESS --}}
  <div class="col-md-12">
    <label class="form-label">Residential Address</label>
    <textarea class="form-control"
              name="resi_address"
              rows="3">{{ $customer->resi_address }}</textarea>
  </div>

  {{-- STATUS --}}
  <div class="col-md-4">
    <label class="form-label">Status</label>
    <select name="status" class="form-select">
      <option value="pending" {{ $customer->status == 'pending' ? 'selected' : '' }}>
        Pending
      </option>
      <option value="approved" {{ $customer->status == 'approved' ? 'selected' : '' }}>
        Approved
      </option>
      <option value="rejected" {{ $customer->status == 'rejected' ? 'selected' : '' }}>
        Rejected
      </option>
    </select>
  </div>

</div>

<div class="mt-4">
  <button class="btn btn-primary">
    Update
  </button>

  <a href="{{ route('wordpress.customers.index') }}"
     class="btn btn-secondary">
     Back
  </a>
</div>

</form>

</div>
</main>
@endsection

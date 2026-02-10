@extends('app')

@section('title','Edit WordPress Customer')

@section('content')
<main class="app-wrapper">
<div class="container-fluid">

<h4 class="mb-3">Edit  Customer Data</h4>

<form method="POST"
      action="{{ route('wordpress.customers.update',$customer->id) }}">
@csrf
@method('PUT')

<div class="row g-3">
  <div class="col-md-6">
    <label>Name</label>
    <input class="form-control" name="name" value="{{ $customer->name }}">
  </div>

  <div class="col-md-6">
    <label>Email</label>
    <input class="form-control" name="email" value="{{ $customer->email }}">
  </div>

  <div class="col-md-6">
    <label>Mobile</label>
    <input class="form-control" name="mobile_number" value="{{ $customer->mobile_number }}">
  </div>

  <div class="col-md-6">
    <label>PAN</label>
    <input class="form-control" name="pan_number" value="{{ $customer->pan_number }}">
  </div>

  <div class="col-md-12">
    <label>Address</label>
    <textarea class="form-control" name="resi_address">{{ $customer->resi_address }}</textarea>
  </div>
</div>

<div class="mt-3">
  <button class="btn btn-primary">Update</button>
  <a href="{{ route('wordpress.customers.index') }}"
     class="btn btn-secondary">Back</a>
</div>

</form>

</div>
</main>
@endsection

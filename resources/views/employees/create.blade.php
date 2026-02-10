@extends('app')

@section('title','Register Employee')

@section('content')
<main class="app-wrapper">
<div class="container-fluid">

<h4 class="mb-3">Register Employee</h4>

{{-- SUCCESS --}}
@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

{{-- ERRORS --}}
@if($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<form method="POST" action="{{ route('employees.store') }}">
@csrf

<div class="row g-3">

  <div class="col-md-6">
    <label class="form-label">Full Name</label>
    <input type="text" name="name" class="form-control" required>
  </div>

  <div class="col-md-6">
    <label class="form-label">Email</label>
    <input type="email" name="email" class="form-control" required>
  </div>

  <div class="col-md-6">
    <label class="form-label">Password</label>
    <input type="password" name="password" class="form-control" required>
  </div>

</div>

<div class="mt-3">
  <button class="btn btn-primary">Register Employee</button>
</div>

</form>

</div>
</main>
@endsection

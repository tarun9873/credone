@extends('app')

@section('title', 'Dashboard')

@section('content')
<main class="app-wrapper">
<div class="container-fluid">

<div class="app-page-head">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">
          <i class="fi fi-rr-home"></i> Home
        </a>
      </li>
      <li class="breadcrumb-item active">Customer Form</li>
    </ol>
  </nav>
</div>

<div class="row">
<div class="col-xxl-12">
<div class="card">

<div class="card-header">
  <h6 class="card-title">Customer Credit Card Details</h6>
</div>

<div class="card-body">

@if(session('success'))
<div class="alert alert-success">
  {{ session('success') }}
</div>
@endif

<form class="row"
      method="POST"
      action="{{ route('customer.creditcard.save') }}"
      enctype="multipart/form-data">
@csrf

{{-- NAME --}}
<div class="col-md-6 mb-3">
  <label class="form-label">Name</label>
  <input type="text" name="name" class="form-control" required>
</div>

{{-- DOB --}}
<div class="col-md-6 mb-3">
  <label class="form-label">Date of Birth</label>
  <input type="date" name="dob" class="form-control">
</div>

{{-- PAN --}}
<div class="col-md-6 mb-3">
  <label class="form-label">PAN Number</label>
  <input type="text" name="pan_number" class="form-control">
</div>

{{-- MOTHER --}}
<div class="col-md-6 mb-3">
  <label class="form-label">Mother’s Name</label>
  <input type="text" name="mother_name" class="form-control">
</div>

{{-- ADDRESS --}}
<div class="col-12 mb-3">
  <label class="form-label">Residential Address</label>
  <input type="text" name="resi_address" class="form-control">
</div>

{{-- MOBILE --}}
<div class="col-md-6 mb-3">
  <label class="form-label">Mobile Number</label>
  <input type="text" name="mobile_number" class="form-control">
</div>

{{-- EMAIL --}}
<div class="col-md-6 mb-3">
  <label class="form-label">Email ID</label>
  <input type="email" name="email" class="form-control">
</div>

{{-- COMPANY --}}
<div class="col-md-6 mb-3">
  <label class="form-label">Company Name</label>
  <input type="text" name="company_name" class="form-control">
</div>

{{-- DESIGNATION --}}
<div class="col-md-6 mb-3">
  <label class="form-label">Designation</label>
  <input type="text" name="designation" class="form-control">
</div>

<hr>

{{-- DOCUMENT UPLOAD --}}
<div class="col-12 mb-3">
  <label class="form-label">Upload Documents (Multiple)</label>
  <input type="file"
         name="documents[]"
         id="documentInput"
         class="form-control"
         multiple>
</div>

{{-- PREVIEW AREA --}}
<div class="col-12">
  <div id="previewArea" class="row g-2"></div>
</div>

{{-- SUBMIT --}}
<div class="col-12 text-end mt-3">
  <button type="submit" class="btn btn-primary">
    Save Customer Data
  </button>
</div>

</form>

</div>
</div>
</div>
</div>

</div>
</main>
@endsection


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){

    const input = document.getElementById('documentInput');
    const preview = document.getElementById('previewArea');

    input.addEventListener('change', function(e){

        preview.innerHTML = '';

        Array.from(e.target.files).forEach(file => {

            const col = document.createElement('div');
            col.classList.add('col-md-3');

            const card = document.createElement('div');
            card.classList.add('border','p-2','text-center','rounded');

            if(file.type.startsWith('image/')){

                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.classList.add('img-fluid');
                img.style.maxHeight = '120px';
                card.appendChild(img);

            } else {
                card.innerHTML = `
                  <div class="p-3">
                    <i class="fi fi-rr-file"></i>
                    <p class="small mt-2">${file.name}</p>
                  </div>
                `;
            }

            col.appendChild(card);
            preview.appendChild(col);
        });

    });

});
</script>
@endpush

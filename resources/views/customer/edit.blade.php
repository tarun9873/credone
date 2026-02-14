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

@if ($errors->any())
<div class="alert alert-danger">
  <ul class="mb-0">
    @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

{{-- ================= MAIN UPDATE FORM ================= --}}
<form method="POST"
      action="{{ route('customers.update', $customer->id) }}"
      enctype="multipart/form-data">

@csrf
@method('PUT')

<div class="row g-3">

<div class="col-md-6">
  <label class="form-label">Full Name</label>
  <input type="text" name="name" class="form-control"
         value="{{ $customer->name }}" required>
</div>

<div class="col-md-6">
  <label class="form-label">Email</label>
  <input type="email" name="email" class="form-control"
         value="{{ $customer->email }}">
</div>

<div class="col-md-6">
  <label class="form-label">Mobile Number</label>
  <input type="text" name="mobile_number" class="form-control"
         value="{{ $customer->mobile_number }}">
</div>

<div class="col-md-6">
  <label class="form-label">Date of Birth</label>
  <input type="date" name="dob" class="form-control"
         value="{{ $customer->dob }}">
</div>

<div class="col-md-6">
  <label class="form-label">PAN Number</label>
  <input type="text" name="pan_number" class="form-control"
         value="{{ $customer->pan_number }}">
</div>

<div class="col-md-6">
  <label class="form-label">Mother's Name</label>
  <input type="text" name="mother_name" class="form-control"
         value="{{ $customer->mother_name }}">
</div>

<div class="col-md-12">
  <label class="form-label">Residential Address</label>
  <textarea name="resi_address"
            class="form-control"
            rows="3">{{ $customer->resi_address }}</textarea>
</div>

<div class="col-md-6">
  <label class="form-label">Company Name</label>
  <input type="text" name="company_name"
         class="form-control"
         value="{{ $customer->company_name }}">
</div>

<div class="col-md-6">
  <label class="form-label">Designation</label>
  <input type="text" name="designation"
         class="form-control"
         value="{{ $customer->designation }}">
</div>

<div class="col-md-6">
  <label class="form-label">Status</label>
  <select name="status" class="form-select">
    <option value="pending" {{ $customer->status == 'pending' ? 'selected' : '' }}>Pending</option>
    <option value="approved" {{ $customer->status == 'approved' ? 'selected' : '' }}>Approved</option>
    <option value="rejected" {{ $customer->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
  </select>
</div>

<div class="col-md-12 mt-3">
  <label class="form-label">Upload More Documents</label>
  <input type="file"
         name="documents[]"
         id="documentInput"
         class="form-control"
         multiple>
</div>

<div id="previewArea" class="row mt-3"></div>

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
{{-- ================= END UPDATE FORM ================= --}}

<hr class="my-4">

{{-- ================= EXISTING DOCUMENTS ================= --}}
<h6>Uploaded Documents</h6>

<div class="row">
@if($customer->documents->count())
  @foreach($customer->documents as $doc)
    @php
      $fileUrl = asset('storage/'.$doc->file_path);
      $extension = strtolower(pathinfo($doc->file_path, PATHINFO_EXTENSION));
    @endphp

    <div class="col-md-3 mb-3">
      <div class="card">

        @if(in_array($extension, ['jpg','jpeg','png','webp','gif']))
          <img src="{{ $fileUrl }}"
               class="card-img-top"
               style="height:150px;object-fit:cover;">
        @else
          <div class="p-4 text-center">
            <p class="small">{{ strtoupper($extension) }} File</p>
          </div>
        @endif

        <div class="card-body p-2 text-center">

          <a href="{{ $fileUrl }}"
             target="_blank"
             class="btn btn-sm btn-outline-primary w-100 mb-2">
             Open
          </a>

          {{-- SAFE DELETE FORM --}}
          <form method="POST"
                action="{{ route('documents.delete',$doc->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="btn btn-sm btn-danger w-100">
              Delete
            </button>
          </form>

        </div>
      </div>
    </div>

  @endforeach
@else
  <div class="text-muted">No documents uploaded</div>
@endif
</div>

</div>
</div>
</div>
</main>
@endsection


@push('scripts')
<script>
document.getElementById('documentInput')?.addEventListener('change', function(e){

  const preview = document.getElementById('previewArea');
  preview.innerHTML = '';

  Array.from(e.target.files).forEach(file => {

    const col = document.createElement('div');
    col.classList.add('col-md-3','mb-3');

    const card = document.createElement('div');
    card.classList.add('card','p-2','text-center');

    if(file.type.startsWith('image/')){
      const img = document.createElement('img');
      img.src = URL.createObjectURL(file);
      img.classList.add('img-fluid');
      img.style.height = '120px';
      img.style.objectFit = 'cover';
      card.appendChild(img);
    } else {
      card.innerHTML = `<p>${file.name}</p>`;
    }

    col.appendChild(card);
    preview.appendChild(col);
  });

});
</script>
@endpush

@extends('app')

@section('title', 'Dashboard')
@section('content')
  
  <main class="app-wrapper">

      <div class="container-fluid">

        <div class="app-page-head">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="index.html">
                  <i class="fi fi-rr-home"></i> Home
                </a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">Form layout</li>
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
        <form class="row"
              method="POST"
              action="{{ route('customer.creditcard.save') }}">
        @csrf

          {{-- Name --}}
          <div class="col-md-6 mb-3">
            <label class="form-label">🙋🏻‍♂️ Name</label>
            <input type="text"
                   name="name"
                   class="form-control"
                   placeholder="Full Name"
                   required>
          </div>

          {{-- DOB --}}
          <div class="col-md-6 mb-3">
            <label class="form-label">👼🏻 Date of Birth</label>
            <input type="date"
                   name="dob"
                   class="form-control">
          </div>

          {{-- PAN --}}
          <div class="col-md-6 mb-3">
            <label class="form-label">🪪 PAN Number</label>
            <input type="text"
                   name="pan_number"
                   class="form-control"
                   placeholder="ABCDE1234F">
          </div>

          {{-- Mother Name --}}
          <div class="col-md-6 mb-3">
            <label class="form-label">🤱 Mother’s Name</label>
            <input type="text"
                   name="mother_name"
                   class="form-control"
                   placeholder="Mother Name">
          </div>

          {{-- Address --}}
          <div class="col-12 mb-3">
            <label class="form-label">🏡 Residential Address</label>
            <input type="text"
                   name="resi_address"
                   class="form-control"
                   placeholder="House no, street, area">
          </div>

          {{-- Mobile --}}
          <div class="col-md-6 mb-3">
            <label class="form-label">📞 Mobile Number</label>
            <input type="text"
                   name="mobile_number"
                   class="form-control"
                   placeholder="10 digit mobile">
          </div>

          {{-- Email --}}
          <div class="col-md-6 mb-3">
            <label class="form-label">✉️ Email ID</label>
            <input type="email"
                   name="email"
                   class="form-control"
                   placeholder="example@email.com">
          </div>

          {{-- Company --}}
          <div class="col-md-6 mb-3">
            <label class="form-label">🏭 Company Name</label>
            <input type="text"
                   name="company_name"
                   class="form-control"
                   placeholder="Company Name">
          </div>

          {{-- Designation --}}
          <div class="col-md-6 mb-3">
            <label class="form-label">💼 Designation</label>
            <input type="text"
                   name="designation"
                   class="form-control"
                   placeholder="Designation">
          </div>

          {{-- Submit --}}
          <div class="col-12 text-end">
            <button type="submit"
                    class="btn btn-primary waves-effect waves-light">
              Save Customer Data
            </button>
          </div>

          {{-- Success Message --}}
          @if(session('success'))
            <div class="col-12 mt-3">
              <div class="alert alert-success">
                {{ session('success') }}
              </div>
            </div>
          @endif

        </form>
      </div>
    </div>
  </div>
</div>


      </div>

    </main>

  
@endsection
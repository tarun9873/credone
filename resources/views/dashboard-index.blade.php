@extends('app')

@section('title', 'Dashboard')
@section('content')
    <!-- end::Credons Page Header -->

    <div class="modal fade" id="" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header py-1 px-3">
            <form class="d-flex align-items-center position-relative w-100" action="#">
              <button type="button" class="btn btn-sm border-0 position-absolute start-0 p-0 text-sm ">
                <i class="fi fi-rr-search"></i>
              </button>
              
            </form>
            
          </div>
          
        </div>
      </div>
    </div>

   

    <div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">New Customer</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form class="row">
              <div class="col-lg-6 mb-3">
                <label class="form-label">Customer Name</label>
                <input type="text" class="form-control" placeholder="Enter full name">
              </div>
              <div class="col-lg-6 mb-3">
                <label class="form-label">Email Address</label>
                <input type="text" class="form-control" placeholder="Enter email">
              </div>
              <div class="col-lg-6 mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text" class="form-control" placeholder="e.g. +1 234 567 8900">
              </div>
              <div class="col-lg-6 mb-3">
                <label class="form-label">Company</label>
                <input type="text" class="form-control" placeholder="Company name">
              </div>
              <div class="col-lg-6 mb-3">
                <label class="form-label">Country</label>
                <select class="form-select">
                  <option value="">Select country</option>
                  <option value="US">United States</option>
                  <option value="UK">United Kingdom</option>
                  <option value="IN">India</option>
                  <option value="CA">Canada</option>
                  <option value="DE">Germany</option>
                  <option value="FR">France</option>
                  <option value="JP">Japan</option>
                  <option value="BR">Brazil</option>
                  <option value="EG">Egypt</option>
                </select>
              </div>
              <div class="col-lg-6 mb-3">
                <label class="form-label">Customer Type</label>
                <select class="form-select">
                  <option value="">Select type</option>
                  <option value="Lead">Lead</option>
                  <option value="Prospect">Prospect</option>
                  <option value="Client">Client</option>
                </select>
              </div>
              <div class="col-lg-6 mb-3">
                <label class="form-label">Account Status</label>
                <select class="form-select">
                  <option value="">Select status</option>
                  <option value="Active">Active</option>
                  <option value="Inactive">Inactive</option>
                  <option value="Blocked">Blocked</option>
                </select>
              </div>
              <div class="col-lg-6 mb-3">
                <label class="form-label">Joined Date</label>
                <input type="text" class="form-control flatpickr-date" readonly="readonly">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary ms-2">Add Customer</button>
          </div>
        </div>
      </div>
    </div>

    <main class="app-wrapper">

     <div class="container-fluid">

        <div class="app-page-head d-flex flex-wrap gap-3 align-items-center justify-content-between">
          <div class="clearfix">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                  <a href="index.html">
                    <i class="fi fi-rr-home"></i> Home >
                  </a>
                </li>
                <li aria-current=""> Profile</li>
              </ol>
            </nav>
          </div>
        </div>

        <div class="row">


          <div class="col-lg-4 col-sm-12">
            <div class="row">

              <div class="col-lg-12">
                <div class="card">
                  <div class="card-header pb-0 border-0">
                    <div class="mb-4 border-bottom pb-4 d-flex border-0 justify-content-between align-items-start">
                      <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl rounded-circle position-relative me-3">
                           <img src="assets/images/3135715.png" alt="">
                         
                        </div>
                       
                      </div>
                      
                    </div>
                  </div>
                  <div class="card-body pt-0">

  <div class="mb-4 border-bottom pb-4">
    <div class="mb-3">
      <h4 class="card-title mb-0">Basic Information</h4>
    </div>

    <div class="clearfix">

      {{-- Full Name --}}
      <div class="mb-3">
        <span class="mb-1">Full Name</span>
        <p class="text-dark fw-semibold mb-0">
          {{ auth()->user()->name }}
        </p>
      </div>

      {{-- Email --}}
      <div class="mb-3">
        <span class="mb-1">Email</span>
        <p class="text-dark fw-semibold mb-0">
          {{ auth()->user()->email }}
        </p>
      </div>

      {{-- Phone (optional) --}}
      @if(auth()->user()->phone)
      <div class="mb-3">
        <span class="mb-1">Phone</span>
        <p class="text-dark fw-semibold mb-0">
          {{ auth()->user()->phone }}
        </p>
      </div>
      @endif

      {{-- Role (read only) --}}
      <div class="mb-3">
        <span class="mb-1">Role</span>
        <p class="text-dark fw-semibold mb-0 text-capitalize">
          {{ str_replace('_',' ', auth()->user()->role) }}
        </p>
      </div>

      {{-- Joined Date --}}
      <div class="mb-0">
        <span class="mb-1">Joined Date</span>
        <p class="text-dark fw-semibold mb-0">
          {{ auth()->user()->created_at->format('d M Y') }}
        </p>
      </div>

    </div>
  </div>

</div>

                </div>
              </div>

            </div>
          </div>

          <div class="col-lg-8 col-sm-12">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Account Settings</h4>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}">
@csrf

<div class="row mb-3">
  <div class="col-md-6">
    <label class="form-label">Full Name</label>
    <input type="text"
           class="form-control"
           name="name"
           value="{{ auth()->user()->name }}"
           required>
  </div>

  <div class="col-md-6">
    <label class="form-label">Email</label>
    <input type="email"
           class="form-control"
           name="email"
           value="{{ auth()->user()->email }}"
           required>
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-6">
    <label class="form-label">Role</label>
    <input type="text"
           class="form-control"
           value="{{ strtoupper(str_replace('_',' ', auth()->user()->role)) }}"
           disabled>
    {{-- disabled = NEVER submit --}}
  </div>

  <div class="col-md-6">
    <label class="form-label">New Password</label>
    <input type="password"
           class="form-control"
           name="password"
           placeholder="Leave blank to keep current password">
  </div>
</div>

<div class="text-end">
  <button type="submit" class="btn btn-success">
    Save Changes
  </button>
</div>

@if(session('success'))
  <div class="alert alert-success mt-3">
    {{ session('success') }}
  </div>
@endif

</form>

                  </div>
                </div>
              </div>
              
            </div>
          </div>

        </div>

      </div>


    </main>
@endsection
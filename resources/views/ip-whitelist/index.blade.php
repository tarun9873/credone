@extends('app')

@section('title','IP Whitelist')

@section('content')
<main class="app-wrapper">
<div class="container-fluid">

<h4 class="mb-3">IP Whitelist (Super | Admin Only)</h4>



{{-- ADD IP --}}
<div class="card mb-4">
  <div class="card-body">
    
{{-- Success Message --}}
@if(session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
@endif

{{-- Error Messages --}}
@if ($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

    <form method="POST">
      @csrf
      <div class="row g-2">
        <div class="col-md-4">
          <input name="ip_address" class="form-control" placeholder="IP Address" required>
        </div>
        <div class="col-md-4">
          <input name="label" class="form-control" placeholder="Label (Office/Home)">
        </div>
        <div class="col-md-2">
          <button class="btn btn-primary w-100">Add IP</button>
        </div>
      </div>
    </form>
  </div>
</div>

{{-- LIST --}}
<div class="card">
  <div class="card-body table-responsive">
    <table class="table table-bordered">
      <thead class="table-light">
        <tr>
          <th>#</th>
          <th>IP Address</th>
          <th>Label</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      @foreach($ips as $ip)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $ip->ip_address }}</td>
          <td>{{ $ip->label ?? '—' }}</td>
          <td>
            <form method="POST" action="{{ url('/ip-whitelist/'.$ip->id) }}"
                  onsubmit="return confirm('Remove this IP?')">
              @csrf
              @method('DELETE')
              <button class="btn btn-sm btn-danger">Delete</button>
            </form>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>

</div>
</main>
@endsection

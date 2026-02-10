<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login | Cred Ons</title>

  <!-- NexLink CSS -->
  <link rel="stylesheet" href="assets/libs/flaticon/css/all/all.css">
  <link rel="stylesheet" href="assets/libs/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="assets/css/styles.css">

  <!-- 🔥 REQUIRED FIX CSS -->
  <style>
.password-wrapper{
  position: relative;
}

.password-wrapper input{
  padding-right: 45px;
}

.eye-icon{
  position: absolute;
  top: 50%;
  right: 12px;
  transform: translateY(-50%);
  cursor: pointer;
  color: #6c757d;
}
</style>


</head>

<body>

<div class="page-layout">
  <div class="auth-wrapper min-vh-100 px-2">
    <div class="row g-0 min-vh-100">

      <!-- LEFT IMAGE -->
      <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center">
        <img src="assets/images/vector2.svg" class="img-fluid" alt="Login">
      </div>

      <!-- LOGIN CARD -->
      <div class="col-lg-6 d-flex align-items-center">
        <div class="card card-body p-4 p-sm-5 maxw-450px m-auto rounded-4">

          <!-- LOGO -->
          <div class="mb-4 text-center">
            <img src="assets/images/75461231.webp" height="50" alt="Logo">
          </div>

          <div class="text-center mb-4">
            <h5 class="mb-1">Welcome to Cred Ons</h5>
            <p>Sign in to access your dashboard</p>
          </div>

          <!-- ERROR -->
          {{-- ALL ERRORS --}}
@if ($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif


          @if($errors->has('ip'))
            <div class="alert alert-danger">
              {{ $errors->first('ip') }}
            </div>
          @endif

          <!-- LOGIN FORM -->
          <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <!-- EMAIL -->
            <div class="mb-4">
              <label class="form-label">Email Address</label>
              <input type="email"
                     name="email"
                     class="form-control"
                     placeholder="info@example.com"
                     value="{{ old('email') }}"
                     required>
            </div>

            <!-- PASSWORD -->
            <div class="mb-4">
  <label class="form-label">Password</label>

  <div class="password-wrapper">
    <input type="password"
           id="loginPassword"
           name="password"
           class="form-control"
           placeholder="********"
           required>

    <!-- EYE ICON -->
    <span class="eye-icon" onclick="togglePassword()">

      <!-- OPEN EYE -->
      <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg"
           width="22" height="22" viewBox="0 0 24 24"
           fill="none" stroke="currentColor"
           stroke-width="2" stroke-linecap="round"
           stroke-linejoin="round">
        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
        <circle cx="12" cy="12" r="3"/>
      </svg>

      <!-- CLOSED EYE -->
      <svg id="eyeClose" class="d-none"
           xmlns="http://www.w3.org/2000/svg"
           width="22" height="22" viewBox="0 0 24 24"
           fill="none" stroke="currentColor"
           stroke-width="2" stroke-linecap="round"
           stroke-linejoin="round">
        <path d="M17.94 17.94A10.94 10.94 0 0 1 12 20c-7 0-11-8-11-8a21.77 21.77 0 0 1 5.06-6.94"/>
        <path d="M1 1l22 22"/>
        <path d="M9.53 9.53A3.5 3.5 0 0 0 12 15.5"/>
      </svg>

    </span>
  </div>
</div>

            <!-- REMEMBER -->
            <div class="mb-4 form-check">
              <input type="checkbox" class="form-check-input" id="rememberMe">
              <label class="form-check-label" for="rememberMe">Remember Me</label>
            </div>

            <!-- SUBMIT -->
            <button type="submit" class="btn btn-primary w-100">
              Login
            </button>

          </form>

        </div>
      </div>

    </div>
  </div>
</div>

<!-- 🔥 PASSWORD TOGGLE JS -->
<script>
function togglePassword() {
  const input = document.getElementById('loginPassword');
  const open = document.getElementById('eyeOpen');
  const close = document.getElementById('eyeClose');

  if (input.type === 'password') {
    input.type = 'text';
    open.classList.add('d-none');
    close.classList.remove('d-none');
  } else {
    input.type = 'password';
    close.classList.add('d-none');
    open.classList.remove('d-none');
  }
}
</script>

</body>
</html>

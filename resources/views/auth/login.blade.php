<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from nexlink.layoutdrop.com/demo/authentication/login-cover.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 09 Feb 2026 06:51:34 GMT -->
<head>

  <base >

  <!-- begin::NexLink Meta Basic -->
  <meta charset="utf-8">
  <meta name="theme-color" content="#5955D1">
  <meta name="robots" content="index, follow">
  <meta name="author" content="LayoutDrop">
  <meta name="format-detection" content="telephone=no">
  <meta name="keywords" content="Bootstrap Admin Template, CRM Dashboard, Admin Panel, Bootstrap 5 Dashboard, Project Management, Analytics Template, Responsive Admin">
  <meta name="description" content="NexLink is a modern Bootstrap 5 CRM Admin Dashboard Template designed for managing sales, analytics, projects, and team performance with clean UI, responsive layout, and prebuilt pages.">
  <!-- end::NexLink Meta Basic -->

  <!-- begin::NexLink Meta Social -->
  <meta property="og:url" content="../index-2.html">
  <meta property="og:site_name" content="NexLink | CRM Admin Dashboard Template">
  <meta property="og:type" content="website">
  <meta property="og:locale" content="en_US">
  <meta property="og:title" content="NexLink | CRM Admin Dashboard Template">
  <meta property="og:description" content="NexLink is a modern Bootstrap 5 CRM Admin Dashboard Template designed for managing sales, analytics, projects, and team performance with clean UI, responsive layout, and prebuilt pages.">
  <meta property="og:image" content="../preview.png">
  <!-- end::NexLink Meta Social -->

  <!-- begin::NexLink Meta Twitter -->
  <meta name="twitter:card" content="summary">
  <meta name="twitter:url" content="../index-2.html">
  <meta name="twitter:creator" content="@layoutdrop">
  <meta name="twitter:title" content="NexLink | CRM Admin Dashboard Template">
  <meta name="twitter:description" content="NexLink is a modern Bootstrap 5 CRM Admin Dashboard Template designed for managing sales, analytics, projects, and team performance with clean UI, responsive layout, and prebuilt pages.">
  <!-- end::NexLink Meta Twitter -->

  <!-- begin::NexLink Website Page Title -->
  <title>NexLink | CRM Admin Dashboard Template</title>
  <!-- end::NexLink Website Page Title -->

  <!-- begin::NexLink Mobile Specific -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- end::NexLink Mobile Specific -->

  <!-- begin::NexLink Favicon Tags -->
  <link rel="icon" type="image/png" href="assets/images/favicon.png">
  <link rel="apple-touch-icon" sizes="180x180" href="assets/images/apple-touch-icon.png">
  <!-- end::NexLink Favicon Tags -->

  <!-- begin::NexLink Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com/">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&amp;display=swap" rel="stylesheet">
  <!-- end::NexLink Google Fonts -->

  <!-- begin::NexLink Required Stylesheet -->
  <link rel="stylesheet" href="assets/libs/flaticon/css/all/all.css">
  <link rel="stylesheet" href="assets/libs/lucide/lucide.css">
  <link rel="stylesheet" href="assets/libs/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="assets/libs/simplebar/simplebar.css">
  <link rel="stylesheet" href="assets/libs/node-waves/waves.css">
  <link rel="stylesheet" href="assets/libs/bootstrap-select/css/bootstrap-select.min.css">
  <!-- end::NexLink Required Stylesheet -->

  <!-- begin::NexLink CSS Stylesheet -->
  <link rel="stylesheet" href="assets/css/styles.css">
  <!-- end::NexLink CSS Stylesheet -->



</head>

<body>
  <div class="page-layout">

    <div class="auth-cover-wrapper">
      <div class="row g-0">
        <div class="col-md-6 order-md-1">
          <div class="auth-cover">
            <div class="clearfix">
              <img src="http://../assets/images/auth/vector1.svg" alt="" class="img-fluid cover-img">
              <div class="auth-content">
                <h1 class="display-6 fw-bold">Welcome Back!</h1>
                <p>Welcome to Cred Ons Enterprises, your all-in-one solution for smart business management. Streamline workflows, boost productivity, and grow your business with confidence.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 align-self-center">
          <div class="px-3 py-5 p-sm-5 maxw-450px m-auto">
            <div class="mb-4 text-center">
              <a href="https://credons.com/" aria-label="NexLink logo">
                <img class="visible-light" src="{{ asset('assets/images/75461231.webp') }}" alt="NexLink logo">
              </a>
            </div>
            <div class="text-center mb-5">
              <h5 class="mb-1">Welcome to Cred Ons Enterprises</h5>
              <p>Sign in to access your secure admin dashboard.</p>
            </div>
          <form method="POST" action="{{ route('login.post') }}">
    @csrf

    {{-- Email --}}
    <div class="mb-4">
        <label class="form-label">Email Address</label>
        <input
            type="email"
            class="form-control"
            name="email"
            value="{{ old('email') }}"
            placeholder="info@example.com"
            required
        >
        @error('email')
            <small style="color:red">{{ $message }}</small>
        @enderror
    </div>

    {{-- Password --}}
    <div class="mb-4">
        <label class="form-label">Password</label>
        <input
            type="password"
            class="form-control"
            name="password"
            placeholder="********"
            required
        >
        @error('password')
            <small style="color:red">{{ $message }}</small>
        @enderror
    </div>

    {{-- Remember --}}
    <div class="mb-4">
        <input type="checkbox" name="remember" id="remember">
        <label for="remember">Remember Me</label>
    </div>

    {{-- Submit --}}
    <button type="submit" class="btn btn-primary w-100">
        Login
    </button>
</form>

          </div>
        </div>
      </div>
    </div>

  </div>
  <!-- begin::NexLink Page Scripts -->
  <script src="assets/libs/global/global.min.js"></script>
  <script src="assets/js/appSettings.js"></script>
  <script src="assets/js/main.js"></script>
  <!-- end::NexLink Page Scripts -->
</body>


<!-- Mirrored from nexlink.layoutdrop.com/demo/authentication/login-cover.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 09 Feb 2026 06:51:34 GMT -->
</html>
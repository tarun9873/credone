<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>@yield('title','Dashboard')</title>

<link rel="icon" href="{{ asset('assets/images/favicon.png') }}">
<link rel="stylesheet" href="https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css">

<link rel="stylesheet" href="{{ asset('assets/libs/flaticon/css/all/all.css') }}">

<link rel="stylesheet" href="{{ asset('assets/libs/simplebar/simplebar.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/node-waves/waves.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-select/css/bootstrap-select.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">

</head>

<body>

<div class="page-layout">

    @include('header')

 
        @include('sidebar')

        <main class="app-content">
            @yield('content')
        </main>
   
    @include('footer')

</div>

<script src="{{ asset('assets/libs/global/global.min.js') }}"></script>
<script src="{{ asset('assets/libs/sortable/Sortable.min.js') }}"></script>
<script src="{{ asset('assets/libs/chartjs/chart.js') }}"></script>
<script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/js/dashboard/dashboard.js') }}"></script>
<script src="{{ asset('assets/js/plugins/todolist.js') }}"></script>
<script src="{{ asset('assets/js/appSettings.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    let dashboardTabTrigger = document.querySelector(
        'a[data-bs-toggle="tab"][href="#dashboardTab"]'
    );

    if (dashboardTabTrigger) {
        let tab = new bootstrap.Tab(dashboardTabTrigger);
        tab.show();
    }
});
</script>

</body>
</html>

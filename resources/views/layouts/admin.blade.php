<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title') | {{ config('app.name', 'Allsites Ecom') }}</title>

    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('admin/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/base/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">

    <!-- endinject -->

    <link rel="shortcut icon" href="{{ asset('admin/images/favicon.png') }}" />

    @livewireStyles

</head>
<body>

    <div class="container-scroller">

        @include('layouts.inc.admin.navbar')

        <div class="divcontainer-fluid page-boby-wrapper">

            @include('layouts.inc.admin.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">

                    @yield('content')

                </div>
            </div>

        </div>
    </div>

<!-- plugins:js -->
<script src="{{ asset('admin/vendors/base/vendor.bundle.base.js') }}"></script>
<!-- endinject -->

<!-- Plugin js for this page-->
<script src="{{ asset('admin/vendors/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
<!-- End plugin js for this page-->

<!-- inject:js -->
<script src="{{ asset('admin/js/off-canvas.js') }}"></script>
<script src="{{ asset('admin/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('admin/js/template.js') }}"></script>
<!-- endinject -->

<!-- Custom js for this page-->
<script src="{{ asset('admin/js/dashboard.js') }}"></script>
<script src="{{ asset('admin/js/data-table.js') }}"></script>
<script src="{{ asset('admin/js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('admin/js/dataTables.bootstrap4.js') }}"></script>
<!-- End custom js for this page-->

<script src="{{ asset('admin/js/jquery.cookie.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/js/scripts.js')}}"></script>
<script src="{{ asset('assets/js/jquery-3.7.0.min.js')}}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script>

@yield('scripts')

@livewireScripts
@stack('script')

</body>
</html>

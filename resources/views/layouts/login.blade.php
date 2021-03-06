<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{ asset('vendors/base/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png')}}" />
    @livewireStyles
</head>
<body>
<div class="container-scroller" >
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel" style="background-image: url('{{ asset('images/travel.png') }}'); background-repeat: no-repeat; background-color: #EBF4FF; background-position: bottom right">
            <div class="content-wrapper">
                @yield('content')
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <footer class="footer">
                <div class="footer-wrap bg-transparent">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">GOShuttle ©{{date('Y')}} </span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> made with &hearts; by cahyadi2 </span>
                    </div>
                </div>
            </footer>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<script src="{{ asset('vendors/base/vendor.bundle.base.js')}}"></script>
<script src="{{ asset('js/template.js')}}"></script>
</body>
</html>

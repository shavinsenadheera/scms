<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SCMS</title>
    <link rel="stylesheet" href="{{asset('assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/iconfonts/ionicons/dist/css/ionicons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{asset('assets/vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/css/vendor.bundle.addons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/shared/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/iconfonts/font-awesome/css/font-awesome.min.css')}}" />
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}" />
</head>
<body>

<div class="container-scroller" style="background: url(/assets/images/myImages/welcome.png)">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
            <div class="row col-xl-12 col-lg-12 col-md-12 col-sm-12 justify-content-center text-center">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                    @yield('content')
                    <p class="footer-text text-dark text-center">Copyright © {{ \Carbon\Carbon::now()->year }} ABCTL. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('assets/vendors/js/vendor.bundle.addons.js') }}"></script>
<script src="{{ asset('assets/js/shared/off-canvas.js') }}"></script>
<script src="{{ asset('assets/js/shared/misc.js') }}"></script>
<script src="{{ asset('assets/js/shared/jquery.cookie.js') }}" type="text/javascript"></script>
</body>
</html>

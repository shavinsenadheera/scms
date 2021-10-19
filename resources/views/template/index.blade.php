<?php
$hour = date('H');
$timezone = date('e');
if ($hour < 12) {
    $status = "Good Morning! Have a nice day!";
    $mood = 1;
} else if ($hour < 17 && $hour >= 12) {
    $status = "Good Afternoon! Be happy in every moments!";
    $mood = 2;
} else if ($hour < 19 && $hour >= 17) {
    $status = "Good Evening! Thank you for working lot!";
    $mood = 3;
} else {
    $status = "Good Night! Lets have a rest!";
    $mood = 4;
}
?>

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SCMS @isset($title) {{$title}} @endif</title>
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconfonts/ionicons/dist/css/ionicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconfonts/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.addons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/shared/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/demo_1/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/select2/css/select2.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/logo/logo.png') }}"/>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans"/>
    @yield('head-js')
</head>
<body>
<div class="container-scroller">
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
            <a class="navbar-brand brand-logo">
                ABCTL 2021
            </a>
            <a class="navbar-brand brand-logo-mini">
                ABCTL
            </a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center">
            <div class="ml-auto d-none d-md-block" action="#">
                <h3 class="text-primary" style="font-family: 'Britannic Bold'">
                    @if($mood==1)
                        {{ $status }} &#128526;
                    @elseif($mood==2)
                        {{ $status }} &#128522;
                    @elseif($mood==3)
                        {{ $status }} &#128528;
                    @else
                        {{ $status }} &#128564;
                    @endif
                </h3>
            </div>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
                    <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown"
                       aria-expanded="false">
                        <img src="{{ Avatar::create(Auth::user()->name)->toBase64() }}" width="30px"/>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                        <div class="dropdown-header text-center">
                            <img src="{{ Avatar::create(Auth::user()->name)->toBase64() }}" width="30px"/>
                            <p class="mb-1 mt-3 font-weight-semibold">{{ Auth::user()->name }}</p>
                            <p class="font-weight-light text-muted mb-0">{{ Auth::user()->email }}</p>
                        </div>
                        <a href="{{ route('user.changeProfile', encrypt(Auth::id()))}}" class="dropdown-item">My Profile
                            <i class="dropdown-item-icon ti-dashboard"></i></a>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item">Sign Out<i
                                    class="dropdown-item-icon ti-power-off"></i></button>
                        </form>
                    </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
        </div>
    </nav>
    <div class="container-fluid page-body-wrapper">
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item nav-profile">
                    <a href="#" class="nav-link">
                        <div class="profile-image">
                            <img src="{{ Avatar::create(Auth::user()->name)->toBase64() }}" width="30px"/>
                            <div class="dot-indicator bg-success"></div>
                        </div>
                        <div class="text-wrapper">
                            <p class="profile-name text-small">{{ Auth::user()->name }}</p>
                            <p class="designation">{{ Auth::user()->employee->designation->name }}</p>
                        </div>
                    </a>
                </li>
                <li class="nav-item nav-category">Main Menu</li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard.index') }}">
                        <i class="menu-icon typcn typcn-document-text"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                @role('super_admin|it_admin|planning_manager|planning_coordinator')
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#general" aria-expanded="false"
                       aria-controls="auth">
                        <i class="menu-icon typcn typcn-document-add"></i>
                        <span class="menu-title">General Management</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="general">
                        <ul class="nav flex-column sub-menu">
                            @can('department_handling')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('department.index') }}"> Department Handling </a>
                                </li>
                            @endcan
                            @can('department_handling')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('designation.index') }}"> Designation
                                        Handling </a>
                                </li>
                            @endcan
                            @can('status_handling')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('status.index') }}"> Status Handling </a>
                                </li>
                            @endcan
                            @can('priority_type_handling')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('prioritytype.index') }}"> Priority Type
                                        Handling </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endrole
                @role('super_admin')
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#label" aria-expanded="false" aria-controls="auth">
                        <i class="menu-icon typcn typcn-document-add"></i>
                        <span class="menu-title">Label Management</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="label">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('labeltype.index') }}"> Type Handling </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('labelstyle.index') }}"> Style Handling </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('labelsize.index') }}"> Size Handling </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endrole
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#order-concerns" aria-expanded="false" aria-controls="auth">
                        <i class="menu-icon typcn typcn-document-add"></i>
                        <span class="menu-title">Common</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="order-concerns">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('concerns.index') }}"> Order Concerns </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @hasanyrole('super_admin|cs_manager|cs_coordinator')
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#order" aria-expanded="false" aria-controls="auth">
                        <i class="menu-icon typcn typcn-document-add"></i>
                        <span class="menu-title">Order Management</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="order">
                        <ul class="nav flex-column sub-menu">
                            @can('order_handling')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('order.index') }}"> Order Handling </a>
                                </li>
                            @endcan
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('order.concerns') }}"> Order Concerns </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endrole
                @hasanyrole('super_admin|planning_manager|cs_manager|planning_coordinator|cs_coordinator')
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#planning" aria-expanded="false"
                       aria-controls="auth">
                        <i class="menu-icon typcn typcn-document-add"></i>
                        <span class="menu-title">Planning Management</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="planning">
                        <ul class="nav flex-column sub-menu">
                            @hasanyrole('super_admin|planning_manager|planning_coordinator')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('planning.index') }}"> Order Planning </a>
                            </li>
                            @endrole
                            @can('planning_scanning')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('planning.scan.view') }}"> Scanning orders </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endrole
                @hasanyrole('super_admin|production_manager|production_coordinator|planning_manager|planning_coordinator')
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#manufacturing" aria-expanded="false"
                       aria-controls="auth">
                        <i class="menu-icon typcn typcn-document-add"></i>
                        <span class="menu-title">Production Management</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="manufacturing">
                        <ul class="nav flex-column sub-menu">
                            @can('production_scanning')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('manufacturing.scan.view') }}"> Scanning
                                        orders </a>
                                </li>
                            @endcan
                            @can('material_request_handling')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('request.index') }}"> Material request </a>
                                </li>
                            @endcan
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('concerns.index') }}"> Order Concerns </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endrole
                @hasanyrole('super_admin|production_manager|production_coordinator')
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#qa" aria-expanded="false" aria-controls="auth">
                        <i class="menu-icon typcn typcn-document-add"></i>
                        <span class="menu-title">{!! trans('dashboard.qaManagement') !!}</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="qa">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('qa.scan.view') }}"> {!! trans('dashboard.scanOrder') !!} </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endrole
                @hasanyrole('super_admin|dispatch_manager|dispatch_coordinator|qa_manager|qa_coordinator')
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#dispatch" aria-expanded="false"
                       aria-controls="auth">
                        <i class="menu-icon typcn typcn-document-add"></i>
                        <span class="menu-title">Dispatch Management</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="dispatch">
                        <ul class="nav flex-column sub-menu">
                            @can('dispatch_scanning')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('dispatch.scan.view') }}"> Scanning orders </a>
                                </li>
                            @endcan
                            @can('dispatch_done_scanning')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('dispatch.scandoneview') }}"> Scanning done
                                        orders </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endrole
                @role('super_admin|cs_manager|cs_coordinator')
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#customer" aria-expanded="false"
                       aria-controls="auth">
                        <i class="menu-icon typcn typcn-document-add"></i>
                        <span class="menu-title">Customer Management</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="customer">
                        <ul class="nav flex-column sub-menu">
                            @can('customer_handling')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('customer.index') }}"> Customer registration </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endrole
                @role('super_admin|store_manager|store_coordinator|production_manager|production_coordinator')
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#store" aria-expanded="false" aria-controls="auth">
                        <i class="menu-icon typcn typcn-document-add"></i>
                        <span class="menu-title">Store Management</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="store">
                        <ul class="nav flex-column sub-menu">
                            @can('supplier_handling')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('supplier.index') }}"> Supplier handling</a>
                                </li>
                            @endcan
                            @can('material_handling')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('material.index') }}"> Material handling</a>
                                </li>
                            @endcan
                            @can('metric_handling')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('metric.index') }}"> Metric handling </a>
                                </li>
                            @endcan
                            @can('logs_handling')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('log.index') }}"> MRN handling </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endrole
                @role('super_admin|it_admin')
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                        <i class="menu-icon typcn typcn-document-add"></i>
                        <span class="menu-title">User Management</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="auth">
                        <ul class="nav flex-column sub-menu">
                            @can('employee_handling')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('employee.index') }}"> Employee Handling </a>
                                </li>
                            @endcan
                            @can('role_handling')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('role.index') }}"> Role Handling </a>
                                </li>
                            @endcan
                            @can('permission_handling')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('permission.index') }}"> Permission Handling </a>
                                </li>
                            @endcan
                            @can('user_handling')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.index') }}"> User Handling </a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endrole
            </ul>
        </nav>

        <div class="main-panel">
            <div class="content-wrapper">
                @yield('content')
                <script>
                    $.fn.modal.Constructor.prototype.enforceFocus = function () {
                    };
                </script>
            </div>
            <footer class="footer">
                <div class="container-fluid clearfix">
                    <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Solution by &#128152;@UoR {{ \Carbon\Carbon::now()->year }}</span>
                </div>
            </footer>
        </div>
    </div>
    <div id="preloader">
        <div id="status">&nbsp;</div>
        <div class="text-center">
            <h3 class="h3 h3-responsive text-blue text-bold">ITL Fixed Asset MS & Help Desk</h3>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/shared/off-canvas.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/shared/misc.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/shared/chart.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/demo_1/dashboard.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/shared/jquery.cookie.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/datatables/datatables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/sweetalerts/sweetalert.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/select2/js/select2.full.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/custom/js/main.js')}}"></script>
@yield('custom-js')
<script>
    $(window).on('load', function () {
        $('#status').fadeOut();
        $('#preloader').delay(350).fadeOut('slow');
        $('body').delay(350).css({'overflow': 'visible'});
    })
</script>
</body>
</html>

@extends('template.index')
@section('head-css')
    <link href="{{asset('assets/css/custom/smartProduction.css')}}" rel="stylesheet"/>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.dashboard') }}</a></li>
                        <li class="breadcrumb-item active"
                            aria-current="page">{{ __('general.breadcrumb.production.smart_production_dashboard') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="row" style="background: #C4C4C4">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 p-0 m-0">
                        <div class="card" style="background: #C4C4C4">
                            <div class="card-body text-center" style="background: #0C0096">
                                <img src="{{asset('assets/images/myImages/machineWork.gif')}}" class="img-fluid"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 p-0 m-0">
                        <div class="card">
                            <div class="card-body text-left" style="background: #C4C4C4">
                                <h1 style="font-size: 50px;font-weight: bold">Smart</h1>
                                <h1 style="font-size: 50px">Production</h1>
                                <h3>To Manage Materials Smartly</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="background: #C4C4C4">
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 p-0 m-0">
                        <div class="card">
                            <div class="card-body text-left" style="background: #C4C4C4">
                                <h1 style="font-size: 50px;font-weight: bold">Smart</h1>
                                <h1 style="font-size: 50px">Materials</h1>
                                @can('material_request_handling')
                                    <a class="btn btn-primary" href="{{ route('log.index') }}">
                                        <i class="fa fa-eye"></i> Material Requests
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div id="smartMaterials" class="col-xl-8 col-lg-8 col-md-12 bg-dark col-sm-12 p-0 m-0">
                        <div class="p-3">
                            <table class="w-100 text-white">
                                <tr>
                                    <th class="text-left" colspan="3">
                                        Total <span style="font-size: 20px;text-transform: uppercase">Upcoming</span>
                                        Orders Stat
                                    </th>
                                    <th class="text-right">
                                        <span class="badge badge-primary">Count: {{$totalUpcomingOrders}}</span>
                                    </th>
                                </tr>
                                <tr class="blank_row">
                                    <td colspan="4"></td>
                                </tr>
                                <tr>
                                    <th class="text-left border-bottom border-white" colspan="4"></th>
                                </tr>
                                <tr class="blank_row">
                                    <td colspan="4"></td>
                                </tr>
                                <tr>
                                    <th class="text-left" colspan="4">Polyester</th>
                                </tr>
                                <tr class="blank_row">
                                    <td colspan="4"></td>
                                </tr>
                                <tr>
                                    <th class="text-left border-bottom border-white" colspan="4"></th>
                                </tr>
                                <tr class="blank_row">
                                    <td colspan="4"></td>
                                </tr>
                                <tr>
                                    <th>Size</th>
                                    <th>{!! __('smartDashboard.expected') !!}</th>
                                    <th class="text-right">{!! __('smartDashboard.actual') !!}</th>
                                    <th class="text-right">MRN</th>
                                </tr>
                                <tr>
                                    <td class="text-left">{!! __('smartDashboard.expectedSmall') !!}</td>
                                    <td class="text-left">~ {{round($stSmallLabelCount)}} m</td>
                                    <td class="text-right">{{$polyesterSmall ? $polyesterSmall : 0}} m</td>
                                    <td class="text-right">
                                        <button type="button" data-toggle="modal" data-target="#polyesterSModal">
                                            <i class="fa fa-send"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">{!! __('smartDashboard.expectedMedium') !!}</td>
                                    <td class="text-left">~ {{round($stMediumLabelCount)}} m</td>
                                    <td class="text-right">{{$polyesterMedium ? $polyesterMedium : 0}} m</td>
                                    <td class="text-right">
                                        <button type="button" data-toggle="modal" data-target="#polyesterMModal">
                                            <i class="fa fa-send"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">{!! __('smartDashboard.expectedLarge') !!}</td>
                                    <td class="text-left">~ {{round($stLargeLabelCount)}} m</td>
                                    <td class="text-right">{{$polyesterLarge ? $polyesterLarge : 0}} m</td>
                                    <td class="text-right">
                                        <button type="button" data-toggle="modal" data-target="#polyesterLgModal">
                                            <i class="fa fa-send"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="blank_row">
                                    <td colspan="4"></td>
                                </tr>
                                <tr>
                                    <th class="text-left text-danger" style="font-size: 30px">Total</th>
                                    <th class="text-left text-danger" style="font-size: 30px">
                                        ~ {{round($stickerTotalCount)}} m
                                    </th>
                                    @if(round($wovenTotalCount) < ($polyesterSmall+$polyesterMedium+$polyesterLarge))
                                        <th class="text-right text-danger"
                                            style="font-size: 30px">{{$polyesterSmall+$polyesterMedium+$polyesterLarge}}
                                            m
                                        </th>
                                    @else
                                        <th class="text-right text-danger" style="font-size: 30px">
                                            {{$polyesterSmall+$polyesterMedium+$polyesterLarge}} m
                                            <img src="{{asset('assets/images/myImages/warning.gif')}}"/>
                                        </th>
                                    @endif
                                    <th class="text-right"></th>
                                </tr>
                                <tr class="blank_row">
                                    <td colspan="4"></td>
                                </tr>
                                <tr>
                                    <th class="text-left border-bottom border-white" colspan="4"></th>
                                </tr>
                                <tr class="blank_row">
                                    <td colspan="4"></td>
                                </tr>
                                <tr>
                                    <th class="text-left" colspan="4">Cotton</th>
                                </tr>
                                <tr class="blank_row">
                                    <td colspan="4"></td>
                                </tr>
                                <tr>
                                    <th class="text-left border-bottom border-white" colspan="4"></th>
                                </tr>
                                <tr class="blank_row">
                                    <td colspan="4"></td>
                                </tr>
                                <tr>
                                    <th>Size</th>
                                    <th>{!! __('smartDashboard.expected') !!}</th>
                                    <th class="text-right">{!! __('smartDashboard.actual') !!}</th>
                                    <th class="text-right">MRN</th>
                                </tr>
                                <tr>
                                    <td class="text-left">{!! __('smartDashboard.expectedSmall') !!}</td>
                                    <td class="text-left">~ {{round($wovSmallLabelCount)}} m</td>
                                    <td class="text-right">{{$cottonSmall ? $cottonSmall : 0}} m</td>
                                    <td class="text-right">
                                        <button type="button" data-toggle="modal" data-target="#cottonSModal">
                                            <i class="fa fa-send"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">{!! __('smartDashboard.expectedMedium') !!}</td>
                                    <td class="text-left">~ {{round($wovMediumLabelCount)}} m</td>
                                    <td class="text-right">{{$cottonMedium ? $cottonMedium : 0}} m</td>
                                    <td class="text-right">
                                        <button type="button" data-toggle="modal" data-target="#cottonMModal">
                                            <i class="fa fa-send"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">{!! __('smartDashboard.expectedLarge') !!}</td>
                                    <td class="text-left">~ {{round($wovLargeLabelCount)}} m</td>
                                    <td class="text-right">{{$cottonLarge ? $cottonLarge : 0}} m</td>
                                    <td class="text-right">
                                        <button type="button" data-toggle="modal" data-target="#cottonLgModal">
                                            <i class="fa fa-send"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="blank_row">
                                    <td colspan="4"></td>
                                </tr>
                                <tr>
                                    <th class="text-left text-danger" style="font-size: 30px">Total</th>
                                    <th class="text-left text-danger" style="font-size: 30px">
                                        ~ {{round($wovenTotalCount)}} m
                                    </th>
                                    @if(round($wovenTotalCount) < ($cottonSmall+$cottonMedium+$cottonLarge))
                                        <th class="text-right text-danger"
                                            style="font-size: 30px">{{$cottonSmall+$cottonMedium+$cottonLarge}} m
                                        </th>
                                    @else
                                        <th class="text-right text-danger" style="font-size: 30px">
                                            {{$cottonSmall+$cottonMedium+$cottonLarge}} m
                                            <img src="{{asset('assets/images/myImages/warning.gif')}}"/>
                                        </th>
                                    @endif
                                </tr>
                                <tr class="blank_row">
                                    <td colspan="4"></td>
                                </tr>
                                <tr>
                                    <th class="text-left border-bottom border-white" colspan="4"></th>
                                </tr>
                                <tr class="blank_row">
                                    <td colspan="4"></td>
                                </tr>
                                <tr>
                                    <th class="text-left" colspan="4">Heat Transfer</th>
                                </tr>
                                <tr class="blank_row">
                                    <td colspan="4"></td>
                                </tr>
                                <tr>
                                    <th class="text-left border-bottom border-white" colspan="4"></th>
                                </tr>
                                <tr class="blank_row">
                                    <td colspan="4"></td>
                                </tr>
                                <tr>
                                    <th>Size</th>
                                    <th>{!! __('smartDashboard.expected') !!}</th>
                                    <th class="text-right">{!! __('smartDashboard.actual') !!}</th>
                                    <th class="text-right">MRN</th>
                                </tr>
                                <tr>
                                    <td class="text-left">{!! __('smartDashboard.expectedSmall') !!}</td>
                                    <td class="text-left">~ {{round($cSmallLabelCount)}} m</td>
                                    <td class="text-right">{{$htSmall ? $htSmall : 0}} m</td>
                                    <td class="text-right">
                                        <button type="button" data-toggle="modal" data-target="#htSModal">
                                            <i class="fa fa-send"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">{!! __('smartDashboard.expectedMedium') !!}</td>
                                    <td class="text-left">~ {{round($cMediumLabelCount)}} m</td>
                                    <td class="text-right">{{$htMedium ? $htMedium : 0}} m</td>
                                    <td class="text-right">
                                        <button type="button" data-toggle="modal" data-target="#htMModal">
                                            <i class="fa fa-send"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">{!! __('smartDashboard.expectedLarge') !!}</td>
                                    <td class="text-left">~ {{round($cLargeLabelCount)}} m</td>
                                    <td class="text-right">{{$htLarge ? $htLarge : 0}} m</td>
                                    <td class="text-right">
                                        <button type="button" data-toggle="modal" data-target="#htLgModal">
                                            <i class="fa fa-send"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-left text-danger" style="font-size: 30px">Total</th>
                                    <th class="text-left text-danger" style="font-size: 30px">
                                        ~ {{round($careTotalCount)}} m
                                    </th>
                                    @if(round($careTotalCount) < ($htSmall+$htMedium+$htLarge))
                                        <th class="text-right text-danger"
                                            style="font-size: 30px">{{$htSmall+$htMedium+$htLarge}} m
                                        </th>
                                    @else
                                        <th class="text-right text-danger" style="font-size: 30px">
                                            {{round($htSmall+$htMedium+$htLarge)}} m
                                            <img src="{{asset('assets/images/myImages/warning.gif')}}"/>
                                        </th>
                                    @endif
                                </tr>
                                <tr class="blank_row">
                                    <td colspan="4"></td>
                                </tr>
                                <tr>
                                    <th class="text-left border-bottom border-white" colspan="4"></th>
                                </tr>
                                <tr class="blank_row">
                                    <td colspan="4"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals Polyester-s-->
    <x-smart-dashboard.m-r-n-modal
        materialName="Polyester-s"
        modalName="polyesterSModal"
    ></x-smart-dashboard.m-r-n-modal>
    <!-- Modals Polyester-s-->
    <!-- Modals Polyester-m-->
    <x-smart-dashboard.m-r-n-modal
        materialName="Polyester-m"
        modalName="polyesterMModal"
    ></x-smart-dashboard.m-r-n-modal>
    </div>
    <!-- Modals Polyester-m-->
    <!-- Modals Polyester-lg-->
    <x-smart-dashboard.m-r-n-modal
        materialName="Polyester-lg"
        modalName="polyesterLgModal"
    ></x-smart-dashboard.m-r-n-modal>
    </div>
    <!-- Modals Polyester-lg-->
    <!-- Modals Polyester-s-->
    <x-smart-dashboard.m-r-n-modal
        materialName="Cotton-s"
        modalName="cottonSModal"
    ></x-smart-dashboard.m-r-n-modal>
    <!-- Modals Polyester-s-->
    <!-- Modals Polyester-m-->
    <x-smart-dashboard.m-r-n-modal
        materialName="Cotton-m"
        modalName="cottonMModal"
    ></x-smart-dashboard.m-r-n-modal>
    </div>
    <!-- Modals Polyester-m-->
    <!-- Modals Polyester-lg-->
    <x-smart-dashboard.m-r-n-modal
        materialName="Cotton-lg"
        modalName="cottonLgModal"
    ></x-smart-dashboard.m-r-n-modal>
    </div>
    <!-- Modals Polyester-lg-->
    <!-- Modals Polyester-s-->
    <x-smart-dashboard.m-r-n-modal
        materialName="Heat Transfer-s"
        modalName="htSModal"
    ></x-smart-dashboard.m-r-n-modal>
    <!-- Modals Polyester-s-->
    <!-- Modals Polyester-m-->
    <x-smart-dashboard.m-r-n-modal
        materialName="Heat Transfer-m"
        modalName="htMModal"
    ></x-smart-dashboard.m-r-n-modal>
    </div>
    <!-- Modals Polyester-m-->
    <!-- Modals Polyester-lg-->
    <x-smart-dashboard.m-r-n-modal
        materialName="Heat Transfer-lg"
        modalName="htLgModal"
    ></x-smart-dashboard.m-r-n-modal>
    </div>
    <!-- Modals Polyester-lg-->
@endsection
@section('custom-js')
    @if (session()->has('success_msg'))
        <script>
            swal('Good job!', '{{ session('success_msg') }}', 'success');
        </script>
    @endif
    @if (session()->has('error_msg'))
        <script>
            swal('Error occured!', '{{ session('error_msg') }}', 'error');
        </script>
    @endif
    @if (session()->has('errors'))
        <script>
            swal('Error Occurred!', '{{ $errors->first() }}', 'error');
        </script>
    @endif
@endsection

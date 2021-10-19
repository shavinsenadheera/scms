@extends('template.index')
@section('content')
    <div class="content-wrapper">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 my-2">
                @hasanyrole('super_admin|it_admin')
                <div class="card">
                    <div class="card-header p-2 font-weight-bold">
                        <i class="mdi mdi-link"></i> Quick links
                    </div>
                    <div class="class-body">
                        <div class="row">
                            @can('user_handling')
                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                                    <div class="card bg-primary text-center text-white">
                                        <div class="card-header p-3 bg-primary">
                                            <a href="{{ route('user.index') }}"
                                               class="text-white text-decoration-none font-weight-bold">
                                                <i class="mdi mdi-link-plus"></i> {!! trans('dashboard.userCreation') !!}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                            @can('role_handling')
                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                                    <div class="card bg-primary text-center text-white">
                                        <div class="card-header p-3 bg-primary">
                                            <a href="{{ route('role.index') }}"
                                               class="text-white text-decoration-none font-weight-bold">
                                                <i class="mdi mdi-link-plus"></i> Role creation
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                            @can('permission_handling')
                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                                    <div class="card bg-primary text-center text-white">
                                        <div class="card-header p-3 bg-primary">
                                            <a href="{{ route('permission.index') }}"
                                               class="text-white text-decoration-none font-weight-bold">
                                                <i class="mdi mdi-link-plus"></i> Permission creation
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                            @can('employee_handling')
                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                                    <div class="card bg-primary text-center text-white">
                                        <div class="card-header p-3 bg-primary">
                                            <a href="{{ route('employee.index') }}"
                                               class="text-white text-decoration-none font-weight-bold">
                                                <i class="mdi mdi-link-plus"></i> Employee creation
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header p-2 font-weight-bold">
                        <i class="mdi mdi-link"></i> General details
                    </div>
                    <div class="class-body">
                        <div class="row">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                <div class="card bg-transparent text-center text-white p-0">
                                    <div class="card-header p-3 bg-success font-weight-bold">
                                        <i class="fa fa-toggle-on"></i> Online users @isset($onlineUsers) {{$onlineUsers}} @endisset
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                <div class="card bg-transparent text-center text-white p-0">
                                    <div class="card-header p-3 bg-primary font-weight-bold">
                                        <i class="fa fa-users"></i> Users @isset($usersCount) {{ $usersCount }} @endisset
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                <div class="card bg-transparent text-center text-white p-0">
                                    <div class="card-header p-3 bg-primary font-weight-bold">
                                        <i class="fa fa-users"></i> Employee @isset($employeeCount) {{ $employeeCount }} @endisset
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header p-2 font-weight-bold">
                        <i class="mdi mdi-link"></i> App details
                    </div>
                    <div class="class-body">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="card bg-transparent text-center text-white p-0">
                                    <div class="card-header p-3 bg-danger font-weight-bold">
                                        <i class="fa fa-exclamation-triangle"></i> Error counts @isset($errorCount) {{ $errorCount }} @endisset
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="card bg-transparent text-center text-white p-0">
                                    <div class="card-header p-3 bg-warning">
                                        <a href="{{ route('error.index') }}"
                                           class="text-white text-decoration-none font-weight-bold">
                                            <i class="fa fa-link"></i> Go to errors
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endhasanyrole
                @role('cs_manager')
                <div class="card">
                    <div class="card-header p-2">
                        <i class="mdi mdi-message-image"></i> Orders summary
                    </div>
                    <div class="class-body">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div id="orderscomparison"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div id="customerordercomparison"></div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="card">
                                    <div class="card-header p-2 text-primary">
                                        <div class="float-left">
                                            <i class="mdi mdi-shopping"></i> {{ __('dashboard.my_job_sum') }}
                                        </div>
                                        <div class="float-right">
                                            <td>
                                                <a href="{{ route('order.index') }}" class="btn btn-sm btn-primary"><i
                                                        class="mdi mdi-more"></i> @lang('dashboard.more')</a>
                                            </td>
                                        </div>
                                    </div>
                                    <div class="card-body p-2 bg-light text-white">
                                        <table class="table table-borderless">
                                            <tbody>
                                            <tr class="bg-danger">
                                                <th class="text-white">Delayed orders</th>
                                                <td class="text-white">{{ $delayedOrderCount }}</td>
                                            </tr>
                                            <tr class="bg-warning">
                                                <th class="text-white">Pending orders</th>
                                                <td class="text-white">{{ (int)$totalJobCount - (int)$takenJobCount }}</td>
                                            </tr>
                                            <tr>
                                                <th>Total orders</th>
                                                <td>{{ $totalJobCount }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endrole
                @hasanyrole('cs_manager|cs_coordinator')
                <div class="card mt-3">
                    <div class="card-header p-2">
                        <i class="mdi mdi-shopping"></i> {{ __('dashboard.my_jobs') }}
                    </div>
                    <div class="card-body p-2">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div id="myjobs"></div>
                        </div>
                        <div class="row">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                <div id="myjobcomparison"></div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 my-2">
                                <a href="{{ route('dashboard.myjobs') }}" class="text-decoration-none">
                                    <div class="card">
                                        <div class="card-header p-2">
                                            <i class="mdi mdi-shopping"></i> {{ __('dashboard.my_job_sum') }}
                                        </div>
                                        <div class="card-body p-2  bg-primary text-white">
                                            @lang('dashboard.notice_1_1') @isset($myJobsCount){{ $myJobsCount }} @else
                                                0 @endif @lang('dashboard.notice_1_2')
                                        </div>
                                        <div class="card-footer">
                                            <a class="btn btn-primary"
                                               data-toggle="collapse"
                                               href="#collapseExample"
                                               role="button"
                                               aria-expanded="false"
                                               aria-controls="collapseExample"
                                            >
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                            <a class="btn btn-primary" href="{{ route('dashboard.myjobs') }}">
                                                <i class="mdi mdi-more"></i> @lang('dashboard.more')
                                            </a>
                                            <div id="collapseExample">
                                                <div class="card card-body">
                                                    <table style="font-size: 12px">
                                                        <thead>
                                                        <tr>
                                                            <th>Customer</th>
                                                            <th>Tot</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @isset($myJobs)
                                                            @foreach($myJobs as $data)
                                                                <tr>
                                                                    <td>{{ $data->customer->name }}</td>
                                                                    <td>{{ $data->totalCount }}</td>
                                                                </tr>
                                                            @endforeach
                                                        @endisset
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 my-2">
                                <a href="{{ route('dashboard.myjobs') }}" class="text-decoration-none">
                                    <div class="card">
                                        <div class="card-header p-2">
                                            <i class="mdi mdi-summit"></i> Total job summary
                                        </div>
                                        <div
                                            class="card-body p-2 {{ (int)$totalJobCount - (int)$takenJobCount > 0 ? 'bg-warning' : 'bg-success' }} text-white">
                                            @if((int)$totalJobCount - (int)$takenJobCount > 0)orders are pending @else
                                                all orders are processing @endif
                                        </div>
                                        <div class="card-footer">
                                            <a class="btn btn-primary"
                                               data-toggle="collapse"
                                               href="#collapseExample1"
                                               role="button"
                                               aria-expanded="false"
                                               aria-controls="collapseExample"
                                            >
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                            <a class="btn btn-primary" href="{{ route('order.index') }}">
                                                <i class="mdi mdi-more"></i> @lang('dashboard.more')
                                            </a>
                                            <div id="collapseExample1">
                                                <div class="card card-body">
                                                    <table style="font-size: 12px" class="w-100">
                                                        <tbody>
                                                        <tr class="bg-primary text-white">
                                                            <th class="p-1">Total orders</th>
                                                            <td class="p-1">{{ $totalJobCount }}</td>
                                                        </tr>
                                                        <tr class="bg-success text-white">
                                                            <th class="p-1">Taken orders</th>
                                                            <td class="p-1">{{ $takenJobCount }}</td>
                                                        </tr>
                                                        <tr class="bg-warning text-white">
                                                            <th class="p-1">Pending Orders</th>
                                                            <td class="p-1">{{ (int)$totalJobCount - (int)$takenJobCount }}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endhasanyrole
                @hasanyrole('super_admin|store_manager|store_coordinator')
                <div class="mt-3">

                </div>
                @endhasanyrole
            </div>
        </div>
    </div>
@endsection
@section('custom-js')
    <script type="text/javascript" src="{{ asset('assets/highcharts/highcharts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/highcharts/accessibility.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/highcharts/export-data.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/highcharts/exporting.js') }}"></script>
    @isset($dateTotalCount)
    <script type="text/javascript">
        var dateTotalCount = <?php echo json_encode($dateTotalCount) ?>;
        var dateOrders = <?php echo json_encode($dateOrders) ?>;
        Highcharts.chart('orderscomparison', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Total orders per day'
            },
            xAxis: {
                categories: dateOrders,
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Order count'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr>  ' +
                    '               <td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '               <td style="padding:0"><b>{point.y}</b></td>' +
                    '         </tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Total orders',
                data: dateTotalCount

            }],
            colors: ['#064c7b']
        });
    </script>
@endisset
    <script type="text/javascript">
        var mCustomerIds = <?php echo json_encode($mCustomerIds) ?>;
        var myProJobsCount = <?php echo json_encode($mTotalCount) ?>;
        Highcharts.chart('myjobcomparison', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Browser market shares in January, 2018'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Brands',
                colorByPoint: true,
                data: [{
                    'y': myFinJobsCount,
                    'name': 'Delivered orders',
                }, {
                    'y': myProJobsCount,
                    'name': 'Processing orders',
                }]
            }],
            colors: ['#326aff', '#064c7b']
        });
    </script>

    <script type="text/javascript">
        var customerIds = <?php echo json_encode($customerIds) ?>;
        var totalCounts = <?php echo json_encode($totalCount) ?>;

        Highcharts.chart('myjobs', {
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Taken orders summary'
            },
            xAxis: {
                categories: customerIds
            },
            yAxis: {
                title: {
                    text: 'Number of orders'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
            plotOptions: {
                series: {
                    allowPointSelect: true
                }
            },
            series: [{
                name: 'Total orders',
                data: totalCounts
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            },
            colors: ['#064c7b']

        });
    </script>

    <script type="text/javascript">
        var myFinJobsCount = <?php echo json_encode($myFinJobsCount) ?>;
        var myProJobsCount = <?php echo json_encode($myProJobsCount) ?>;
        Highcharts.chart('myjobcomparison', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'My orders status'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Order counts',
                colorByPoint: true,
                data: [{
                    'y': myFinJobsCount,
                    'name': 'Delivered orders',
                }, {
                    'y': myProJobsCount,
                    'name': 'Processing orders',
                }]
            }],
            colors: ['#326aff', '#064c7b']
        });
    </script>

    <script type="text/javascript">
        var mCustomerIds = <?php echo json_encode($mCustomerIds) ?>;
        var mTotalCount = <?php echo json_encode($mTotalCount) ?>;
        Highcharts.chart('customerordercomparison', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Total orders for each customer'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Order counts',
                colorByPoint: true,
                data: [
                        @for($i=0; $i < count($mCustomerIds); $i++)
                    {
                        name: "{{ $mCustomerIds[$i] }}",
                        y: {{ $mTotalCount[$i] }}
                    },
                    @endfor
                ],
            }],
        });
    </script>
@endsection

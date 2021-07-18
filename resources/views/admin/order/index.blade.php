@extends('template.index')
@section('content')
    <div class="content-wrapper">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('general.breadcrumb.dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.order_management') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('general.breadcrumb.order.order_handling') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 text-center my-3">
                <a class="btn btn-sm btn-primary" href="#view_all">
                    <i class="mdi mdi-arrow-down"></i> {{ __('order.view_all') }}
                </a>
                <a class="btn btn-sm btn-danger" href="#view_delayed">
                    <i class="mdi mdi-traffic-light"></i> {{ __('order.view_delayed') }}
                </a>
                <a class="btn btn-sm btn-success" href="#view_done">
                    <i class="mdi mdi-truck-delivery"></i> {{ __('order.view_done') }}
                </a>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 stretch-card p-0">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-header pt-3 font-weight-bold">
                            {{ __('order.early') }}
                        </div>
                        @isset($orders)
                        @foreach($orders as $data)
                            @if(date("Y-m-j",strtotime($data->created_at)) < date("Y-m-j") and !$data->taken_by)
                                <span hidden>{{ $total_qty=0 }}</span>
                                @foreach(json_decode($data->quantity) as $qty)
                                     <span hidden>{{ $total_qty += $qty }}</span>
                                @endforeach
                                <div class="card-body py-2">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-sm btn-primary">{{ $data->customer->name }}</button>
                                        <button type="button" class="btn btn-sm btn-light">{{ $data->delivery_date }}</button>
                                        <button type="button" class="btn btn-sm btn-light">{{ __('order.total_qty',[ 'QTY' => $total_qty ]) }}</button>
                                        <a type="button" class="btn btn-sm btn-success" href="{{ route('order.show',encrypt($data->id)) }}">@lang('order.view')</a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        @else
                            <div class="card-body">
                                <h6 class="text-warning">{{ __('order.no_orders') }}</h6>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-header pt-3 font-weight-bold">
                            {{ __('order.today') }}
                        </div>
                        @if($orders)
                        @foreach($orders as $data)
                            @if(date("Y-m-j",strtotime($data->created_at))===now()->toDateString())
                                <span hidden>{{ $total_qty=0 }}</span>
                                @foreach(json_decode($data->quantity) as $qty)
                                    <span hidden>{{ $total_qty += $qty }}</span>
                                @endforeach
                                <div class="card-body py-1">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-sm btn-primary">{{ $data->customer->name }}</button>
                                        <button type="button" class="btn btn-sm btn-light">{{ $data->delivery_date }}</button>
                                        <button type="button" class="btn btn-sm btn-light">Total qty = {{ $total_qty }}</button>
                                        <a type="button" class="btn btn-sm btn-success" href="{{ route('order.show',encrypt($data->id)) }}">View</a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        @else
                            <div class="card-body">
                                <h6 class="text-warning">{{ __('order.no_orders') }}</h6>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 text-center">
                    <button class="btn btn-sm btn-primary"><i class="mdi mdi-arrow-down"></i> {{ __('order.view_all') }}</button>

                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 bg-white mt-3" id="view_all">
                    <table id="datatable-1" class="table table-hover w-100">
                        <thead>
                            <tr>
                                <th>{{ __('order.action') }}</th>
                                <th>{{ __('order.orderno') }}</th>
                                <th>{{ __('order.customer') }}</th>
                                <th>{{ __('order.order_time') }}</th>
                                <th>{{ __('order.delivery_date') }}</th>
                                <th>{{ __('order.days_rem') }}</th>
                                <th>{{ __('order.coordinate_status') }}</th>
                                <th>{{ __('order.current_status') }}</th>
                                <th>{{ __('order.label_type') }}</th>
                                <th>{{ __('order.totalqty') }}</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>{{ __('order.action') }}</th>
                                <th>{{ __('order.orderno') }}</th>
                                <th>{{ __('order.customer') }}</th>
                                <th>{{ __('order.order_time') }}</th>
                                <th>{{ __('order.delivery_date') }}</th>
                                <th>{{ __('order.days_rem') }}</th>
                                <th>{{ __('order.coordinate_status') }}</th>
                                <th>{{ __('order.current_status') }}</th>
                                <th>{{ __('order.label_type') }}</th>
                                <th>{{ __('order.totalqty') }}</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($orders as $data)
                                <span hidden>{{ $total_qty=0 }}</span>
                                @foreach(json_decode($data->quantity) as $qty)
                                    <span hidden>{{ $total_qty += $qty }}</span>
                                @endforeach
                            <tr>
                                <td><a href="{{ route('order.show',encrypt($data->id)) }}" class="btn btn-sm btn-primary"><i class="mdi mdi-eye"></i></a></td>
                                <td>{{ $data->order_no }}</td>
                                <td>{{ $data->customer->name }}</td>
                                <td>{{ date('Y-m-j', strtotime($data->created_at)) }}</td>
                                <td>{{ $data->delivery_date }}</td>
                                <span hidden>{{ $diffOriginDate = strtotime($data->delivery_date) - strtotime((date("Y-m-j",strtotime($data->created_at)))) }}</span>
                                <span hidden>{{ $diffNowDate = strtotime($data->delivery_date) - time() }}</span>
                                <span hidden>{{ $origindays = round($diffOriginDate / (60 * 60 * 24)) }}</span>
                                <span hidden>{{ $nowdays = round($diffNowDate / (60 * 60 * 24)) }}</span>
                                <span hidden>{{ $nowdays > 0 ? $nowdays=$nowdays : $nowdays=0 }}</span>
                                <td class="{{ $nowdays > 10 ? 'bg-success text-white' : 'bg-danger text-white' }}">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: {{ ($nowdays/$origindays)*100 }}%" aria-valuenow="{{ $nowdays }}" aria-valuemin="0" aria-valuemax="{{ $origindays }}"><span style="font-size: 10px">{{ $nowdays }} days</span></div>
                                    </div>
                                </td>
                                <td class="{{ $data->taken_by ? 'bg-primary text-white' : 'bg-warning text-white' }}">@if($data->taken_by) Taken @else Not taken @endif</td>
                                <td>@if($data->current_status_id){{ $data->status->description }} @else Pending @endif</td>
                                <td>{{ $data->labeltype->name }}</td>
                                <td>{{ $total_qty }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 text-center">
                    <button class="btn btn-sm btn-danger"><i class="mdi mdi-traffic-light"></i> @lang('order.delayed_orders')</button>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 bg-white mt-3" id="view_delayed">
                    <table id="datatable-2" class="table table-hover w-100">
                        <thead>
                        <tr>
                            <th>{{ __('order.action') }}</th>
                            <th>{{ __('order.orderno') }}</th>
                            <th>{{ __('order.customer') }}</th>
                            <th>{{ __('order.order_time') }}</th>
                            <th>{{ __('order.delivery_date') }}</th>
                            <th>{{ __('order.coordinate_status') }}</th>
                            <th>{{ __('order.current_status') }}</th>
                            <th>{{ __('order.label_type') }}</th>
                            <th>{{ __('order.totalqty') }}</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>{{ __('order.action') }}</th>
                            <th>{{ __('order.orderno') }}</th>
                            <th>{{ __('order.customer') }}</th>
                            <th>{{ __('order.order_time') }}</th>
                            <th>{{ __('order.delivery_date') }}</th>
                            <th>{{ __('order.coordinate_status') }}</th>
                            <th>{{ __('order.current_status') }}</th>
                            <th>{{ __('order.label_type') }}</th>
                            <th>{{ __('order.totalqty') }}</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($delayedOrders as $data)
                            <span hidden>{{ $total_qty=0 }}</span>
                            @foreach(json_decode($data->quantity) as $qty)
                                <span hidden>{{ $total_qty += $qty }}</span>
                            @endforeach
                            <tr>
                                <td><a href="{{ route('order.show',encrypt($data->id)) }}" class="btn btn-sm btn-primary"><i class="mdi mdi-eye"></i></a></td>
                                <td>{{ $data->order_no }}</td>
                                <td>{{ $data->customer->name }}</td>
                                <td>{{ date('Y-m-j', strtotime($data->created_at)) }}</td>
                                <td>{{ $data->delivery_date }}</td>
                                <td class="{{ $data->taken_by ? 'bg-primary text-white' : 'bg-warning text-white' }}">@if($data->taken_by) Taken @else Not taken @endif</td>
                                <td>@if($data->current_status_id){{ $data->status->description }} @else Pending @endif</td>
                                <td>{{ $data->labeltype->name }}</td>
                                <td>{{ $total_qty }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 text-center">
                    <button class="btn btn-sm btn-success"><i class="mdi mdi-truck-delivery"></i> {{ __('order.view_done') }}</button>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 bg-white mt-3" id="view_done">
                    <table id="datatable-4" class="table table-hover w-100">
                        <thead>
                            <tr>
                                <th>{{ __('order.action') }}</th>
                                <th>{{ __('order.orderno') }}</th>
                                <th>{{ __('order.customer') }}</th>
                                <th>{{ __('order.order_time') }}</th>
                                <th>{{ __('order.delivery_date') }}</th>
                                <th>{{ __('order.coordinate_status') }}</th>
                                <th>{{ __('order.current_status') }}</th>
                                <th>{{ __('order.label_type') }}</th>
                                <th>{{ __('order.totalqty') }}</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>{{ __('order.action') }}</th>
                                <th>{{ __('order.orderno') }}</th>
                                <th>{{ __('order.customer') }}</th>
                                <th>{{ __('order.order_time') }}</th>
                                <th>{{ __('order.delivery_date') }}</th>
                                <th>{{ __('order.coordinate_status') }}</th>
                                <th>{{ __('order.current_status') }}</th>
                                <th>{{ __('order.label_type') }}</th>
                                <th>{{ __('order.totalqty') }}</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($done_orders as $data)
                                <span hidden>{{ $total_qty=0 }}</span>
                                @foreach(json_decode($data->quantity) as $qty)
                                    <span hidden>{{ $total_qty += $qty }}</span>
                                @endforeach
                            <tr>
                                <td><a href="{{ route('order.show',encrypt($data->id)) }}" class="btn btn-sm btn-primary"><i class="mdi mdi-eye"></i></a></td>
                                <td>{{ $data->order_no }}</td>
                                <td>{{ $data->customer->name }}</td>
                                <td>{{ date('Y-m-j', strtotime($data->created_at)) }}</td>
                                <td>{{ $data->delivery_date }}</td>
                                <td class="{{ $data->taken_by ? 'bg-primary text-white' : 'bg-warning text-white' }}">@if($data->taken_by) Taken @else Not taken @endif</td>
                                <td>@if($data->current_status_id){{ $data->status->description }} @else Pending @endif</td>
                                <td>{{ $data->labeltype->name }}</td>
                                <td>{{ $total_qty }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-js')
    @if (session()->has('success_msg'))
        <script>
            swal('Good job!','{{ session('success_msg') }}','success');
        </script>
    @endif
    @if (session()->has('errors'))
        <script>
            swal('Error Occurred!','{{ $errors->first() }}','error');
        </script>
    @endif
@endsection

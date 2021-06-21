@extends('Template.index')
@section('content')
    <div class="content-wrapper">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.order_management') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('order.index') }}">{{ __('general.breadcrumb.order.order_handling') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $order->order_no }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 stretch-card">
                <div class="card">
                    <div class="card-header bg-primary text-white p-3">
                        <h6 class="float-left">{{ __('order.order_no', ['ORDER_NO'=>$order->order_no]) }}</h6>
                        <h6 class="float-right">@isset($order->current_status_id) @lang('order.current_status'): {{ $order->status->description }} / @lang('order.taken_by'): {{ $order->employee->name }} @endisset</h6>
                    </div>
                    <div id="accordion">
                        <div class="card">
                            <div class="card-header p-1" id="headingOne">
                                <h5 class="m-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        {{ __('order.customer_details') }} <i class="mdi mdi-menu-down"></i>
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-borderless w-100">
                                            <tr>
                                                <th>{{ __('order.customer_name') }}</th>
                                                <td>{{ $order->customer->name }}</td>
                                                <th>{{ __('order.customer_email') }}</th>
                                                <td>{{ $order->customer->email }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __('order.customer_address') }}</th>
                                                <td>
                                                    {{ $order->customer->address_line_1 }}
                                                    @isset($order->customer->address_line_2 )
                                                        ,{{ $order->customer->address_line_2 }}
                                                    @endisset
                                                    @isset($order->customer->city )
                                                        ,{{ $order->customer->city }}
                                                    @endisset
                                                    @isset($order->customer->zipcode )
                                                        ,{{ $order->customer->zipcode }}
                                                    @endisset
                                                </td>
                                                <th>{{ __('order.customer_telno') }}</th>
                                                <td>{{ $order->customer->telephone_no }}</td>
                                            </tr>
                                            <tr>
                                                <th>{{ __('order.customer_telland') }}</th>
                                                <td>{{ $order->customer->telephone_land }}</td>
                                                <th>{{ __('order.customer_faxno') }}</th>
                                                <td>{{ $order->customer->telephone_fax }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-1">
                        <div class="table-responsive">
                            <table class="table table-borderless w-100">
                                <tr>
                                    <th>{{ __('order.customer_name') }}</th>
                                    <td>{{ $order->customer->name }}</td>
                                    <th>{{ __('order.delivery_date') }}</th>
                                    <td>{{ $order->delivery_date }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('order.label_type') }}</th>
                                    <td>{{ $order->labeltype->name }}</td>
                                    <th>{{ __('order.style_no') }}</th>
                                    <td>{{ $order->labelstyle->name }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <table class="table table-bordered table-hover bg-white">
                            <thead>
                                <tr>
                                    <th>{{ __('order.size') }}</th>
                                    <th>{{ __('order.qty') }}</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>{{ __('order.size') }}</th>
                                    <th>{{ __('order.qty') }}</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            @for($i = 0 ; $i < count(json_decode($order->size_no)); $i++ )
                                <tr>
                                    @foreach($sizes as $data)
                                    @if(json_decode($order->size_no)[$i]==$data->id)
                                        <td>{{ $data->name }}</td>
                                    @endif
                                    @endforeach
                                    <td>{{ json_decode($order->quantity)[$i] }}</td>
                                </tr>
                            @endfor
                            <tr class="bg-light">
                                <th class="text-success">{{ __('order.total') }}</th>
                                <th class="text-success">{{ $total }}</th>
                            </tr>
                            </tbody>
                        </table>
                        @if(!$order->taken_by)
                        <a class="btn btn-sm btn-primary mt-3" href="{{ route('order.cs.confirmation', encrypt($order->id)) }}"><i class="mdi mdi-content-save"></i> {{ __('order.confirm_order') }}</a>
                        @endisset
                        <a class="btn btn-sm btn-primary mt-3" href="{{ route('orders.export',encrypt($order->id)) }}"><i class="mdi mdi-file-excel"></i> {{ __('order.make_report') }}</a>
                    </div>
                </div>
            </div>
            @isset($order->orderstatus->status_1)
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 py-2">
                <div class="card">
                    <div class="card-header p-3">
                        <h3 class="h3 h3-responsive"><i class="mdi mdi-timeline"></i> @lang('order.timeline')</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="timeline">
                                    @isset($order->orderstatus->status_1)
                                        <div class="timeline-row">
                                            <div class="timeline-time">
                                                {{ $order->orderstatus->status_1_datetime }}
                                            </div>
                                            <div class="timeline-dot fb-bg"></div>
                                            <div class="timeline-content">
                                                <i class="mdi mdi-read"></i>
                                                <h6 class="text-left text-white">
                                                    {{ $order->orderstatus->status1->description }}
                                                </h6>
                                                <div class="text-left">
                                                    <small>
                                                        {{ __('order.taken_by') }}({{ __('employee.epfno') }}): {{ $order->employee->epfno }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    @endisset
                                    @isset($order->orderstatus->status_2)
                                        <div class="timeline-row">
                                            <div class="timeline-time">
                                                {{ $order->orderstatus->status_2_datetime }}
                                            </div>
                                            <div class="timeline-dot fb-bg"></div>
                                            <div class="timeline-content">
                                                <i class="mdi mdi-floor-plan"></i>
                                                <h6 class="text-left text-white">
                                                    {{ $order->orderstatus->status2->description }}
                                                </h6>
                                                <div class="text-left">
                                                    <small>
                                                        {{ __('order.scanned_by') }}({{ __('employee.epfno') }}): {{ $order->orderstatus->status2employee->epfno }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    @endisset
                                    @isset($order->orderstatus->status_3)
                                        <div class="timeline-row">
                                            <div class="timeline-time">
                                                {{ $order->orderstatus->status_3_datetime }}
                                            </div>
                                            <div class="timeline-dot fb-bg"></div>
                                            <div class="timeline-content">
                                                <i class="mdi mdi-worker"></i>
                                                <h6 class="text-left text-white">
                                                    {{ $order->orderstatus->status3->description }}
                                                </h6>
                                                <div class="text-left">
                                                    <small>
                                                        {{ __('order.scanned_by') }}({{ __('employee.epfno') }}): {{ $order->orderstatus->status3employee->epfno }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    @endisset
                                    @isset($order->orderstatus->status_4)
                                        <div class="timeline-row">
                                            <div class="timeline-time">
                                                {{ $order->orderstatus->status_4_datetime }}
                                            </div>
                                            <div class="timeline-dot fb-bg"></div>
                                            <div class="timeline-content">
                                                <i class="mdi mdi-package-variant"></i>
                                                <h6 class="text-left text-white">
                                                    {{ $order->orderstatus->status4->description }}
                                                </h6>
                                                <div class="text-left">
                                                    <small>
                                                        {{ __('order.scanned_by') }}({{ __('employee.epfno') }}): {{ $order->orderstatus->status4employee->epfno }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    @endisset
                                    @isset($order->orderstatus->status_5)
                                        <div class="timeline-row">
                                            <div class="timeline-time">
                                                {{ $order->orderstatus->status_5_datetime }}
                                            </div>
                                            <div class="timeline-dot fb-bg"></div>
                                            <div class="timeline-content">
                                                <i class="mdi mdi-truck-fast"></i>
                                                <h6 class="text-left text-white">
                                                    {{ $order->orderstatus->status5->description }}
                                                </h6>
                                                <div class="text-left">
                                                    <small>
                                                        {{ __('order.scanned_by')}}({{ __('employee.epfno') }}): {{ $order->orderstatus->status5employee->epfno }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    @endisset
                                    @isset($order->orderstatus->status_6)
                                        <div class="timeline-row">
                                            <div class="timeline-time">
                                                {{ $order->orderstatus->status_6_datetime }}
                                            </div>
                                            <div class="timeline-dot fb-bg"></div>
                                            <div class="timeline-content">
                                                <i class="mdi mdi-hand-okay"></i>
                                                <h6 class="text-left text-white">
                                                    {{ $order->orderstatus->status6->description }}
                                                </h6>
                                                <div class="text-left">
                                                    <small>
                                                        {{ __('order.scanned_by') }}({{ __('employee.epfno') }}): {{ $order->orderstatus->status6employee->epfno }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    @endisset
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>
            @endisset
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

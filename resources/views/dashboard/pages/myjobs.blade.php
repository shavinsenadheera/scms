@extends('template.index')
@section('content')
    <div class="content-wrapper">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">@lang('general.breadcrumb.dashboard')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('general.breadcrumb.dashboard_pages.dashboard_pages_myjobs')</li>
                    </ol>
                </nav>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 stretch-card mt-3">
                <div class="card">
                    <div class="card-header">
                        My jobs
                    </div>
                    <div class="card-body">
                        <table class="table table-hover w-100" id="datatable-1">
                            <thead>
                                <tr>
                                    <th>{{ __('order.action') }}</th>
                                    <th>{{ __('order.orderno') }}</th>
                                    <th>{{ __('order.order_time') }}</th>
                                    <th>{{ __('order.delivery_date') }}</th>
                                    <th>{{ __('order.customer_name') }}</th>
                                    <th>{{ __('order.label_type') }}</th>
                                    <th>{{ __('order.totalqty') }}</th>
                                    <th>{{ __('order.days_rem') }}</th>
                                    <th>{{ __('order.current_status') }}</th>
                                </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>{{ __('order.action') }}</th>
                                <th>{{ __('order.orderno') }}</th>
                                <th>{{ __('order.order_time') }}</th>
                                <th>{{ __('order.delivery_date') }}</th>
                                <th>{{ __('order.customer_name') }}</th>
                                <th>{{ __('order.label_type') }}</th>
                                <th>{{ __('order.totalqty') }}</th>
                                <th>{{ __('order.days_rem') }}</th>
                                <th>{{ __('order.current_status') }}</th>
                            </tr>
                            </tfoot>
                            <tbody>
                                @foreach($myProJobs as $data)
                                    <span hidden>{{ $total_qty=0 }}</span>
                                    @foreach(json_decode($data->quantity) as $qty)
                                        <span hidden>{{ $total_qty += $qty }}</span>
                                    @endforeach
                                    <tr>
                                        <td><a href="{{ route('order.show',encrypt($data->id)) }}" class="btn btn-sm btn-primary"><i class="mdi mdi-eye"></i></a></td>
                                        <td>{{ $data->order_no }}</td>
                                        <td>{{ $data->created_at }}</td>
                                        <td>{{ $data->delivery_date }}</td>
                                        <td>{{ $data->customer->name }}</td>
                                        <td>{{ $data->labeltype->name }}</td>
                                        <td>{{ $total_qty }}</td>
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
                                        <td>@if($data->current_status_id){{ $data->status->description }} @else Pending @endif</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 stretch-card mt-3">
                <div class="card">
                    <div class="card-header">
                        My Finish jobs
                    </div>
                    <div class="card-body">
                        <table class="table table-hover w-100" id="datatable-2">
                            <thead>
                            <tr>
                                <th>{{ __('order.action') }}</th>
                                <th>{{ __('order.orderno') }}</th>
                                <th>{{ __('order.order_time') }}</th>
                                <th>{{ __('order.delivery_date') }}</th>
                                <th>{{ __('order.customer_name') }}</th>
                                <th>{{ __('order.label_type') }}</th>
                                <th>{{ __('order.totalqty') }}</th>
                                <th>{{ __('order.current_status') }}</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>{{ __('order.action') }}</th>
                                <th>{{ __('order.orderno') }}</th>
                                <th>{{ __('order.order_time') }}</th>
                                <th>{{ __('order.delivery_date') }}</th>
                                <th>{{ __('order.customer_name') }}</th>
                                <th>{{ __('order.label_type') }}</th>
                                <th>{{ __('order.totalqty') }}</th>
                                <th>{{ __('order.current_status') }}</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($myFinJobs as $data)
                                <span hidden>{{ $total_qty=0 }}</span>
                                @foreach(json_decode($data->quantity) as $qty)
                                    <span hidden>{{ $total_qty += $qty }}</span>
                                @endforeach
                                <tr>
                                    <td><a href="{{ route('order.show',encrypt($data->id)) }}" class="btn btn-sm btn-primary"><i class="mdi mdi-eye"></i></a></td>
                                    <td>{{ $data->order_no }}</td>
                                    <td>{{ $data->created_at }}</td>
                                    <td>{{ $data->delivery_date }}</td>
                                    <td>{{ $data->customer->name }}</td>
                                    <td>{{ $data->labeltype->name }}</td>
                                    <td>{{ $total_qty }}</td>
                                    <td>@if($data->current_status_id){{ $data->status->description }} @else Pending @endif</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

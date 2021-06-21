@extends('template.index')
@section('content')
    <div class="content-wrapper">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.planning_management') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('order.index') }}">{{ __('general.breadcrumb.planning.planning_handling') }}</a></li>
                    </ol>
                </nav>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 stretch-card">
                <div class="card">
                    <div class="card-header p-3">
                        <a target="_blank" href="{{ route('planning.board') }}" class="btn btn-sm btn-dark"><i class="mdi mdi-monitor-dashboard"></i> {{ __('order.monitor_pb') }}</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover" id="datatable-1">
                            <thead>
                                <tr>
                                    <th>{{ __('order.action') }}</th>
                                    <th>{{ __('order.order_no') }}</th>
                                    <th>{{ __('order.priority') }}</th>
                                    <th>{{ __('order.customer') }}</th>
                                    <th>{{ __('order.delivery_date') }}</th>
                                    <th>{{ __('order.label_type') }}</th>
                                    <th>{{ __('order.total_qty') }}</th>
                                    <th>{{ __('order.days_rem') }}</th>
                                </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>{{ __('order.action') }}</th>
                                <th>{{ __('order.order_no') }}</th>
                                <th>{{ __('order.priority') }}</th>
                                <th>{{ __('order.customer') }}</th>
                                <th>{{ __('order.delivery_date') }}</th>
                                <th>{{ __('order.label_type') }}</th>
                                <th>{{ __('order.total_qty') }}</th>
                                <th>{{ __('order.days_rem') }}</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($orders as $data)
                                    <span hidden>{{ $total_qty=0 }}</span>
                                    @foreach(json_decode($data->quantity) as $qty)
                                        <span hidden>{{ $total_qty += $qty }}</span>
                                    @endforeach
                                    <tr>
                                        <form action="{{ route('planning.scanUpdate',encrypt($data->id)) }}" method="POST">
                                        @csrf
                                        {{ method_field('PUT') }}
                                        <td>
                                            <button type="submit" class="btn btn-sm btn-primary">
                                                <i class="mdi mdi-content-save-edit"></i> Save
                                            </button>
                                        </td>
                                        <td>{{ $data->order_no}}</td>
                                        <td>
                                            <select class="form-control" name="priority_id" id="priority_id">
                                                <option selected disabled>Choose</option>
                                                @foreach($priorities as $priority)
                                                    <option {{ $priority->id==$data->priority_id ? 'selected' : '' }} value="{{ $priority->id }}">{{ $priority->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>{{ $data->customer->name }}</td>
                                        <td>{{ $data->delivery_date }}</td>
                                        <td>{{ $data->labeltype->name }}</td>
                                        <td>{{ $total_qty }}</td>
                                        <span hidden>{{ $diffOriginDate = strtotime($data->delivery_date) - strtotime((date("Y-m-j",strtotime($data->created_at)))) }}</span>
                                        <span hidden>{{ $diffNowDate = strtotime($data->delivery_date) - time() }}</span>
                                        <span hidden>{{ $origindays = round($diffOriginDate / (60 * 60 * 24)) }}</span>
                                        <span hidden>{{ $nowdays = round($diffNowDate / (60 * 60 * 24)) }}</span>
                                        <td class="{{ $nowdays > 10 ? 'bg-success text-white' : 'bg-danger text-white' }}">
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: {{ ($nowdays/$origindays)*100 }}%" aria-valuenow="{{ $nowdays }}" aria-valuemin="0" aria-valuemax="{{ $origindays }}"><span style="font-size: 10px">{{ $nowdays }} days</span></div>
                                            </div>
                                        </td>
                                        </form>
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

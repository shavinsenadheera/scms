@extends('template.index')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">{{ __('general.breadcrumb.dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{route('customer.index')}}">{{ __('general.breadcrumb.customer_management') }}</a></li>
                    <li  class="breadcrumb-item active" aria-current="page">{{ __('general.breadcrumb.customer.customer_handling') }}</li>
                </ol>
            </nav>
            <div class="col-lg-12 col-md-12 col-sm-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ __('customer.customer_details') }}</h4>
                        <div class="card-description">
                            <a class="btn btn-icons btn-rounded btn-primary" href="{{ route('customer.create') }}">
                                <i class="mdi mdi-plus"></i>
                            </a>
                        </div>
                        <table class="table table-hover" id="datatable-1" style="width:100%">
                            <thead>
                            <tr>
                                <th> {!! trans('general.form.general.action') !!}</th>
                                <th> {!! trans('customer.name') !!}</th>
                                <th> {!! trans('customer.email') !!}</th>
                                <th> {!! trans('customer.telephone_no') !!}</th>
                                <th> {!! trans('customer.telephone_land') !!}</th>
                                <th> {!! trans('customer.telephone_fax') !!}</th>
                                <th> {!! trans('customer.activation') !!}</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th> {!! trans('general.form.general.action') !!}</th>
                                <th> {!! trans('customer.name') !!}</th>
                                <th> {!! trans('customer.email') !!}</th>
                                <th> {!! trans('customer.telephone_no') !!}</th>
                                <th> {!! trans('customer.telephone_land') !!}</th>
                                <th> {!! trans('customer.telephone_fax') !!}</th>
                                <th> {!! trans('customer.activation') !!}</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @if($customers)
                                @foreach($customers as $data)
                                    <tr>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a class="btn btn-primary" href="{{ route('customer.show',encrypt($data->id)) }}">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                            </div>
                                        </td>
                                        <td> {{ $data->name }} </td>
                                        <td> {{ $data->email }} </td>
                                        <td> {{ $data->telephone_no }} </td>
                                        <td> {{ $data->telephone_land }} </td>
                                        <td> {{ $data->telephone_fax }} </td>
                                        <td class="text-white @if($data->admin_status==0) bg-success @elseif($data->admin_status==1) bg-primary @else bg-warning @endif ">
                                            @if($data->admin_status==0)
                                                {{ __('customer.deactivate') }}
                                            @elseif($data->admin_status==1)
                                                {{ __('customer.activate') }}
                                            @else
                                                {{ __('customer.suspended') }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
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
@endsection

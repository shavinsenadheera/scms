@extends('Template.index')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('general.breadcrumb.dashboard') }}</a></li>
                    <li  class="breadcrumb-item active" aria-current="page">{{ __('general.breadcrumb.error.error_handling') }}</li>
                </ol>
            </nav>
            <div class="col-lg-12 col-md-12 col-sm-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ __('error.error_details') }}</h4>
                        <div class="card-description">
                            <a class="btn btn-danger" href="{{ route('error.deleteall') }}">
                                <i class="mdi mdi-format-clear"></i> {{ __('error.clear_log') }}
                            </a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped" id="datatable-1" style="width:100%;font-size: 10px">
                                <thead>
                                    <tr>
                                        <th>{{__('error.id')}}</th>
                                        <th>{{__('error.description')}}</th>
                                        <th>{{__('error.experienced_by')}}</th>
                                        <th>{{__('error.time')}}</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>{{__('error.id')}}</th>
                                        <th>{{__('error.description')}}</th>
                                        <th>{{__('error.experienced_by')}}</th>
                                        <th>{{__('error.time')}}</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                @isset($errors)
                                    @foreach($errors as $data)
                                        <tr>
                                            <td> {{ $data->id }} </td>
                                            <td> {{ $data->description }} </td>
                                            <td> {{ $data->users->name }} </td>
                                            <td> {{ $data->created_at }} </td>
                                        </tr>
                                    @endforeach
                                @endisset
                                </tbody>
                            </table>
                        </div>
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

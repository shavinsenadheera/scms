@extends('template.index')
@section('content')
    <div class="content-wrapper">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('log.index') }}">{{ __('general.breadcrumb.log_management') }}</a></li>
                        <li class="breadcrumb-item active"><a href="#!">{{ __('general.breadcrumb.log.log_history') }}</a></li>
                    </ol>
                </nav>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 stretch-card">
                <div class="card">
                    <div class="card-header p-3">
                        <div class="float-left">
                            <i class="fa fa-history"></i>
                            Full log history
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped" id="datatable-1">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Employee name</th>
                                    <th>Material name</th>
                                    <th>Request count</th>
                                    <th>Request time</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($mrlogs as $data)
                                <tr>
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->users->name }}</td>
                                    <td>{{ $data->materials->name }}</td>
                                    <td>{{ $data->request_count }}</td>
                                    <td>{{ $data->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Employee name</th>
                                    <th>Material name</th>
                                    <th>Request count</th>
                                    <th>Request time</th>
                                </tr>
                            </tfoot>
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
    @if (session()->has('error_msg'))
        <script>
            swal('Error Occurred!','{{ session('error_msg') }}','error');
        </script>
    @endif
    @if (session()->has('errors'))
        <script>
            swal('Error Occurred!','{{ $errors->first() }}','error');
        </script>
    @endif
@endsection

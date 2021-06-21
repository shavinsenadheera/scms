@extends('template.index')
@section('content')
    <div class="content-wrapper">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('log.index') }}">{{ __('general.breadcrumb.log_management') }}</a></li>
                        <li class="breadcrumb-item active"><a href="#!">{{ __('general.breadcrumb.log.log_handling') }}</a></li>
                    </ol>
                </nav>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 stretch-card">
                <form action="{{ route('log.accept', encrypt($mrlog->id)) }}">
                    <div class="card">
                        <div class="card-header p-3">
                            MRN Details
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered w-100">
                                <thead>
                                <tr>
                                    <th>Employee name</th>
                                    <td>{{ $mrlog->users->name }}</td>
                                </tr>
                                <tr>
                                    <th>Material name</th>
                                    <td>{{ $mrlog->materials->name }}</td>
                                </tr>
                                <tr>
                                    <th>Request count</th>
                                    <td>{{ $mrlog->request_count }}</td>
                                </tr>
                                <tr>
                                    <th>Material current quantity</th>
                                    <td>{{ $mrlog->materials->current_count }}</td>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="card-footer">
                            <div class="float-left">
                                @if($mrlog->status===0)
                                    <button type="submit" class="btn btn-success">Accept</button>
                                @else
                                    <button class="btn btn-success">Already accepted!</button>
                                @endif
                            </div>
                            <div class="float-right">
                                <a href="{{ route('log.index') }}" class="btn btn-dark">Back</a>
                            </div>
                        </div>
                    </div>
                </form>
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

@extends('template.index')
@section('content')
    <div class="content-wrapper">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.general_management') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('order.index') }}">{{ __('general.breadcrumb.order.order_handling') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('order.order_confirmation') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 stretch-card">
                <div class="card">
                    <div class="card-header p-3">
                        <h4>{{ __('order.confirm_notice_1') }}</h4>
                    </div>
                    <div class="card-body">
                        <a class="btn btn-sm btn-primary" href="{{ route('order.cs.confirm', $id) }}">{{ __('order.cs_confirm') }}</a>
                        <button class="btn btn-sm btn-success">{{ __('general.form.back') }}</button>
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

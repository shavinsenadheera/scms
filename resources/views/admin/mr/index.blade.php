@extends('template.index')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#!">@lang('general.breadcrumb.dashboard')</a></li>
                    <li class="breadcrumb-item"><a href="#!">@lang('general.breadcrumb.general_management')</a></li>
                    <li  class="breadcrumb-item active" aria-current="page">@lang('general.breadcrumb.department.department_handling')</li>
                </ol>
            </nav>
            <div class="col-lg-12 col-md-12 col-sm-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">@lang('department.department_details')</h4>
                        <div class="card-description">
                            <a class="btn btn-icons btn-rounded btn-primary" href="{{ route('department.create') }}">
                                <i class="mdi mdi-plus"></i>
                            </a>
                        </div>
                        <table class="table table-striped table-hover" id="datatable-1" style="width:100%">
                            <thead>
                            <tr>
                                <th> @lang('general.form.general.action') </th>
                                <th> # </th>
                                <th> @lang('department.code') </th>
                                <th> @lang('department.name') </th>
                            </tr>
                            </thead>
                            <tbody>
                            <span hidden>{{ $i=1 }}</span>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th> @lang('general.form.general.action') </th>
                                <th> # </th>
                                <th> @lang('department.code') </th>
                                <th> @lang('department.name') </th>
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
@endsection

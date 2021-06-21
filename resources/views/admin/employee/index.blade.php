@extends('Template.index')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.user_management') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('general.breadcrumb.employee.employee_handling') }}</li>
                </ol>
            </nav>
            <div class="col-lg-12 col-md-12 col-sm-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ __('employee.employee_details') }}</h4>
                        <div class="card-description">
                            <a class="btn btn-icons btn-rounded btn-primary" href="{{ route('employee.create') }}">
                                <i class="mdi mdi-plus"></i>
                            </a>
                        </div>
                        <table class="table table-striped table-hover" id="datatable-1" style="width:100%">
                            <thead>
                            <tr>
                                <th> {{ __('general.form.general.action') }}</th>
                                <th> # </th>
                                <th> {{ __('employee.epfno') }}</th>
                                <th> {{ __('employee.name') }}</th>
                                <th> {{ __('employee.contact_no') }}</th>
                                <th> {{ __('employee.department') }}</th>
                                <th> {{ __('employee.designation') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <span hidden>{{ $i=1 }}</span>
                            @if($employees)
                                @foreach($employees as $data)
                                    <tr>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a class="btn btn-primary" href="{{ route('employee.show',encrypt($data->id)) }}">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                                <a class="btn btn-danger" href="{{ route('employee.delete',encrypt($data->id)) }}">
                                                    <i class="mdi mdi-delete"></i>
                                                </a>
                                            </div>
                                        </td>
                                        <td> {{ $i++ }} </td>
                                        <td> {{ $data->epfno }} </td>
                                        <td> {{ $data->name }} </td>
                                        <td> {{ $data->contact_no }} </td>
                                        <td> {{ $data->department->name }} </td>
                                        <td> {{ $data->designation->name }} </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                <th> {{ __('general.form.general.action') }}</th>
                                <th> # </th>
                                <th> {{ __('employee.epfno') }}</th>
                                <th> {{ __('employee.name') }}</th>
                                <th> {{ __('employee.contact_no') }}</th>
                                <th> {{ __('employee.department') }}</th>
                                <th> {{ __('employee.designation') }}</th>
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

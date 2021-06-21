@extends('Template.index')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.user_management') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('general.breadcrumb.permission.permission_handling') }}</li>
                </ol>
            </nav>
            <div class="col-lg-12 col-md-12 col-sm-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ __('permission.permission_details') }}</h4>
                        <div class="card-description">
                            <a class="btn btn-icons btn-rounded btn-primary" href="{{ route('permission.create') }}">
                                <i class="mdi mdi-plus"></i>
                            </a>
                        </div>
                        <table class="table table-striped table-hover" id="datatable-1" style="width:100%">
                            <thead>
                                <tr>
                                    <th> {{ __('general.form.general.action') }} </th>
                                    <th> # </th>
                                    <th> {{ __('permission.name') }} </th>
                                    <th> {{ __('permission.description') }} </th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th> {{ __('general.form.general.action') }} </th>
                                    <th> # </th>
                                    <th> {{ __('permission.name') }} </th>
                                    <th> {{ __('permission.description') }} </th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <span hidden>{{ $i=1 }}</span>
                                @if($permissions)
                                @foreach($permissions as $data)
                                <tr>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a class="btn btn-primary" href="{{ route('permission.show', encrypt($data->id)) }}">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <a class="btn btn-danger" href="{{ route('permission.delete', encrypt($data->id)) }}">
                                                <i class="mdi mdi-delete"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <td> {{ $i++ }} </td>
                                    <td> {{ $data->name }} </td>
                                    <td> {{ $data->description }} </td>
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

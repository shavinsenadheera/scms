@extends('template.index')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{route('dashboard.index')}}">
                            {!! trans('general.breadcrumb.dashboard')  !!}
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {!! trans('general.breadcrumb.role.role_handling') !!}
                    </li>
                </ol>
            </nav>
            <div class="col-lg-12 col-md-12 col-sm-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{!! trans('role.role_details') !!}</h4>
                        <div class="card-description">
                            <a class="btn btn-icons btn-rounded btn-primary" href="{{ route('role.create') }}">
                                <i class="mdi mdi-plus"></i>
                            </a>
                        </div>
                        <table class="table table-striped table-hover" id="datatable-1" style="width:100%">
                            <thead>
                            <tr>
                                <th>{!! trans('general.form.general.action') !!}</th>
                                <th>{!! trans('role.name') !!}</th>
                                <th>{!! trans('role.description') !!}</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>{!! trans('general.form.general.action') !!}</th>
                                <th>{!! trans('role.name') !!}</th>
                                <th>{!! trans('role.description') !!}</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @if($roles)
                                @foreach($roles as $data)
                                    <tr>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a class="btn btn-primary" href="{{ route('role.show',encrypt($data->id)) }}">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                                <a class="btn btn-danger" href="{{ route('role.delete',encrypt($data->id)) }}">
                                                    <i class="mdi mdi-delete"></i>
                                                </a>
                                            </div>
                                        </td>
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

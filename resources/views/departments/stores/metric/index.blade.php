@extends('template.index')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.metric_management') }}</a></li>
                    <li  class="breadcrumb-item active" aria-current="page">{{ __('general.breadcrumb.metric.metric_handling') }}</li>
                </ol>
            </nav>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 stretch-card">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addMetric">
                        <i class="fa fa-plus"></i> {{__('material.index.add_metric')}}
                    </button>
                </div>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 stretch-card mt-3">
                <div class="card">
                    <div class="card-header p-3">
                        Metric Details
                    </div>
                    <div class="card-body p-3">
                        <table class="table table-striped" id="datatable-2">
                            <thead>
                            <tr>
                                <th>Actions</th>
                                <th>Name</th>
                                <th>Code</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($metrics as $data)
                                <tr>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            @can('edit')
                                            <a
                                                class="btn btn-primary"
                                                href="{{ route('metric.show',encrypt($data->id)) }}"
                                            >
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            @endcan
                                            @can('delete')
                                            <a
                                                class="btn btn-danger"
                                                href="{{ route('metric.delete',encrypt($data->id)) }}"
                                            >
                                                <i class="mdi mdi-trash-can"></i>
                                            </a>
                                            @endcan
                                        </div>
                                    </td>
                                    <td>{{ $data->name  }}</td>
                                    <td>{{ $data->code  }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Start Modals -->
    <div class="modal fade" id="addMetric" tabindex="-1" role="dialog" aria-labelledby="addMetricLabel" aria-hidden="true">
        <form class="needs-validation" action="{{ route('metric.store')}}" method="POST" novalidate>
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{__('material.index.add_metric')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="code">{{__('material.index.code')}}</label>
                            <input type="text" name="code" id="code" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label for="name">{{__('material.index.metric')}}</label>
                            <input type="text" name="name" id="name" class="form-control" required />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('general.form.close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('general.form.save_changes')}}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--End  Modals -->




@endsection
@section('custom-js')
    @if (session()->has('success_msg'))
        <script>
            swal('Good job!','{{ session('success_msg') }}','success');
        </script>
    @endif
@endsection

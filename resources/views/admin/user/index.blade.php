@can('user_handling')
@extends('Template.index')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.user_management') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('general.breadcrumb.user.user_handling') }}</li>
                </ol>
            </nav>

            <div class="col-lg-12 col-md-12 col-sm-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ __('user.user_details') }}</h4>
                        <div class="card-description">
                            <a class="btn btn-icons btn-rounded btn-primary" href="{{ route('user.create') }}">
                                <i class="mdi mdi-plus"></i>
                            </a>
                        </div>
                        <table class="table table-striped table-hover" id="datatable-1" style="width:100%">
                            <thead>
                            <tr>
                                <th> {{ __('general.form.general.action') }} </th>
                                <th> # </th>
                                <th> {{ __('user.name') }} </th>
                                <th> {{ __('user.email') }} </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($users)
                                @foreach($users as $data)
                                    <tr>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a class="btn btn-primary" href="{{ route('user.show',$data->id) }}">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                                <a class="btn btn-danger" href="{{ route('user.delete',$data->id) }}">
                                                    <i class="mdi mdi-delete"></i>
                                                </a>
                                            </div>
                                        </td>
                                        <td> {{ $data->id }} </td>
                                        <td> {{ $data->name }} </td>
                                        <td> {{ $data->email }} </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                <th> # </th>
                                <th> {{ __('user.name') }} </th>
                                <th> {{ __('user.email') }} </th>
                                <th> {{ __('general.form.general.action') }} </th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="userModel" tabindex="-1" role="dialog" aria-labelledby="userModelLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form class="needs-validation" action="{{ route('user.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name *</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="User name" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description *</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="User description" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-fw">
                            <i class="mdi mdi-file-document"></i>Add
                        </button>
                        <button type="button" class="btn btn-outline-danger btn-fw" data-dismiss="modal">
                            <i class="mdi mdi-close"></i>Cancel
                        </button>
                    </form>
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
@endcan

@extends('template.index')
@section('content')
    <div class="content-wrapper">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('dashboard.index')}}">
                                {!! trans('general.breadcrumb.dashboard') !!}
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('permission.index') }}">
                                {!!  trans('general.breadcrumb.permission.permission_handling') !!}
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {!! trans('general.breadcrumb.permission.permission_create') !!}
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{!! trans('general.breadcrumb.permission.permission_create') !!}</h4>
                        <form class="needs-validation" action="{{ route('permission.store') }}" method="POST" novalidate>
                            @csrf
                            <div class="form-group{{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name">{!! trans('permission.name') !!} *</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Permission name" required>
                                @error('name')
                                <p class="text-small text-danger">{{ $errors->first() }}</p>
                                @enderror
                            </div>
                            <div class="form-group{{ $errors->has('description') ? 'has-error' : '' }}">
                                <label for="description">{!! trans('permission.description') !!} *</label>
                                <input type="text" class="form-control" id="description" name="description" placeholder="Permission description" required>
                                @error('description')
                                <p class="text-small text-danger">{{ $errors->first() }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-fw">
                                <i class="mdi mdi-file-document"></i>{!! trans('general.form.add_details') !!}
                            </button>
                            <a class="btn btn-light" href="{{ route('permission.index') }}">
                                {!! trans('general.form.back') !!}
                            </a>
                        </form>
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

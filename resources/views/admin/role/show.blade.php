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
                        <a href="{{ route('role.index') }}">
                            {!! trans('general.breadcrumb.role.role_handling') !!}
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {!! trans('general.breadcrumb.role.role_edit') !!}
                    </li>
                </ol>
            </nav>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            <i class="mdi mdi-pencil"></i> {!! trans('general.breadcrumb.role.role_edit') !!}
                        </h4>
                        <form class="needs-validation" action="{{ route('role.update',$role->id) }}" method="POST" novalidate>
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="form-group{{ $errors->has('name') ? 'has-error' : ''}}">
                                <label for="name">{!! trans('role.name') !!}*</label>
                                <input type="text" class="form-control" name="name" id="name"
                                       placeholder="Enter name" value="{{ $role->name }}" required>
                                @error('name')
                                <p class="text-small text-danger">{{ $errors->first() }}</p>
                                @enderror
                            </div>
                            <div class="form-group{{ $errors->has('description') ? 'has-error' : ''}}">
                                <label for="description">{!! trans('role.description') !!} *</label>
                                <input type="text" class="form-control" name="description"
                                       id="description" placeholder="Enter description" value="{{ $role->description }}" required>
                                @error('description')
                                <p class="text-small text-danger">{{ $errors->first() }}</p>
                                @enderror
                            </div>
                            <div class="form-group{{ $errors->has('permission') ? 'has-error' : '' }}">
                                <label for="permission">{!! trans('role.permissions') !!} *</label>
                                <select class="form-control js-example-basic-multiple"
                                        name="permission[]" id="permission" multiple data-size="5" required>
                                    @foreach($permissions as $data)
                                        <option {{ in_array($data->id, $gotPermissions) ? 'selected' : '' }}
                                                value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                                @error('permission')
                                <p class="text-small text-danger">{{ $errors->first() }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-success mr-2">
                                <i class="mdi mdi-content-save"></i>{!! trans('general.form.save_changes') !!}
                            </button>
                            <a class="btn btn-light" href="{{ route('role.index') }}">{!! trans('general.form.back') !!}</a>
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


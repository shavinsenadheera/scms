@extends('template.index')
@section('content')
    <div class="content-wrapper">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.general_management') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('department.index') }}">{{ __('general.breadcrumb.department.department_handling') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('general.breadcrumb.department.department_edit') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><i class="mdi mdi-pencil"></i> {{ __('general.breadcrumb.department.department_edit') }}</h4>
                        <form class="needs-validation" action="{{ route('department.update',$department->id) }}" method="POST" novalidate>
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="form-group{{ $errors->has('code') ? 'has-error' : ''}}">
                                <label for="code">{{ __('department.code') }} *</label>
                                <input type="text" class="form-control" name="code" id="code" placeholder="Enter code" value="{{ $department->code }}" required>
                                @error('code')
                                <p class="text-small text-danger">{{ $errors->first() }}</p>
                                @enderror
                            </div>
                            <div class="form-group{{ $errors->has('name') ? 'has-error' : ''}}">
                                <label for="name">{{ __('department.name') }} *</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" value="{{ $department->name }}" required>
                                @error('name')
                                <p class="text-small text-danger">{{ $errors->first() }}</p>
                                @enderror
                            </div>
                            <div class="form-group{{ $errors->has('departmenthead_id') ? 'has-error' : '' }}">
                                <label for="departmenthead_id">{{ __('department.department_head') }} *</label>
                                <select class="form-control js-example-basic-single" name="departmenthead_id" id="departmenthead_id" required>
                                    @foreach($employees as $data)
                                        <option {{ $data->id==$department->departmenthead_id ? 'selected' : '' }} value="{{ $data->id }}">{{ $data->epfno }}-{{ $data->name }}</option>
                                    @endforeach
                                </select>
                                @error('departmenthead_id')
                                <p class="text-small text-danger">{{ $errors->first() }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-success mr-2">
                                <i class="mdi mdi-content-save"></i>{{ __('general.form.save_changes') }}
                            </button>
                            <a class="btn btn-light" href="{{ route('department.index') }}">{{ __('general.form.back') }}</a>
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

@extends('template.index')
@section('content')
    <div class="content-wrapper">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.general_management') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('employee.index') }}">{{ __('general.breadcrumb.employee.employee_handling') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('general.breadcrumb.employee.employee_create') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ __('general.breadcrumb.employee.employee_create') }}</h4>
                        <form class="needs-validation" action="{{ route('employee.store') }}" method="POST" novalidate>
                            @csrf
                            <div class="form-group{{ $errors->has('epfno') ? 'has-error' : '' }}">
                                <label for="epfno">{{ __('employee.epfno') }} *</label>
                                <input type="text" class="form-control" id="epfno" name="epfno" placeholder="Employee epf no" value="{{ old('epfno') ? old('epfno') : '' }}" required>
                                @error('epfno')
                                <p class="text-small text-danger">{{ $errors->first() }}</p>
                                @enderror
                            </div>
                            <div class="form-group{{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name">{{ __('employee.name') }} *</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Employee name" value="{{ old('name') ? old('name') : '' }}" required>
                                @error('name')
                                <p class="text-small text-danger">{{ $errors->first() }}</p>
                                @enderror
                            </div>
                            <div class="form-group{{ $errors->has('contact_no') ? 'has-error' : '' }}">
                                <label for="contact_no">{{ __('employee.contactno') }} *</label>
                                <input type="text" class="form-control" id="contact_no" name="contact_no" placeholder="Employee contact no" value="{{ old('contact_no') ? old('contact_no') : '' }}" required>
                                @error('contact_no')
                                <p class="text-small text-danger">{{ $errors->first() }}</p>
                                @enderror
                            </div>
                            <div class="form-group{{ $errors->has('department_id') ? 'has-error' : '' }}">
                                <label for="department_id">{{ __('employee.department') }} *</label>
                                <select class="form-control js-example-basic-single" name="department_id" id="department_id" required>
                                    <option selected disabled>{{ __('general.form.selector.disabled_option') }}</option>
                                    @foreach($departments as $data)
                                        <option {{ old('department_id')==$data->id ? 'selected' : ''  }} value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                <p class="text-small text-danger">{{ $errors->first() }}</p>
                                @enderror
                            </div>
                            <div class="form-group{{ $errors->has('designation_id') ? 'has-error' : '' }}">
                                <label for="designation_id">{{ __('employee.designation') }} *</label>
                                <select class="form-control js-example-basic-single" name="designation_id" id="designation_id" required>
                                    <option selected disabled>{{ __('general.form.selector.disabled_option') }}</option>
                                    @foreach($designations as $data)
                                        <option {{ old('designation_id')==$data->id ? 'selected' : ''  }} value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                                @error('designation_id')
                                <p class="text-small text-danger">{{ $errors->first() }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-fw">
                                <i class="mdi mdi-file-document"></i>{{ __('general.form.add_details') }}
                            </button>
                            <a class="btn btn-light" href="{{ route('employee.index') }}">
                                {{ __('general.form.back') }}
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

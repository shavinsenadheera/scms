@extends('Template.index')
@section('content')
    <div class="content-wrapper">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.user_management') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('employee.index') }}">{{ __('general.breadcrumb.employee.employee_handling') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('general.breadcrumb.employee.employee_edit') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><i class="mdi mdi-pencil"></i> {{ __('general.breadcrumb.employee.employee_edit') }}</h4>
                        <form class="needs-validation" action="{{ route('employee.update',$employee->id) }}" method="POST" novalidate>
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="form-group{{ $errors->has('epfno') ? 'has-error' : '' }}">
                                <label for="epfno">{{ __('employee.epfno') }} *</label>
                                <input type="text" class="form-control" id="epfno" name="epfno" placeholder="Employee epf no" value="{{ $employee->epfno }}" required>
                                @error('epfno')
                                <p class="text-small text-danger">{{ $errors->first() }}</p>
                                @enderror
                            </div>
                            <div class="form-group{{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name">{{ __('employee.name') }} *</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Employee name" value="{{ $employee->name }}" required>
                                @error('name')
                                <p class="text-small text-danger">{{ $errors->first() }}</p>
                                @enderror
                            </div>
                            <div class="form-group{{ $errors->has('contact_no') ? 'has-error' : '' }}">
                                <label for="contact_no">{{ __('employee.contactno') }} *</label>
                                <input type="text" class="form-control" id="contact_no" name="contact_no" placeholder="Employee contact no" value="{{ $employee->contact_no }}" required>
                                @error('contact_no')
                                <p class="text-small text-danger">{{ $errors->first() }}</p>
                                @enderror
                            </div>
                            <div class="form-group{{ $errors->has('department_id') ? 'has-error' : '' }}">
                                <label for="department_id">{{ __('employee.department') }} *</label>
                                <select class="form-control js-example-basic-single" name="department_id" id="department_id" required>
                                    <option selected disabled value="">{{ __('general.form.selector.disabled_option') }}</option>
                                    @foreach($departments as $data)
                                        <option {{ $employee->department_id==$data->id ? 'selected' : ''  }} value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                <p class="text-small text-danger">{{ $errors->first() }}</p>
                                @enderror
                            </div>
                            <div class="form-group{{ $errors->has('designation_id') ? 'has-error' : '' }}">
                                <label for="designation_id">{{ __('employee.designation') }} *</label>
                                <select class="form-control js-example-basic-single" name="designation_id" id="designation_id" required>
                                    <option selected disabled value="">{{ __('general.form.selector.disabled_option') }}</option>
                                    @foreach($designations as $data)
                                        <option {{ $employee->designation_id==$data->id ? 'selected' : ''  }} value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                                @error('designation_id')
                                <p class="text-small text-danger">{{ $errors->first() }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-success mr-2">
                                <i class="mdi mdi-content-save"></i>{{ __('general.form.save_changes') }}
                            </button>
                            <a class="btn btn-light" href="{{ route('designation.index') }}">{{ __('general.form.back') }}</a>
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

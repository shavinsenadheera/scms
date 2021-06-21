@extends('template.index')
@section('content')
    <div class="content-wrapper">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.user_management') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">{{ __('general.breadcrumb.user.user_handling') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('general.breadcrumb.user.user_create') }}</li>
                </ol>
            </nav>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">User create</h4>
                        <form class="needs-validation" action="{{ route('user.store') }}" method="POST" novalidate>
                            @csrf
                            <div class="form-group">
                                <label for="name">Name *</label>
                                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" name="name" id="name" placeholder="Enter name" value="{{ old('name') }}" required>
                                @error('name')
                                <p class="text-small text-danger">{{ $errors->first('name') }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Email *</label>
                                <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}" name="email" id="email" placeholder="Enter email" value="{{ old('email') }}" required>
                                @error('email')
                                <p class="text-small text-danger">{{ $errors->first('email') }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="employee_id">Employee *</label>
                                <select class="form-control js-example-basic-single {{ $errors->has('employee_id') ? 'is-invalid' : ''}}" name="employee_id" id="employee_id" required>
                                    @foreach($employees as $data)
                                        <option {{ old('employee_id')==$data->id ? 'selected' : '' }} value="{{ $data->id }}">{{ $data->epfno }}-{{ $data->name }}</option>
                                    @endforeach
                                </select>
                                @error('employee_id')
                                <p class="text-small text-danger">{{ $errors->first('employee_id') }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password *</label>
                                <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : ''}}" name="password" id="password" placeholder="Enter password" required>
                                @error('password')
                                <p class="text-small text-danger">{{ $errors->first('password') }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Password confirm *</label>
                                <input type="password" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : ''}}" name="password_confirmation" id=password_confirmation" placeholder="Password confirm" required>
                                @error('password_confirmation')
                                <p class="text-small text-danger">{{ $errors->first('password_confirmation') }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="role">Roles *</label>
                                <select class="form-control {{ $errors->has('role') ? 'is-invalid' : '' }} js-example-basic-multiple" name="role[]" id="role" multiple data-size="5" required>
                                    @foreach($roles as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                <p class="text-small text-danger">{{ $errors->first('role') }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="mdi mdi-file-document"></i>Add
                            </button>
                            <a class="btn btn-light" href="{{ route('user.index') }}">Back</a>
                            </div>
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

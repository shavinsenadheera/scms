@extends('template.index')
@section('content')
    <div class="content-wrapper">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.user_management') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('role.index') }}">{{ __('general.breadcrumb.user.user_handling') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('general.breadcrumb.user.user_edit') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><i class="mdi mdi-pencil"></i> {{ __('general.breadcrumb.user.user_edit') }}</h4>
                        <form class="needs-validation" action="{{ route('user.update',$user->id) }}" method="POST" novalidate>
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="form-group">
                                <label for="name">{{ __('user.name') }} *</label>
                                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" name="name" id="name" placeholder="Enter name" value="{{ $user->name }}" required>
                                @error('name')
                                <p class="text-small text-danger">{{ $errors->first('name') }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">{{ __('user.email') }} *</label>
                                <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}" name="email" id="email" placeholder="Enter email" value="{{ $user->email }}" required>
                                @error('email')
                                <p class="text-small text-danger">{{ $errors->first('email') }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="employee_id">{{ __('user.employee') }} *</label>
                                <select class="form-control js-example-basic-single {{ $errors->has('employee_id') ? 'is-invalid' : ''}}" name="employee_id" id="employee_id" required>
                                    @foreach($employees as $data)
                                        <option {{ $user->employee_id==$data->id ? 'selected' : '' }} value="{{ $data->id }}">{{ $data->epfno }}-{{ $data->name }}</option>
                                    @endforeach
                                </select>
                                @error('employee_id')
                                <p class="text-small text-danger">{{ $errors->first('employee_id') }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="role">{{ __('user.roles') }} *</label>
                                <select class="form-control {{ $errors->has('role') ? 'is-invalid' : '' }} js-example-basic-multiple" name="role[]" id="role" multiple data-size="5" required>
                                    @foreach($roles as $data)
                                        <option {{ $user->hasRole($data->id) ? 'selected' : '' }} value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                <p class="text-small text-danger">{{ $errors->first('role') }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-success mr-2">
                                <i class="mdi mdi-content-save"></i>{{ __('general.form.save_changes') }}
                            </button>
                            <a class="btn btn-light" href="{{ route('role.index') }}">{{ __('general.form.back') }}</a>
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


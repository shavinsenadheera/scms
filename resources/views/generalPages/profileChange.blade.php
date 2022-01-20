@extends('template.index')
@section('content')
    <div class="content-wrapper">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">{{ __('general.breadcrumb.dashboard') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('general.breadcrumb.user_profile') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title font-weight-bold">{{ __('general.breadcrumb.user_profile') }}</h4>
                        <form class="needs-validation mb-3" action="{{ route('user.updateProfile', encrypt(Auth::id())) }}" method="POST" novalidate>
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group{{ $errors->has('name') ? 'has-error' : '' }}">
                                        <label for="name">{{ __('user.name') }}</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="User name" value="{{ Auth::user()->name  }}">
                                        @error('name')
                                        <p class="text-small text-danger">{{ $errors->first() }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group{{ $errors->has('email') ? 'has-error' : '' }}">
                                        <label for="description">{{ __('user.email') }}</label>
                                        <input type="text" class="form-control" id="email" name="email" placeholder="User email" value="{{ Auth::user()->email  }}">
                                        @error('email')
                                        <p class="text-small text-danger">{{ $errors->first() }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <button type="submit" class="btn btn-primary btn-fw mr-1">
                                    <i class="mdi mdi-file-document"></i>{{ __('user.btn_change_profile') }}
                                </button>
                            </div>
                        </form>
                        <h4 class="card-title font-weight-bold">{{ __('user.change_password') }}</h4>
                        <form class="needs-validation mb-3" action="{{ route('user.updatePassword', encrypt(Auth::id())) }}" method="POST" novalidate>
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="col-12">
                                    <div class="form-group{{ $errors->has('password') ? 'has-error' : '' }}">
                                        <label for="current_password">{{ __('user.password') }} *</label>
                                        <input type="password" class="form-control" id="current_password" name="current_password" placeholder="User password" required>
                                        @error('current_password')
                                        <p class="text-small text-danger">{{ $errors->first() }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group{{ $errors->has('password_confirm') ? 'has-error' : '' }}">
                                        <label for="new_password">{{ __('user.new_password') }} *</label>
                                        <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New password" required>
                                        @error('new_password')
                                        <p class="text-small text-danger">{{ $errors->first() }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group{{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                                        <label for="password_confirmation">{{ __('user.confirm_password') }} *</label>
                                        <input type="password" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : ''}}" name="password_confirmation" id=password_confirmation" placeholder="Password confirm" required>
                                        @error('password_confirmation')
                                        <p class="text-small text-danger">{{ $errors->first('password_confirmation') }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <button type="submit" class="btn btn-primary btn-fw mr-1">
                                    <i class="mdi mdi-file-document"></i>{{ __('user.btn_change_pwd') }}
                                </button>
                                <a class="btn btn-light" href="{{ route('dashboard.index') }}">
                                    {{ __('general.form.back') }}
                                </a>
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
    @if (session()->has('error_msg'))
        <script>
            swal('Error Occurred!','{{ $errors->first() ? $errors->first() : session('error_msg') }}','error');
        </script>
    @endif
@endsection

@extends('layouts.app')
@section('content')
    <div class="bg-light shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
        <div class="btn-group" role="group" aria-label="Basic example">
            <a href="{{ route('welcome') }}" type="button" class="btn btn-outline-primary"><i class="fa fa-desktop"></i>Welcome</a>
            <a href="{{ route('login') }}" type="button" class="btn btn-primary"><i class="fa fa-unlock"></i>Login</a>
        </div>
        <hr>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group text-left">
                <label class="label">Username</label>
                <div class="input-group">
                    <input
                        id="email"
                        type="email"
                        class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}"
                        required
                        autocomplete="email"
                        autofocus
                    >
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                    </div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group text-left">
                <label class="label">Password</label>
                <div class="input-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                    </div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary submit-btn btn-block">Login</button>
            </div>
            <div class="form-group d-flex justify-content-between">
                <div class="form-check form-check-flat mt-0">
                    <label style="font-size: 12px" class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        Keep me signed in
                    </label>
                </div>

                @if (Route::has('password.request'))
                    <a style="font-size: 10px" class="text-primary text-small" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>

        </form>
    </div>

@endsection

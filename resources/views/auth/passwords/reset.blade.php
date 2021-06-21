@extends('layouts.app')

@section('content')
    <div class="auto-form-wrapper">
        <div class="btn-group" role="group" aria-label="Basic example">
            <a href="{{ route('welcome') }}" type="button" class="btn btn-outline-primary"><i class="fa fa-desktop"></i>Welcome</a>
            <a href="{{ route('login') }}" type="button" class="btn btn-outline-primary"><i class="fa fa-unlock"></i>Login</a>
        </div>
        <hr>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group text-left">
                <label class="label">Email</label>
                <div class="input-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
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
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                    </div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>@enderror
                </div>
            </div>


            <div class="form-group text-left">
                <label class="label">Confirm Password</label>
                <div class="input-group">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary submit-btn btn-block">Reset Password</button>
            </div>
        </form>
    </div>
@endsection

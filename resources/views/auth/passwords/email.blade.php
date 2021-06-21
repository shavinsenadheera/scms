@extends('layouts.app')

@section('content')
    <div class="auto-form-wrapper">
        <div class="btn-group" role="group" aria-label="Basic example">
            <a href="{{ route('welcome') }}" type="button" class="btn btn-outline-primary"><i class="fa fa-desktop"></i>Welcome</a>
            <a href="{{ route('login') }}" type="button" class="btn btn-outline-primary"><i class="fa fa-unlock"></i>Login</a>
        </div>
        <hr>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group text-left">
                <label class="label">Email</label>
                <div class="input-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
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

            <div class="form-group">
                <button type="submit" class="btn btn-primary submit-btn btn-block">Send password reset link</button>
            </div>
        </form>
    </div>


@endsection

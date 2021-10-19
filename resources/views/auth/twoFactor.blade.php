@extends('layouts.app')
@section('content')
    <div class="container">
        @if(session()->has('message'))
            <p class="alert alert-info">
                {{session()->get('message')}}
            </p>
        @endif
        <section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
            <div class="container">
                <p class="text-center">
                <form method="POST" action="{{route('logout')}}">
                    @csrf
                    <button type="submit" class="align-items-center justify-content-center btn btn-danger">
                        <i class="fa fa-sign-out"></i>Log Out
                    </button>
                </form>
                </p>
                <div class="row justify-content-center form-bg-image" data-background-lg="{{asset('images/illustrations/signin.svg')}}">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                            <div class="text-center text-md-center mb-4 mt-md-0">
                                <h1 class="mb-0 h3">{!! trans('auth.twoFactor.title') !!}</h1>
                            </div>
                            <div class="text-center text-md-center mb-4 mt-md-0">
                                <p class="text-muted"> {!! trans('auth.twoFactor.info') !!} <a href="{{route('verify.resend')}}">{!! trans('here') !!}</a>
                                </p>
                            </div>
                            <form method="POST" action="{{ route('verify.store') }}" class="mt-4">
                                @csrf
                                <div class="form-group mb-4">
                                    <label for="email">{{__('Two Factor Code')}}</label>
                                    <div class="input-group">
                                        <input id="two_factor_code" type="text" class="form-control @error('two_factor_code') is-invalid @enderror" name="two_factor_code" value="{{ old('two_factor_code') }}" required autofocus>
                                    </div>
                                    @error('two_factor_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-lg btn-primary">{!! trans('auth.twoFactor.btnVerify') !!}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="bg-dark shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
    <div>
        <img src="{{ asset('assets/logo/logo.png') }}" alt="">
    </div>
    <h4 class="text-white font-weight-bold">{!! trans('Supply Chain Management System') !!} {{ \Carbon\Carbon::now()->year }}</h4>
    @auth
        <div class="btn-group border-0 mb-3 mt-3">
            <a href="{{ route('dashboard.index') }}" class="btn btn-primary">
                <i class="fa fa-user-circle"></i>{!! trans('Go To Dashboard') !!}
            </a>
        </div>
    @else
        <div class="btn-group border-0 mb-3 mt-3">
            <a href="{{ route('login') }}" class="btn btn-primary">
                <i class="fa fa-user-circle"></i>{!! trans('Login Here') !!}
            </a>
        </div>
    @endif
    </div>
@endsection

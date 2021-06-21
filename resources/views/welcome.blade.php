@extends('layouts.app')

@section('content')
    <div>
        <img src="{{ asset('assets/logo/logo.png') }}" alt="">
    </div>
    <h4 class="text-white font-weight-bold">Supply Chain Management System {{ \Carbon\Carbon::now()->year }}</h4>
    <div class="btn-group border-0 mb-3 mt-3">
        <a href="{{ route('login') }}" class="btn btn-primary"><i class="fa fa-user-circle"></i>Login Here</a>
    </div>
@endsection

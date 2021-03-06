@extends('template.index')
@section('content')
    <div class="content-wrapper">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">{{ __('general.breadcrumb.dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.general_management')}}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('designation.index') }}">{{ __('general.breadcrumb.designation.designation_handling') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('general.breadcrumb.designation.designation_create') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ __('general.breadcrumb.designation.designation_create') }}</h4>
                        <form class="needs-validation" action="{{ route('designation.store') }}" method="POST" novalidate>
                            @csrf
                            <div class="form-group{{ $errors->has('code') ? 'has-error' : '' }}">
                                <label for="name">{{ __('designation.code') }} *</label>
                                <input type="text" class="form-control" id="code" name="code" placeholder="Designation code" value="@if(old('code')) {{ old('code') }} @endif" required>
                                @error('code')
                                <p class="text-small text-danger">{{ $errors->first() }}</p>
                                @enderror
                            </div>
                            <div class="form-group{{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="description">{{ __('designation.name') }} *</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Designation name" value="@if(old('name')) {{ old('name') }} @endif" required>
                                @error('name')
                                <p class="text-small text-danger">{{ $errors->first() }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-fw">
                                <i class="mdi mdi-file-document"></i>{{ __('general.form.add_details') }}
                            </button>
                            <a class="btn btn-light" href="{{ route('designation.index') }}">
                                {{ __('general.form.back') }}
                            </a>
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

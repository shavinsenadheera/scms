@extends('template.index')
@section('content')
    <div class="content-wrapper">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.supplier_management') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('supplier.index') }}">{{ __('general.breadcrumb.supplier.supplier_handling') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('general.breadcrumb.supplier.supplier_create') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 stretch-card">
                <div class="card">
                    <div class="card-header p-3">
                        <h4 class="card-title">{{ __('general.breadcrumb.supplier.supplier_create') }}</h4>
                    </div>
                    <div class="card-body">
                        <form class="needs-validation" action="{{ route('supplier.store') }}" method="POST" novalidate>
                            @csrf
                            <div class="form-row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group{{ $errors->has('name') ? 'has-error' : '' }}">
                                        <label for="name">{{ __('supplier.name') }} *</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Supplier name" value="@if(old('name')) {{ old('name') }} @endif" required>
                                        @error('name')
                                        <p class="text-small text-danger">{{ $errors->first() }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group{{ $errors->has('email') ? 'has-error' : '' }}">
                                        <label for="description">{{ __('supplier.email') }} *</label>
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Supplier email" value="@if(old('email')) {{ old('email') }} @endif" required>
                                        @error('email')
                                        <p class="text-small text-danger">{{ $errors->first() }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <button type="submit" class="btn btn-primary btn-fw">
                                    <i class="mdi mdi-file-document"></i>{{ __('general.form.add_details') }}
                                </button>
                                <a class="btn btn-light" href="{{ route('department.index') }}">
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
    @if (session()->has('errors'))
        <script>
            swal('Error Occurred!','{{ $errors->first() }}','error');
        </script>
    @endif
@endsection

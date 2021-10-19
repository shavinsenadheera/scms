@extends('template.index')
@section('content')
    <div class="content-wrapper">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.label_management') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('labelsize.index') }}">{{ __('general.breadcrumb.labelsize.labelsize_handling') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('general.breadcrumb.labelsize.labelsize_edit') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><i class="mdi mdi-pencil"></i> {{ __('general.breadcrumb.labelsize.labelsize_edit') }}</h4>
                        <form class="needs-validation" action="{{ route('labelsize.update',encrypt($labelsize->id)) }}" method="POST" novalidate>
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="form-group{{ $errors->has('code') ? 'has-error' : ''}}">
                                <label for="code">{{ __('labelsize.code') }} *</label>
                                <input type="text" class="form-control" name="code" id="code" placeholder="Enter size code" value="{{ $labelsize->code }}" required>
                                @error('code')
                                <p class="text-small text-danger">{{ $errors->first() }}</p>
                                @enderror
                            </div>
                            <div class="form-group{{ $errors->has('name') ? 'has-error' : ''}}">
                                <label for="name">{{ __('labelsize.name') }} *</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter size name" value="{{ $labelsize->name }}" required>
                                @error('name')
                                <p class="text-small text-danger">{{ $errors->first() }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-success mr-2">
                                <i class="mdi mdi-content-save"></i>{{ __('general.form.save_changes') }}
                            </button>
                            <a class="btn btn-light" href="{{ route('labelsize.index') }}">{{ __('general.form.back') }}</a>
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

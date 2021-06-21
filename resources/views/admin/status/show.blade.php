@extends('template.index')
@section('content')
    <div class="content-wrapper">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.general_management') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('status.index') }}">{{ __('general.breadcrumb.status.status_handling') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('general.breadcrumb.status.status_edit') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><i class="mdi mdi-pencil"></i> {{ __('general.breadcrumb.status.status_edit') }}</h4>
                        <form class="needs-validation" action="{{ route('status.update',$status->id) }}" method="POST" novalidate>
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="form-group{{ $errors->has('description') ? 'has-error' : '' }}">
                                <label for="description">@lang('status.description') *</label>
                                <input type="text" class="form-control" id="description" name="description" placeholder="Employee name" value="{{ $status->description }}" required>
                                @error('name')
                                <p class="text-small text-danger">{{ $errors->first() }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-success mr-2">
                                <i class="mdi mdi-content-save"></i>{{ __('general.form.save_changes') }}
                            </button>
                            <a class="btn btn-light" href="{{ route('status.index') }}">{{ __('general.form.back') }}</a>
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

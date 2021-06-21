@extends('template.index')
@section('content')
    <div class="content-wrapper">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('request.index') }}">{{ __('general.breadcrumb.production_management') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('general.breadcrumb.production.material_request') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ __('planning.planning_orderscan') }}</h4>
                        <form action="{{ route('request.store') }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div class="form-group{{ $errors->has('materials_id') ? 'has-error' : '' }}">
                                <label for="employee_id">{{ __('planning.material') }} *</label>
                                <select class="js-example-basic-single form-control" name="materials_id" id="materials_id" required>
                                    <option selected disabled>{{ __('general.form.selector.disabled_option') }}</option>
                                    @foreach($materials as $data)
                                        <option
                                            {{ old('materials_id')==$data->id ? 'selected' : '' }}
                                            value="{{ $data->id }}" {{ !$data->qty && 'disabled' }}
                                        >
                                            {{ $data->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('employee_id')
                                    <p class="text-small text-danger">{{ $errors->first() }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="request_count">{{ __('planning.request_count') }} *</label>
                                <input type="number" class="form-control" name="request_count" id="request_count" placeholder="Desired quantity" required/>
                                @error('request_count')
                                    <p class="text-small text-danger">{{ $errors->first() }}</p>
                                @enderror
                            </div>
                           <div class="form-group">
                               <button type="submit" class="btn btn-primary">
                                   Request
                               </button>
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
    @if (session()->has('error_msg'))
        <script>
            swal('Error Occurred!','{{ session('error_msg') }}','error');
        </script>
    @endif
    @if (session()->has('errors'))
        <script>
            swal('Error Occurred!','{{ $errors->first() }}','error');
        </script>
    @endif
@endsection

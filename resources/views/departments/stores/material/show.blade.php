@can('edit')
@extends('template.index')
@section('content')
    <div class="content-wrapper">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.material_management') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('material.index') }}">{{ __('general.breadcrumb.material.material_handling') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('general.breadcrumb.material.material_edit') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ __('general.breadcrumb.material.material_edit') }}</h4>
                            <form action="{{ route('material.update', encrypt($material->id)) }}" method="POST">
                                @csrf
                                {{ method_field('PUT') }}
                                <div class="form-group{{ $errors->has('name') ? 'has-error' : '' }}">
                                     <label for="name">{{ __('material.edit.name') }} *</label>
                                     <input
                                         type="text"
                                         class="form-control"
                                         id="name"
                                         name="name"
                                         placeholder="material name"
                                         value="{{ $material->name }}"
                                         required
                                     >
                                     @error('name')
                                        <p class="text-small text-danger">{{ $errors->first() }}</p>
                                     @enderror
                                 </div>

                                <div class="form-group{{ $errors->has('suppliers_id') ? 'has-error' : '' }}">
                                    <label for="suppliers_id">{{ __('material.edit.supplier') }} *</label>
                                    <select
                                        class="form-control js-example-basic-single"
                                        name="suppliers_id"
                                        id="suppliers_id"
                                        required
                                    >
                                        <option selected disabled value="">{{ __('general.form.selector.disabled_option') }}</option>
                                        @foreach($suppliers as $data)
                                            <option
                                                {{ $data->id==$material->suppliers_id ? 'selected' : '' }}
                                                value="{{ $data->id }}">{{ $data->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('phone_no')
                                        <p class="text-small text-danger">{{ $errors->first() }}</p>
                                    @enderror
                                </div>

                                <div class="form-group{{ $errors->has('metrics_id') ? 'has-error' : '' }}">
                                    <label for="metrics_id">{{ __('material.edit.metric') }} *</label>
                                    <select
                                        class="form-control js-example-basic-single"
                                        name="metrics_id"
                                        id="metrics_id"
                                        required
                                    >
                                        <option selected disabled value="">{{ __('general.form.selector.disabled_option') }}</option>
                                        @foreach($metrics as $data)
                                            <option
                                                {{ $data->id==$material->m_metrics_id ? 'selected' : '' }}
                                                value="{{ $data->id }}"
                                            >{{ $data->name }} ({{ $data->code }})</option>
                                        @endforeach
                                    </select>
                                    @error('phone_no')
                                    <p class="text-small text-danger">{{ $errors->first() }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-fw">
                                        <i class="mdi mdi-content-save"></i>{{ __('general.form.save_changes') }}
                                    </button>
                                    <a class="btn btn-light" href="{{ route('material.index') }}">
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
@endcan

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
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group{{ $errors->has('phone_no') ? 'has-error' : '' }}">
                                        <label for="phone_no">{{ __('supplier.phone_no') }} *</label>
                                        <input type="text" class="form-control" id="phone_no" name="phone_no" placeholder="Supplier phone number" value="@if(old('phone_no')) {{ old('phone_no') }} @endif" required>
                                        @error('phone_no')
                                        <p class="text-small text-danger">{{ $errors->first() }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group{{ $errors->has('telephone_no') ? 'has-error' : '' }}">
                                        <label for="telephone_no">{{ __('supplier.telephone_no') }} *</label>
                                        <input type="text" class="form-control" id="telephone_no" name="telephone_no" placeholder="Supplier telephone number" value="@if(old('telephone_no')) {{ old('telephone_no') }} @endif" required>
                                        @error('telephone_no')
                                        <p class="text-small text-danger">{{ $errors->first() }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group{{ $errors->has('fax_no') ? 'has-error' : '' }}">
                                        <label for="fax_no">{{ __('supplier.fax_no') }} *</label>
                                        <input type="text" class="form-control" id="fax_no" name="fax_no" placeholder="Supplier fax no" value="@if(old('fax_no')) {{ old('fax_no') }} @endif" required>
                                        @error('fax_no')
                                        <p class="text-small text-danger">{{ $errors->first() }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xl-12 col-lg-12 cl-md-12 col-sm-12">
                                    <div class="form-group{{ $errors->has('address_line_1') ? 'has-error' : '' }}">
                                        <label for="address_line_1">{{ __('supplier.address_line_1') }} *</label>
                                        <input type="text" class="form-control" id="address_line_1" name="address_line_1" placeholder="Supplier address line 1" value="@if(old('address_line_1')) {{ old('address_line_1') }} @endif" required>
                                        @error('address_line_1')
                                        <p class="text-small text-danger">{{ $errors->first() }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group{{ $errors->has('address_line_2') ? 'has-error' : '' }}">
                                        <label for="address_line_2">{{ __('supplier.address_line_2') }}</label>
                                        <input type="text" class="form-control" id="address_line_2" name="address_line_2" placeholder="Supplier address line 2" value="@if(old('address_line_2')) {{ old('address_line_2') }} @endif">
                                        @error('address_line_2')
                                        <p class="text-small text-danger">{{ $errors->first() }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group{{ $errors->has('city') ? 'has-error' : '' }}">
                                        <label for="cities_id">{{ __('supplier.city') }} *</label>
                                        <select class="form-control js-example-basic-single" name="cities_id" id="cities_id" data-live-search="true" value="{{ old('cities_id')}}">
                                            <option selected disabled>Choose city</option>
                                            @foreach($cities as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('city')
                                        <p class="text-small text-danger">{{ $errors->first() }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group{{ $errors->has('zipcode') ? 'has-error' : '' }}">
                                        <label for="zipcode">{{ __('supplier.zipcode') }} *</label>
                                        <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Supplier zip code" value="@if(old('zipcode')) {{ old('zipcode') }} @endif" required>
                                        @error('zipcode')
                                        <p class="text-small text-danger">{{ $errors->first() }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group{{ $errors->has('website') ? 'has-error' : '' }}">
                                        <label for="website">{{ __('supplier.website') }} *</label>
                                        <input type="text" class="form-control" id="website" name="website" placeholder="Supplier website" value="@if(old('website')) {{ old('website') }} @endif" required>
                                        @error('website')
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

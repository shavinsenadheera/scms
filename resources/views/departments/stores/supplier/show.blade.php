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
                        <li class="breadcrumb-item active" aria-current="page">{{ __('general.breadcrumb.supplier.supplier_edit') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 stretch-card">
                <form action="{{ route('supplier.update', encrypt($supplier->id)) }}" method="POST">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="card">
                        <div class="card-header p-3">
                            <h4 class="card-title">{{ __('general.breadcrumb.supplier.supplier_edit') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group{{ $errors->has('name') ? 'has-error' : '' }}">
                                        <label for="name">{{ __('supplier.name') }} *</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="supplier name" value="{{ $supplier->name }}" required>
                                        @error('name')
                                        <p class="text-small text-danger">{{ $errors->first() }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group{{ $errors->has('email') ? 'has-error' : '' }}">
                                        <label for="description">{{ __('supplier.email') }} *</label>
                                        <input type="text" class="form-control" id="email" name="email" placeholder="supplier email" value="{{ $supplier->email }}" required>
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
                                        <input type="text" class="form-control" id="phone_no" name="phone_no" placeholder="Supplier phone no" value="{{ $supplier->phone_no }}" required>
                                        @error('phone_no')
                                        <p class="text-small text-danger">{{ $errors->first() }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group{{ $errors->has('telephone_no') ? 'has-error' : '' }}">
                                        <label for="telephone_no">{{ __('supplier.telephone_no') }} *</label>
                                        <input type="text" class="form-control" id="telephone_no" name="telephone_no" placeholder="Supplier telephone number" value="{{ $supplier->telephone_no }}" required>
                                        @error('telephone_no')
                                        <p class="text-small text-danger">{{ $errors->first() }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group{{ $errors->has('fax_no') ? 'has-error' : '' }}">
                                        <label for="fax_no">{{ __('supplier.fax_no') }} *</label>
                                        <input type="text" class="form-control" id="fax_no" name="fax_no" placeholder="Supplier fax number" value="{{ $supplier->fax_no }}" required>
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
                                        <input type="text" class="form-control" id="address_line_1" name="address_line_1" placeholder="supplier address line 1" value="{{ $supplier->address_line_1 }}" required>
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
                                        <input type="text" class="form-control" id="address_line_2" name="address_line_2" placeholder="supplier address line 2" value="{{ $supplier->address_line_2 }}">
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
                                        <select class="form-control js-example-basic-single" name="cities_id" id="cities_id" data-live-search="true">
                                            @foreach($cities as $data)
                                                <option {{ $supplier->cities_id==$data->id ? 'selected' :'' }} value="{{ $data->id }}">{{ $data->name }}</option>
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
                                        <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Supplier zip code" value="{{ $supplier->zipcode }}" required>
                                        @error('zipcode')
                                        <p class="text-small text-danger">{{ $errors->first() }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group{{ $errors->has('website') ? 'has-error' : '' }}">
                                        <label for="website">{{ __('supplier.website') }} *</label>
                                        <input type="text" class="form-control" id="website" name="website" placeholder="Supplier website" value="{{ $supplier->website }}" required>
                                        @error('website')
                                        <p class="text-small text-danger">{{ $errors->first() }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <button type="submit" class="btn btn-success btn-fw">
                                    <i class="mdi mdi-content-save"></i>{{ __('general.form.save_changes') }}
                                </button>
                                <a class="btn btn-light" href="{{ route('supplier.index') }}">
                                    {{ __('general.form.back') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
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

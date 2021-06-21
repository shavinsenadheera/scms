@extends('template.index')
@section('content')
    <div class="content-wrapper">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.customer_management') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('customer.index') }}">{{ __('general.breadcrumb.customer.customer_handling') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('general.breadcrumb.customer.customer_edit') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 stretch-card">
                <form action="{{ route('customer.update', encrypt($customer->id)) }}" method="POST">
                @csrf
                {{ method_field('PUT') }}
                    <div class="card">
                        <div class="card-header p-3">
                            <div class="float-left">
                                <h4 class="card-title">{{ __('general.breadcrumb.customer.customer_edit') }}</h4>
                            </div>
                            <div class="float-right">
                                <select class="form-control" name="admin_status" id="admin_status">
                                    @foreach($admin_statuses as $data)
                                        <option {{ $customer->admin_status==$data['id'] ? 'selected' : '' }} value="{{ $data['id'] }}">{{ $data['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group{{ $errors->has('name') ? 'has-error' : '' }}">
                                        <label for="name">{{ __('customer.name') }} *</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Customer name" value="{{ $customer->name }}" required disabled>
                                        @error('name')
                                        <p class="text-small text-danger">{{ $errors->first() }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group{{ $errors->has('email') ? 'has-error' : '' }}">
                                        <label for="description">{{ __('customer.email') }} *</label>
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Customer email" value="{{ $customer->email }}" required disabled>
                                        @error('email')
                                        <p class="text-small text-danger">{{ $errors->first() }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group{{ $errors->has('telephone_no') ? 'has-error' : '' }}">
                                        <label for="telephone_no">{{ __('customer.telephone_no') }} *</label>
                                        <input type="text" class="form-control" id="telephone_no" name="telephone_no" placeholder="Customer telephone no" value="{{ $customer->telephone_no }}" required disabled>
                                        @error('telephone_no')
                                        <p class="text-small text-danger">{{ $errors->first() }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group{{ $errors->has('telephone_land') ? 'has-error' : '' }}">
                                        <label for="telephone_land">{{ __('customer.telephone_land') }} *</label>
                                        <input type="text" class="form-control" id="telephone_land" name="telephone_land" placeholder="Customer telephone land" value="{{ $customer->telephone_land }}" required disabled>
                                        @error('telephone_land')
                                        <p class="text-small text-danger">{{ $errors->first() }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group{{ $errors->has('telephone_fax') ? 'has-error' : '' }}">
                                        <label for="telephone_fax">{{ __('customer.telephone_fax') }} *</label>
                                        <input type="text" class="form-control" id="telephone_fax" name="telephone_fax" placeholder="Customer telephone fax" value="{{ $customer->telephone_fax }}" required disabled>
                                        @error('telephone_fax')
                                        <p class="text-small text-danger">{{ $errors->first() }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xl-12 col-lg-12 cl-md-12 col-sm-12">
                                    <div class="form-group{{ $errors->has('address_line_1') ? 'has-error' : '' }}">
                                        <label for="address_line_1">{{ __('customer.address_line_1') }} *</label>
                                        <input type="text" class="form-control" id="address_line_1" name="address_line_1" placeholder="Customer address line 1" value="{{ $customer->address_line_1 }}" required disabled>
                                        @error('address_line_1')
                                        <p class="text-small text-danger">{{ $errors->first() }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group{{ $errors->has('address_line_2') ? 'has-error' : '' }}">
                                        <label for="address_line_2">{{ __('customer.address_line_2') }}</label>
                                        <input type="text" class="form-control" id="address_line_2" name="address_line_2" placeholder="Customer address line 2" value="{{ $customer->address_line_2 }}" disabled>
                                        @error('address_line_2')
                                        <p class="text-small text-danger">{{ $errors->first() }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group{{ $errors->has('city') ? 'has-error' : '' }}">
                                        <label for="cities_id">{{ __('customer.city') }} *</label>
                                        <select class="form-control js-example-basic-single" name="cities_id" id="cities_id" data-live-search="true" disabled>
                                            <option value="1">Kandy</option>
                                            <option value="2">Colombo</option>
                                        </select>
                                        @error('city')
                                        <p class="text-small text-danger">{{ $errors->first() }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group{{ $errors->has('zipcode') ? 'has-error' : '' }}">
                                        <label for="zipcode">{{ __('customer.zipcode') }} *</label>
                                        <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Customer zip code" value="{{ $customer->zipcode }}" required disabled>
                                        @error('zipcode')
                                        <p class="text-small text-danger">{{ $errors->first() }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <button type="submit" class="btn btn-success btn-fw">
                                    <i class="mdi mdi-content-save"></i>{{ __('general.form.save_changes') }}
                                </button>
                                <a class="btn btn-light" href="{{ route('department.index') }}">
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

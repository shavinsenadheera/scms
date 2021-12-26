@extends('template.index')
@section('content')
    <div class="content-wrapper">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">{!! trans('general.breadcrumb.dashboard') !!}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('customer.index') }}">{!! trans('general.breadcrumb.customer.customer_handling') !!}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{!! trans('general.breadcrumb.customer.customer_create') !!}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 stretch-card">
                <div class="card">
                    <form class="needs-validation" action="{{ route('customer.store') }}" method="POST" novalidate>
                        <div class="card-header p-3">
                            <div class="float-left">
                                <h4 class="card-title">{!! trans('general.breadcrumb.customer.customer_create') !!}</h4>
                            </div>
                            <div class="float-right">
                                <select class="form-control" name="admin_status" id="admin_status">
                                    @foreach($admin_statuses as $data)
                                        <option value="{{$data['id']}}">{{ $data['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-body">
                            @csrf
                            <div class="form-row">
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group @error('name') 'has-error' @enderror">
                                        <label for="name">{!! trans('customer.name') !!} *</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               placeholder="Customer name" value="@if(old('name')){{old('name')}}@elseif($newCustomer){{$newCustomer->name}}@endif" required>
                                        @error('name')
                                        <p class="text-small text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group @error('email') 'has-error' @enderror">
                                        <label for="email">{!! trans('customer.email') !!} *</label>
                                        <input type="text" class="form-control" id="email" name="email"
                                               placeholder="Customer email" value="@if(old('email')){{ old('email') }}@elseif($newCustomer){{$newCustomer->email}}@endif" required>
                                        @error('email')
                                        <p class="text-small text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group @error('industry') 'has-error' @enderror">
                                        <label for="industry">{!! trans('customer.industry') !!} *</label>
                                        <select class="form-control js-example-basic-single" name="industry" id="industry" data-live-search="true">
                                            @foreach($industries as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('industry')
                                        <p class="text-small text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group @error('telephone_no') 'has-error' @enderror }}">
                                        <label for="telephone_no">{!! trans('customer.telephone_no') !!} *</label>
                                        <input type="text" class="form-control" id="telephone_no" name="telephone_no"
                                               placeholder="Customer telephone no" value="@if(old('telephone_no')){{ old('telephone_no')}}@elseif($newCustomer){{$newCustomer->contactNo}}@endif" required>
                                        @error('telephone_no')
                                        <p class="text-small text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group @error('telephone_land') 'has-error' @enderror">
                                        <label for="telephone_land">{!! trans('customer.telephone_land') !!}</label>
                                        <input type="text" class="form-control" id="telephone_land" name="telephone_land"
                                               placeholder="Customer telephone land" value="@if(old('telephone_land')) {{ old('telephone_land') }} @endif" required>
                                        @error('telephone_land')
                                        <p class="text-small text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group @error('telephone_fax') 'has-error' @enderror">
                                        <label for="telephone_fax">{!! trans('customer.telephone_fax') !!}</label>
                                        <input type="text" class="form-control" id="telephone_fax" name="telephone_fax"
                                               placeholder="Customer telephone fax" value="@if(old('telephone_fax')) {{ old('telephone_land') }} @endif" required>
                                        @error('telephone_fax')
                                        <p class="text-small text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xl-12 col-lg-12 cl-md-12 col-sm-12">
                                    <div class="form-group @error('address_line_1') 'has-error' @enderror">
                                        <label for="address_line_1">{!! trans('customer.address_line_1') !!} *</label>
                                        <input type="text" class="form-control" id="address_line_1" name="address_line_1"
                                               placeholder="Customer address line 1" value="@if(old('address_line_1')) {{ old('address_line_1') }} @endif" required>
                                        @error('address_line_1')
                                        <p class="text-small text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group @error('address_line_2') 'has-error' @enderror">
                                        <label for="address_line_2">{!! trans('customer.address_line_2')!!}</label>
                                        <input type="text" class="form-control" id="address_line_2" name="address_line_2"
                                               placeholder="Customer address line 2" value="@if(old('address_line_2')) {{ old('address_line_2') }} @endif">
                                        @error('address_line_2')
                                        <p class="text-small text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group @error('city') 'has-error' @enderror">
                                        <label for="cities_id">{!! trans('customer.city') !!} *</label>
                                        <select class="form-control js-example-basic-single" name="cities_id" id="cities_id" data-live-search="true">
                                            @foreach($cities as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('city')
                                        <p class="text-small text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group @error('zipcode') 'has-error' @enderror">
                                        <label for="zipcode">{!! trans('customer.zipcode') !!} *</label>
                                        <input type="text" class="form-control" id="zipcode" name="zipcode"
                                               placeholder="Customer zip code" value="@if(old('zipcode')) {{ old('zipcode') }} @endif" required>
                                        @error('zipcode')
                                        <p class="text-small text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group @error('password') 'has-error' @enderror">
                                        <label for="password">{!! trans('customer.password') !!} *</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                               placeholder="Customer password" value="@if(old('password')) {{ old('password') }} @endif" required>
                                        @error('password')
                                        <p class="text-small text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group @error('password_confirm') 'has-error' @enderror">
                                        <label for="password_confirm">{!! trans('customer.confirm_password') !!} *</label>
                                        <input type="password" class="form-control" id="password_confirm" name="password_confirm"
                                               placeholder="Customer password confirm" value="@if(old('password_confirm')) {{ old('password_confirm') }} @endif" required>
                                        @error('password_confirm')
                                        <p class="text-small text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <button type="submit" class="btn btn-primary btn-fw">
                                    <i class="mdi mdi-file-document"></i>{!! trans('general.form.add_details') !!}
                                </button>
                                <a class="btn btn-light" href="{{ route('department.index') }}">
                                    {!! trans('general.form.back') !!}
                                </a>
                            </div>
                        </div>
                    </form>
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

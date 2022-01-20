@extends('template.index')
@section('content')
    <div class="content-wrapper">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">{{ __('general.breadcrumb.dashboard') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('general.breadcrumb.production.order_concerns') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 stretch-card">
                <div class="card">
                    <div class="card-header py-2">
                        <h4 class="card-title">{{ __('general.breadcrumb.production.order_concerns') }}</h4>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('concerns.index') }}">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <select
                                            class="form-control js-example-basic-single {{ $errors->has('orderId') ? 'is-invalid' : ''}}"
                                            name="orderNo" id="orderNo" required>
                                            @foreach($orders as $data)
                                                @isset($searchVal)
                                                    <option
                                                        {{ $searchVal==$data->order_no ? 'selected' : '' }}
                                                        value="{{ $data->order_no }}">{{ $data->order_no }}
                                                    </option>
                                                @else
                                                    <option
                                                        {{ old('order_no')==$data->order_no ? 'selected' : '' }}
                                                        value="{{ $data->order_no }}">{{ $data->order_no }}
                                                    </option>
                                                @endisset
                                            @endforeach
                                        </select>
                                        @error('orderNo')
                                        <p class="text-small text-danger">{{ $errors->first('orderNo') }}</p>
                                        @enderror
                                    </div>
                                </div>
                                @isset($orderDetails)
                                    <div class="col-6">
                                        <div class="form-group">
                                            <input disabled value="Concerned to {{ $orderDetails->employee->name }}" type="text" class="form-control" name="concernedTo" id="concernedTo" />
                                        </div>
                                    </div>
                                @endisset
                                <div class="col-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-sm btn-primary">Search</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @isset($orderDetails)
                            <div class="table-responsive">
                                <table class="table table-secondary">
                                    <tr>
                                        <th>{{ __('Customer Name') }}</th>
                                        <th class="text-capitalize text-muted">{{ $orderDetails->customer->name }}</th>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Order No ') }}</th>
                                        <th class="text-capitalize text-muted">{{ $orderDetails->order_no }}</th>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Order Status ') }}</th>
                                        <th class="text-capitalize text-muted">{{ $orderDetails->status->description }}</th>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Order Date ') }}</th>
                                        <th class="text-capitalize text-muted">{{ $orderDetails->order_date }}</th>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Delivery Date') }}</th>
                                        <th class="text-capitalize text-muted">{{ $orderDetails->delivery_date }}</th>
                                    </tr>
                                    @isset($concern)
                                        @if($concern->status=='Pending')
                                            <tr>
                                                <th>{{ __('Status ') }}</th>
                                                <th class="text-capitalize text-success">{{ $concern->status }}</th>
                                            </tr>
                                            <tr>
                                                <th>{{ __('Concern') }}</th>
                                                <th class="text-capitalize">
                                                <textarea
                                                    class="form-control"
                                                    name=""
                                                >{{ $concern->concern }}</textarea>
                                                </th>
                                            </tr>
                                        @else
                                            <tr>
                                                <th>{{ __('Concern') }}</th>
                                                <th class="text-capitalize text-primary">{{ $concern->concern }}</th>
                                            </tr>
                                            <tr>
                                                <th>{{ __('Status ') }}</th>
                                                <th class="text-capitalize text-muted">{{ $concern->status }}</th>
                                            </tr>
                                        @endif
                                    @endisset
                                </table>
                            </div>
                            @if($concern=="")
                                <form method="POST" action="{{ route('concern.productioninsert') }}">
                                    @csrf
                                    <input name="orderId" value="{{ $orderDetails->id }}" hidden/>
                                    <input name="concernedTo" value="{{ $orderDetails->employee->id }}" hidden/>
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="concern">{{ __('Concern') }}</label>
                                                <textarea
                                                    type="text"
                                                    id="concern"
                                                    name="concern"
                                                    class="form-control"
                                                >{{ old('concern') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <button
                                                    class="btn btn-sm btn-primary">{{ __('Submit Concern')  }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @endif
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

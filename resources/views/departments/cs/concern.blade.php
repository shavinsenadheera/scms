@extends('template.index')
@section('content')
    <div class="content-wrapper">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">{{ __('general.breadcrumb.dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{route('order.index')}}">{{ __('general.breadcrumb.order_management') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('general.breadcrumb.production.order_concerns') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <form method="GET" action="{{route('order.concerns')}}" class="mt-3">
                    @csrf
                    <div role="group" aria-label="Basic radio toggle button group">
                        <input type="radio" class="btn-check" name="filter" id="all" autocomplete="off" value="all" @isset($_GET['filter']) {{ $_GET['filter']=='all' ? 'checked' : ''}} @endisset onclick="this.form.submit();">
                        <label class="btn btn-secondary" for="all">All</label>

                        <input type="radio" class="btn-check" name="filter" id="pending" autocomplete="off" value="pending" @isset($_GET['filter']) {{ $_GET['filter']=='pending' ? 'checked' : ''}} @endisset onclick="this.form.submit();">
                        <label class="btn btn-warning" for="pending">Pending</label>

                        <input type="radio" class="btn-check" name="filter" id="review" autocomplete="off" value="review" @isset($_GET['filter']) {{ $_GET['filter']=='reviewed' ? 'checked' : ''}} @endisset onclick="this.form.submit();">
                        <label class="btn btn-primary" for="review">Reviewed</label>
                    </div>
                </form>
                <div class="card">
                    <div class="card-header py-2">
                        <h4 class="card-title">{{ __('general.breadcrumb.production.order_concerns') }}</h4>
                    </div>
                    <div class="card-body">
                        @isset($concerns)
                            <div class="table-responsive">
                                <table class="table table-secondary">
                                    @foreach($concerns as $data)
                                        <form method="POST" action="{{route('concern.csinsert', encrypt($data->id))}}">
                                        @csrf
                                        @method('PUT')
                                        <tr>
                                            <th>{{ __('Customer Name') }}</th>
                                            <th class="text-capitalize text-muted">{{ $data->order->customer->name }}</th>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Order No ') }}</th>
                                            <th class="text-capitalize text-muted">
                                                {{ $data->order->order_no }}
                                                <a
                                                    class="btn btn-sm btn-secondary text-lowercase"
                                                    href="{{route('order.show', encrypt($data->order->id))}}"
                                                    target="_blank"
                                                >
                                                    {{__('view order')}}
                                                </a>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Delivery Date') }}</th>
                                            <th class="text-capitalize text-muted">{{ $data->order->delivery_date }}</th>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Concern To') }}</th>
                                            <th class="text-capitalize text-muted">{{ $data->concernedTo->name }}</th>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Concern By') }}</th>
                                            <th class="text-capitalize text-muted">{{ $data->concernedFrom->name }}</th>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Concern Status ') }}</th>
                                            <th class="text-capitalize text-{{$data->status ? 'success' : 'primary'}}">{{ $data->status }}</th>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Concern ') }}</th>
                                            <th class="text-capitalize text-muted">{{ $data->concern }}</th>
                                        </tr>
                                        <tr>
                                            <th>{{__('Comment')}}</th>
                                            <th>
                                                <textarea
                                                    {{$data->reason ? 'readonly' : ''}}
                                                    name="comment"
                                                    class="form-control @error('comment') is-invalid @enderror"
                                                >{{old('comment') ?? $data->reason}}</textarea>
                                                @error('comment')
                                                    {{$message}}
                                                @enderror
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>{{__('Action')}}</th>
                                            <th>
                                                <div class="btn-group">
                                                    <button type="submit" class="btn btn-primary" {{$data->reason ? 'disabled' : ''}}>
                                                        {{__('Add Comment')}}
                                                    </button>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#inform-customer-{{$data->id}}">
                                                        {{__('Inform to Customer')}}
                                                    </button>
                                                </div>
                                            </th>
                                        </tr>
                                        @if($loop->last)
                                            <tr class="bg-light">
                                                <th colspan="2"></th>
                                            </tr>
                                        @else
                                            <tr class="bg-white">
                                                <th colspan="2"></th>
                                            </tr>
                                        @endif
                                        </form>
                                        <x-common.email-send-modal
                                            :id="$data->id"
                                            :email="$data->order->customer->email"
                                            :orderNo="$data->order->order_no"
                                            :orderDate="$data->order->order_date"
                                            :deliveryDate="$data->order->delivery_date"
                                        ></x-common.email-send-modal>
                                    @endforeach
                                </table>
                            </div>
                            {{ $concerns->links() }}
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

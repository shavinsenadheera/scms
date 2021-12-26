@extends('template.index')
@section('head-css')
    <link rel="stylesheet" href="{{asset('assets/css/components/userProfileCard.css')}}" />
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a
                                href="{{route('dashboard.index')}}">{{ __('general.breadcrumb.dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a
                                href="{{route('order.index')}}">{{ __('general.breadcrumb.customer_management') }}</a></li>
                        <li class="breadcrumb-item active"
                            aria-current="page">{{ __('general.breadcrumb.customer.new_customer_requests') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="row mb-3">
                    <div class="col-12">
                        <x-common.search-bar
                            route="new_customer.index"
                            searchVal="{{$searchVal}}"></x-common.search-bar>
                    </div>
                    <div class="col-12 border-bottom border-primary">
                        <form method="GET" action="{{route('new_customer.index')}}" class="mt-3">
                            @csrf
                            <div role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" class="btn-check" name="filter" id="all" autocomplete="off" value="all" @isset($_GET['filter']) {{ $_GET['filter']=='all' ? 'checked' : ''}} @endisset onclick="this.form.submit();">
                                <label class="btn btn-secondary" for="all">All</label>

                                <input type="radio" class="btn-check" name="filter" id="pending" autocomplete="off" value="pending" @isset($_GET['filter']) {{ $_GET['filter']=='pending' ? 'checked' : ''}} @endisset onclick="this.form.submit();">
                                <label class="btn btn-warning" for="pending">Pending</label>

                                <input type="radio" class="btn-check" name="filter" id="review" autocomplete="off" value="review" @isset($_GET['filter']) {{ $_GET['filter']=='review' ? 'checked' : ''}} @endisset onclick="this.form.submit();">
                                <label class="btn btn-primary" for="review">Under Review</label>

                                <input type="radio" class="btn-check" name="filter" id="completed" autocomplete="off" value="completed" @isset($_GET['filter']) {{ $_GET['filter']=='completed' ? 'checked' : ''}} @endisset onclick="this.form.submit();">
                                <label class="btn btn-success" for="completed">Completed</label>

                                <input type="radio" class="btn-check" name="filter" id="declined" autocomplete="off" value="declined" @isset($_GET['filter']) {{ $_GET['filter']=='declined' ? 'checked' : ''}} @endisset onclick="this.form.submit();">
                                <label class="btn btn-danger" for="declined">Declined</label>
                            </div>
                        </form>
                    </div>
                </div>
                @if(count($newCustomers) > 0)
                    <div class="row">
                        @foreach($newCustomers as $data)
                            <div class="col-xl-4 col-lg-4 col-md-3 col-sm-12 mb-3">
                                <x-common.user-profile-card
                                    id="{{$data->id}}"
                                    title="{{$data->name}}"
                                    subTitle="{{$data->industrySelector->name}}"
                                    description="{{$data->message}}"
                                    email="{{$data->email}}"
                                    contactNo="{{$data->contactNo}}"
                                    status="{{$data->status}}"
                                ></x-common.user-profile-card>
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mt-5">
                                {{ $newCustomers->links('vendor.pagination.bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-12 bg-white text-center">
                        <img src="{{asset('assets/images/myImages/noDataFound.png')}}" />
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@extends('template.index')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{route('dashboard.index')}}">
                            {!! trans('general.breadcrumb.dashboard') !!}
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('customer-profile-request.index') }}">
                            {!! trans('general.breadcrumb.customer-request.customer_handling') !!}
                        </a>
                    </li>
                </ol>
            </nav>
            <div class="col-lg-12 col-md-12 col-sm-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ __('customer.customer_details') }}</h4>
                        <div class="card-description">
                            <form action="{{route('customer-profile-request.index')}}" method="GET">
                                @csrf
                                <label for="sort">Sort By Status</label>
                                <select id="sort" class="form-control" name="sort">
                                    @foreach(Lang::get('customer-requests.status') as $status)
                                    <option {{$searchVal==$status['value'] ? 'selected' : ''}} value="{{$status['value']}}">{{$status['name']}}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary">Sort</button>
                            </form>
                        </div>
                        <table class="table table-hover" id="datatable-1" style="width:100%">
                            <thead>
                            <tr>
                                <th> {!! trans('general.form.general.action') !!}</th>
                                <th> {!! trans('customer.name') !!}</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th> {!! trans('general.form.general.action') !!}</th>
                                <th> {!! trans('customer.name') !!}</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @isset($customerProfileRequests)
                                @foreach($customerProfileRequests as $data)
                                    <tr>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a class="btn btn-primary" href="{{ route('customer-profile-request.show',encrypt($data->id)) }}">
                                                    <i class="mdi mdi-eye-check"></i>
                                                </a>
                                            </div>
                                        </td>
                                        <td> {{ $data->name }} </td>
                                    </tr>
                                @endforeach
                            @endisset
                            </tbody>
                        </table>
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
@endsection

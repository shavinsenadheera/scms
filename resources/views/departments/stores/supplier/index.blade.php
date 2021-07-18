@extends('template.index')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.supplier_management') }}</a></li>
                    <li class="breadcrumb-item active"
                        aria-current="page">{{ __('general.breadcrumb.supplier.supplier_handling') }}</li>
                </ol>
            </nav>
            <div class="col-lg-12 col-md-12 col-sm-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ __('supplier.supplier_details') }}</h4>
                        <div class="card-description">
                            <a class="btn btn-icons btn-rounded btn-primary" href="{{ route('supplier.create') }}">
                                <i class="mdi mdi-plus"></i>
                            </a>
                        </div>
                        <table class="table table-hover" id="datatable-1" style="width:100%">
                            <thead>
                            <tr>
                                <th> {{ __('general.form.general.action') }}</th>
                                <th> {{ __('supplier.name') }}</th>
                                <th> {{ __('supplier.email') }}</th>
                                <th> {{ __('supplier.phone_no') }}</th>
                                <th> {{ __('supplier.telephone_no') }}</th>
                                <th> {{ __('supplier.fax_no') }}</th>
                                <th> {{ __('supplier.address') }}</th>
                                <th> {{ __('supplier.website') }}</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th> {{ __('general.form.general.action') }}</th>
                                <th> {{ __('supplier.name') }}</th>
                                <th> {{ __('supplier.email') }}</th>
                                <th> {{ __('supplier.phone_no') }}</th>
                                <th> {{ __('supplier.telephone_no') }}</th>
                                <th> {{ __('supplier.fax_no') }}</th>
                                <th> {{ __('supplier.address') }}</th>
                                <th> {{ __('supplier.website') }}</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @if($suppliers)
                                @foreach($suppliers as $data)
                                    <tr>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                @can('edit')
                                                    <a class="btn btn-primary"
                                                       href="{{ route('supplier.show',encrypt($data->id)) }}">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </a>
                                                @endcan
                                                @can('delete')
                                                    <a class="btn btn-danger"
                                                       href="{{ route('supplier.delete',encrypt($data->id)) }}">
                                                        <i class="mdi mdi-trash-can"></i>
                                                    </a>
                                                @endcan
                                            </div>
                                        </td>
                                        <td> {{ $data->name }} </td>
                                        <td> {{ $data->email }} </td>
                                        <td> {{ $data->phone_no }} </td>
                                        <td> {{ $data->telephone_no }} </td>
                                        <td> {{ $data->fax_no }} </td>
                                        <td> {{ $data->address_line_1 }} @isset($data->address_line_2)
                                                ,{{ $data->address_line_2 }}@endisset,{{ $data->cities->name }}
                                            , {{ $data->zipcode }} </td>
                                        <td> {{ $data->website }} </td>
                                    </tr>
                                @endforeach
                            @endif
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
            swal('Good job!', '{{ session('success_msg') }}', 'success');
        </script>
    @endif
@endsection

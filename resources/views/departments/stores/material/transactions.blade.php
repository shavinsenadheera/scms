@extends('template.index')
@section('content')
    <div>
        <div class="row">
            <div class="col-12">
                <div class="btn-group">
                    <a class="btn btn-danger" href="{{route('material-transactions.downloadPdf')}}">
                        <i class="fa fa-file-pdf-o"></i> {{__('material.index.generate_transaction_pdf')}}
                    </a>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <form class="form-inline" action="{{route('material-transactions.downloadDateFilterPdf')}}">
                            @csrf
                            <div class="form-group mr-3">
                                <label for="from" class="mr-3">From Date</label>
                                <input type="date" name="from" id="from" class="form-control"/>
                            </div>
                            <div class="form-group mr-3">
                                <label for="to" class="mr-3">To Date</label>
                                <input type="date" name="to" id="to" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-danger">Generate Report</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header p-3">
            Latest Order Transactions
        </div>
        <div class="card-body p-3">
            <table class="table table-striped" id="datatable-2">
                <thead>
                <tr>
                    <th>Mat. name</th>
                    <th>Sup. name</th>
                    <th>Tot. count</th>
                    <th>Price/Item</th>
                    <th>Total Price</th>
                    <th><i class="fa fa-clock-o"></i></th>
                </tr>
                </thead>
                <tbody>
                @foreach($mtransactions as $data)
                    <tr>
                        <td>{{ $data->materials->name  }}</td>
                        <td>{{ $data->materials->suppliers->name  }}</td>
                        <td>{{ $data->total_count  }} {{ $data->materials->metrics->code  }}</td>
                        <td>{{ $data->item_price  }}/{{ $data->materials->metrics->code  }}</td>
                        <td>{{ $data->total_price  }} {{ $data->materials->metrics->code  }}</td>
                        <td>{{ $data->created_at  }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
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

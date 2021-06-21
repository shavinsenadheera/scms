@extends('Template.index')
@section('content')
    <div class="content-wrapper">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.planning_management') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('order.index') }}">{{ __('general.breadcrumb.planning.planning_handling') }}</a></li>
                    </ol>
                </nav>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 my-3">
                    <div class="card">
                        <div class="card-header p-3 bg-success text-white">
                            <div class="float-left">
                                <i class="fa fa-hand-pointer-o"></i> {{ __('planning.normal')}}
                            </div>
                            <div class="float-right">
                                <input type="text" id="normalOrderInput" class="form-control" onkeyup="normalOrderFilter()" placeholder="Search for order no.." title="Type in a name">
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="normalOrderTable" class="table">
                                <thead>
                                    <tr>
                                        <th>{{ __('planning.order_no')}}</th>
                                        <th>{{ __('planning.priority')}}</th>
                                        <th>{{ __('planning.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($normal_orders as $data)
                                    <tr>
                                        <form action="{{ route('planning.scan',encrypt($data->id)) }}" method="POST">
                                        @csrf
                                        {{ method_field('PUT') }}
                                        <td>{{ $data->order_no }}</td>
                                        <td>
                                            <select class="form-control" name="priority_id" id="priority_id">
                                                @foreach($priorities as $priority)
                                                    <option {{ $data->priority_id==$priority->id ? 'selected' : '' }} value="{{ $priority->id }}">{{ $priority->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-sm btn-success"><i class="mdi mdi-content-save"></i></button>
                                        </td>
                                        </form>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 my-3">
                    <div class="card">
                        <div class="card-header p-3 bg-info text-white">
                            <div class="float-left">
                                <i class="mdi mdi-speedometer"></i> {{ __('planning.speed') }}
                            </div>
                            <div class="float-right">
                                <input type="text" id="speedOrderInput" class="form-control" onkeyup="speedOrderFilter()" placeholder="Search for order no.." title="Type in a name">
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="speedOrderTable" class="table">
                                <thead>
                                <tr>
                                    <th>{{ __('planning.order_no') }}</th>
                                    <th>{{ __('planning.priority') }}</th>
                                    <th>{{ __('planning.action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($speed_orders as $data)
                                    <tr>
                                        <form action="{{ route('planning.scan',encrypt($data->id)) }}" method="POST">
                                        @csrf
                                        {{ method_field('PUT') }}
                                        <td>{{ $data->order_no }}</td>
                                        <td>
                                            <select class="form-control" name="priority_id" id="priority_id">
                                                @foreach($priorities as $priority)
                                                    <option {{ $data->priority_id==$priority->id ? 'selected' : '' }} value="{{ $priority->id }}">{{ $priority->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-sm btn-info"><i class="mdi mdi-content-save"></i></button>
                                        </td>
                                        </form>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 my-3">
                    <div class="card">
                        <div class="card-header p-3 bg-primary text-white">
                            <div class="float-left">
                                <i class="mdi mdi-car-electric"></i> {{ __('planning.rapid') }}
                            </div>
                            <div class="float-right">
                                <input type="text" id="rapidOrderInput" class="form-control" onkeyup="rapidOrderFilter()" placeholder="Search for order no.." title="Type in a name">
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="rapidOrderTable" class="table">
                                <thead>
                                <tr>
                                    <th>{{ __('planning.order_no') }}</th>
                                    <th>{{ __('planning.priority') }}</th>
                                    <th>{{ __('planning.action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rapid_orders as $data)
                                    <tr>
                                        <form action="{{ route('planning.scan',encrypt($data->id)) }}" method="POST">
                                        @csrf
                                        {{ method_field('PUT') }}
                                        <td>{{ $data->order_no }}</td>
                                        <td>
                                            <select class="form-control" name="priority_id" id="priority_id">
                                                @foreach($priorities as $priority)
                                                    <option {{ $data->priority_id==$priority->id ? 'selected' : '' }} value="{{ $priority->id }}">{{ $priority->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-sm btn-primary"><i class="mdi mdi-content-save"></i></button>
                                        </td>
                                        </form>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
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
    <script>
        function normalOrderFilter() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("normalOrderInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("normalOrderTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>

    <script>
        function speedOrderFilter() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("speedOrderInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("speedOrderTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>

    <script>
        function rapidOrderFilter() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("rapidOrderInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("rapidOrderTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
@endsection

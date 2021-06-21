@extends('Template.index')
@section('head-js')
    <script type="text/javascript">

        var materialCount = 1;
        var count = 2;

        function add_row()
        {
            materialCount++;
            document.getElementById('materialCount').innerHTML = "<span>"+materialCount+"</span>";
            $(document).ready(function() {
                $('.js-example-basic-multiple').select2();
                $('.js-example-basic-single').select2();
            });
            var materials = $('#materials_id').html();
            $rowno=$("#orderProduct tr").length;
            $rowno=$rowno+1;
            $("#orderProduct tr:last").after("" +
                "<tr id='row"+$rowno+"'>" +
                "<td><select class='form-control js-example-basic-single materials_id' name='materials_id[]' required>"+materials+"</select></td>" +
                "<td><input class='form-control quantity' min='1' type='number' name='quantity[]' placeholder='Quantity' required></td>" +
                "<td><input class='form-control price' min='1' type='number' name='item_price[]' placeholder='Price' required></td>" +
                "<td><input class='form-control total-amount' min='1' type='number' name='total[]' placeholder='Total' onchange='calTotalAmount();' required></td>" +
                "<td>" +
                "<button class='btn btn-xs btn-icons btn-danger rounded-circle' type='button' onclick=delete_row('row"+$rowno+"')>" +
                "<i class='mdi mdi-minus'></i>" +
                "</button>" +
                "</td>" +
                "</tr>");
        }
        function delete_row(rowno)
        {
            materialCount--;
            document.getElementById('materialCount').innerHTML = "<span>"+materialCount+"</span>";
            $('#'+rowno).remove();
        }
    </script>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('material.index') }}">{{ __('general.breadcrumb.material_management') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('general.breadcrumb.order.order_handling') }}</li>
                    </ol>
                </nav>
            </div>
            <form action="{{ route('m_order.store')  }}" method="POST" class="needs-validation" novalidate>
                @csrf
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 stretch-card p-0">
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 bg-light p-3 rounded-left">
                    <div class="float-left">
                        <h4 class="font-weight-bold">Order Dashboard</h4>
                    </div>
                    <div class="bg-light mt-5">
                        <table class="table table-hover table-borderless w-100" id="orderProduct">
                            <thead class="border-bottom-2 border-dark text-center">
                            <tr>
                                <th>
                                    <button class="btn bg-danger text-white">Material Info</button>
                                </th>
                                <th>
                                    <button class="btn bg-danger text-white">Count (i.e kg,m,..)</button>
                                </th>
                                <th>
                                    <button class="btn bg-danger text-white">Price/Item</button>
                                </th>
                                <th>
                                    <button class="btn bg-danger text-white">Total</button>
                                </th>
                                <th>
                                    <button accesskey="a" type="button" onclick="add_row();" class="btn btn-sm btn-icons btn-dark rounded-circle">
                                        <i class="mdi mdi-plus"></i>
                                    </button>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <select
                                        class="form-control form-select js-example-basic-single materials_id"
                                        name="materials_id[]"
                                        id="materials_id"
                                        required
                                    >
                                        <option value="" selected disabled>Choose product</option>
                                        @foreach($materials as $data)
                                            <option data-price="{{ $data->id }}" value="{{ $data->id }}">{{ $data->name }} - {{ $data->metrics->code }} - {{$data->suppliers->name}}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input
                                        type="number"
                                        min="1"
                                        name="quantity[]"
                                        placeholder="Quantity"
                                        class="form-control quantity"
                                        required
                                    >
                                </td>
                                <td>
                                    <input
                                        type="number"
                                        min="1"
                                        name="item_price[]"
                                        placeholder="Price"
                                        class="form-control price"
                                        required
                                    >
                                </td>
                                <td>
                                    <input
                                        type="number"
                                        min="1" name="total[]"
                                        placeholder="Total"
                                        class="form-control total-amount"
                                        onchange="calTotalAmount();"
                                        required
                                    >
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-icons btn-danger rounded-circle"><i class="mdi mdi-minus"></i></button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 bg-white p-3 rounded-right">
                    <div class="my-mt-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="float-left">
                                    <h4>Material Count</h4>
                                </div>
                                <div class="float-right">
                                    <h4 id="materialCount">1</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="float-left">
                                    <h4>Item Count (i.e. kg, m,etc)</h4>
                                </div>
                                <div class="float-right">
                                    <h4 class="itemCount">0</h4>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <div class="float-left">
                                    <h4 class="font-weight-bold">Total Amount</h4>
                                </div>
                                <div class="float-right">
                                    <h4 class="font-weight-bold"><span class="total">0.00</span></h4>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-12">
                                <div class="float-left">
                                    <button type="submit" class="btn btn-fw btn-danger">
                                        Order confirm
                                    </button>
                                </div>
                                <div class="float-right">
                                    <a
                                        href="{{ route('material.index') }}"
                                        class="btn btn-fw btn-dark"
                                    >
                                        Cancel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection
@section('custom-js')
    <script type="text/javascript">
        function calTotalAmount()
        {
            var total = 0;
            $('.total-amount').each(function(i,e){
                var amount = $(this).val() - 0;
                total += amount;
            });
            $('.total').html(total.toFixed(2));
        }

        function calTotalItemCount()
        {
            var total = 0;
            $('.quantity').each(function(i,e){
                var amount = $(this).val() - 0;
                total += amount;
            });
            $('.itemCount').html(total);
        }

        $('#orderProduct').delegate('.materials_id','change', function(){
            var tr = $(this).parent().parent();
            var price = tr.find('.product_ids option:selected').attr('data-price');
            tr.find('.price').val(price);
            var qty = tr.find('.quantity').val() - 0;
            var price = tr.find('.price').val() - 0;
            var total_amount = (qty * price);
            tr.find('.total-amount').val(Math.round(total_amount).toFixed(2));
            calTotalAmount();
            calTotalItemCount();
        });
    </script>
    <script type="text/javascript">
        $('#orderProduct').delegate('.price,.quantity','keyup',function(){
            console.log("dsd");
            var tr = $(this).parent().parent();
            var qty = tr.find('.quantity').val() - 0;
            var price = tr.find('.price').val() - 0;
            var total_amount = qty * price;
            tr.find('.total-amount').val(Math.round(total_amount).toFixed(2));
            calTotalAmount();
            calTotalItemCount();
        });
    </script>
    @if (session()->has('success_msg'))
        <script>
            swal('Good job!','{{ session('success_msg') }}','success');
        </script>
    @endif
    @if (session()->has('error_msg'))
        <script>
            swal('Error Occurred!','{{ session('error_msg') }}','error');
        </script>
    @endif
    @if (session()->has('errors'))
        <script>
            swal('Error Occurred!','{{ $errors->first() }}','error');
        </script>
    @endif
@endsection

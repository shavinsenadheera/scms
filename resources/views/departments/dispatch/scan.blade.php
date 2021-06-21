@extends('template.index')
@section('content')
    <div class="content-wrapper">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.dispatch_management') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('general.breadcrumb.dispatch.dispatch_scan') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ __('general.breadcrumb.dispatch.dispatch_scan') }}</h4>
                        <form>
                            <div class="form-group{{ $errors->has('employee_id') ? 'has-error' : '' }}">
                                <label for="employee_id">{{ __('planning.employee') }} *</label>
                                <select class="form-control js-example-basic-single" name="employee_id" id="employee_id" required>
                                    <option selected disabled>{{ __('general.form.selector.disabled_option') }}</option>
                                    @foreach($qa_employees as $data)
                                        <option {{ old('employee_id')==$data->id ? 'selected' : '' }} value="{{ $data->id }}">{{ $data->epfno }}-{{ $data->name }}</option>
                                    @endforeach
                                </select>
                                <div class="alert alert-danger alert-dismissible fade show my-3" role="alert" id="employee_id_alert">
                                    <strong class="mdi mdi-alert-circle text-danger"></strong> <strong class="text-danger" id="employeeid_error"></strong>
                                </div>
                                @error('employee_id')
                                <p class="text-small text-danger">{{ $errors->first() }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="order_no">{{ __('planning.order_no') }} *</label>
                                <input type="text" class="form-control" name="order_no" id="order_no" placeholder="Order no" />
                                <div class="alert alert-danger alert-dismissible fade show my-3" role="alert" id="order_no_alert">
                                    <strong class="mdi mdi-alert-circle text-danger"></strong> <strong class="text-danger" id="orderno_error"></strong>
                                </div>
                                <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
                            </div>
                            <div class="alert alert-success alert-dismissible fade show my-3" role="alert" id="success_msg_alert">
                                <strong class="mdi mdi-alert-circle text-success"></strong> <strong class="text-success" id="success_alert"></strong>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-js')
    <script>
        $(document).ready(function(){
            document.getElementById('order_no_alert').style.display="none";
            document.getElementById('employee_id_alert').style.display="none";
            document.getElementById('success_msg_alert').style.display="none";
            $('#order_no').on('input', function () {
                var employee_id = $('#employee_id').val()
                var order_no = $('#order_no').val()
                $.ajax({
                    type: 'POST',
                    url:'{{ route('dispatch.scan') }}',
                    dataType: 'json',
                    delay: 250,
                    data: {
                        _token      : $('#csrf').val(),
                        employee_id : employee_id,
                        order_no    : order_no,
                    },
                    success: function(response) {
                        if(response.success){
                            document.getElementById('order_no_alert').style.display="none";
                            document.getElementById('employee_id_alert').style.display="none";
                            document.getElementById('success_msg_alert').style.display="block";
                            $('#success_alert').html("<span>"+response.success+"</span>");
                            $('#orderno_error').html("<span></span>");
                            $('#employeeid_error').html("<span></span>");
                        }
                        if(response.orderno_invalid) {
                            document.getElementById('order_no_alert').style.display="block";
                            document.getElementById('employee_id_alert').style.display="none";
                            document.getElementById('success_msg_alert').style.display="none";
                            $('#orderno_error').html("<span>"+response.orderno_invalid+"</span>")
                            $('#employeeid_error').html("<span></span>");
                        }
                    },
                })
                    .catch(function(error){
                        if(error.responseJSON.errors.order_no[0]) {
                            document.getElementById('order_no_alert').style.display="block";
                            document.getElementById('success_msg_alert').style.display="none";
                            $('#orderno_error').html("<span>" + error.responseJSON.errors.order_no[0] + "</span>");
                        }
                        if(error.responseJSON.errors.employee_id[0]) {
                            document.getElementById('employee_id_alert').style.display="block";
                            document.getElementById('success_msg_alert').style.display="none";
                            $('#employeeid_error').html("<span>" + error.responseJSON.errors.employee_id[0] + "</span>");
                        }
                    })
            })
        });
    </script>
@endsection

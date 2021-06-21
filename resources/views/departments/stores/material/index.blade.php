@extends('template.index')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.material_management') }}</a></li>
                    <li  class="breadcrumb-item active" aria-current="page">{{ __('general.breadcrumb.material.material_handling') }}</li>
                </ol>
            </nav>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 stretch-card">
                <div class="btn-group">
                    <a class="btn btn-dark" href="{{ route('m_order.index') }}">
                        <i class="fa fa-first-order"></i> {{__('material.index.make_order')}}
                    </a>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addMaterial">
                        <i class="fa fa-plus"></i> {{__('material.index.add_material')}}
                    </button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addMetric">
                        <i class="fa fa-plus"></i> {{__('material.index.add_metric')}}
                    </button>
                    <button class="btn btn-primary">
                        <i class="fa fa-eye"></i> {{__('log.index')}}
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Start Modals -->
    <div class="modal fade" id="addMaterial" tabindex="-1" role="dialog" aria-labelledby="addMaterialLabel" aria-hidden="true">
        <form class="needs-validation" action="{{ route('material.store')}}" method="POST" novalidate>
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{__('material.index.add_material')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">{{__('material.index.name')}}</label>
                            <input type="text" name="name" id="name" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label for="m_metrics_id">{{__('material.index.metric')}}</label>
                            <select name="m_metrics_id" id="m_metrics_id" class="form-control" required>
                                <option selected disabled value="">{{ __('general.form.selector.disabled_option') }}</option>
                                @foreach($metrics as $data)
                                    <option value="{{ $data->id}}">{{$data->name}} ({{$data->code}})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="suppliers_id">{{__('material.index.supplier')}}</label>
                            <select name="suppliers_id" id="suppliers_id" class="form-control" required>
                                <option selected disabled value="">{{ __('general.form.selector.disabled_option') }}</option>
                                @foreach($suppliers as $data)
                                    <option value="{{ $data->id}}">{{$data->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('general.form.close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('general.form.save_changes')}}</button>
                    </div>
                </div>
            </div>
        </form>
      </div>

      <div class="modal fade" id="addMetric" tabindex="-1" role="dialog" aria-labelledby="addMetricLabel" aria-hidden="true">
        <form class="needs-validation" action="{{ route('metric.store')}}" method="POST" novalidate>
            @csrf
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('material.index.add_metric')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="code">{{__('material.index.code')}}</label>
                        <input type="text" name="code" id="code" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label for="name">{{__('material.index.metric')}}</label>
                        <input type="text" name="name" id="name" class="form-control" required />
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('general.form.close')}}</button>
                <button type="submit" class="btn btn-primary">{{__('general.form.save_changes')}}</button>
                </div>
            </div>
            </div>
        </form>
      </div>
    <!--End  Modals -->

    <div class="card">
        <div class="card-header p-3">
            Materials
        </div>
        <div class="card-body p-3">
            <table class="table table-striped" id="datatable-1">
                <thead>
                <tr>
                    <th>Actions</th>
                    <th>Mat. name</th>
                    <th>Metric</th>
                    <th>Sup. name</th>
                    <th>Current count</th>
                </tr>
                </thead>
                <tbody>
                @foreach($materials as $data)
                    <tr>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a
                                    class="btn btn-primary"
                                    href="{{ route('material.show',encrypt($data->id)) }}"
                                >
                                    <i class="mdi mdi-pencil"></i>
                                </a>
                                <a
                                    class="btn btn-danger @can('material_delete') '' @else disabled @endcan "
                                    href="{{ route('material.delete',encrypt($data->id)) }}"
                                >
                                    <i class="mdi mdi-trash-can"></i>
                                </a>
                            </div>
                        </td>
                        <td>{{ $data->name  }}</td>
                        <td>{{ $data->metrics->name  }}</td>
                        <td>{{ $data->suppliers->name  }}</td>
                        <td class="{{ $data->current_count ? 'bg-primary' : 'bg-danger' }} text-white">
                            {{ $data->current_count ? $data->current_count : 0 }} {{ $data->metrics->code }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card mt-5">
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
            swal('Good job!','{{ session('success_msg') }}','success');
        </script>
    @endif
@endsection

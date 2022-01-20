@extends('template.index')
@section('content')
    <div class="content-wrapper">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">{{ __('general.breadcrumb.dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a href="#!">{{ __('general.breadcrumb.label_management') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('labeltype.index') }}">{{ __('general.breadcrumb.labeltype.labeltype_handling') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('general.breadcrumb.labeltype.labeltype_delete') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><i class="mdi mdi-trash-can"></i> Label type delete</h4>
                        <h4 class="card-description text-danger">Unrecoverable data. Confirm continue?</h4>
                        <form class="needs-validation" action="{{ route('labeltype.destroy', encrypt($id)) }}" method="POST">
                            @csrf
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-success mr-2">Delete</button>
                            <a class="btn btn-light" href="{{ route('labeltype.index') }}">Back</a>
                        </form>
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
@endsection

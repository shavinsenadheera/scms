<div class="card-container">
    <div class="upper-container">
        <div class="image-container">
            <img src="{{ Avatar::create($title)->toBase64() }}" />
        </div>
    </div>
    <div class="lower-container">
        <div>
            <h4>{{$title}}</h4>
            <h5>{{html_entity_decode($subTitle)}}</h5>
        </div>
        <div>
            <p>{{$description}}</p>
        </div>
        <div>
            <button type="button" class="btn_user_profile" data-toggle="modal" data-target="#modal-{{$id}}">View Request</button>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal-{{$id}}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{$title}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-container">
                    <div class="upper-container-large">
                        <div class="image-container-large">
                            <img src="{{ Avatar::create($title)->toBase64() }}" />
                        </div>
                    </div>
                    <div class="lower-container">
                        <div>
                            <h4>{{$title}}</h4>
                            <h5 class="badge badge-dark">{{html_entity_decode($subTitle)}}</h5>
                        </div>
                        <div>
                            <p>{{$description}}</p>
                        </div>
                        <div>
                            <p class="text-primary">
                                <i class="fa fa-envelope"></i> {{$email}} |
                                <i class="fa fa-phone"></i> {{$contactNo}}
                            </p>
                        </div>
                        <div>
                            <form method="POST" action="{{route('new_customer.update', $id)}}">
                                @method('PUT')
                                @csrf
                                <input type="submit" class="btn btn-{{  $status==2 ? 'danger' : 'primary' }}" value="{{ $status==2 ? 'Process to Register' : 'Mark as Completed' }}" name="{{$status==2 ? 'register' : 'complete'}}" />
                                @if($status!=2)
                                <button id="btnGroupDrop1" type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    More Actions
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    @if($status==0 || $status==3)
                                        <input type="submit" value="Mark as U.Review" name="review" class="dropdown-item" />
                                    @endif
                                    @if($status==0 || $status==1)
                                        <input type="submit" value="Mark as Declined" name="decline" class="dropdown-item" />
                                    @endif
                                </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('custom-js')
    @if (session()->has('success_msg'))
        <script>
            swal('Notification!','{{ session('success_msg') }}','success');
        </script>
    @endif
    @if (session()->has('errors'))
        <script>
            swal('Error Occurred!','{{ $errors->first() }}','error');
        </script>
    @endif
    @if (session()->has('error_msg'))
        <script>
            swal('Error Occurred!','{{ session('error_msg') }}','error');
        </script>
    @endif
@endsection

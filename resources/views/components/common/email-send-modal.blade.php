<div class="modal fade" id="inform-customer-{{$id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{('Message to Customer')}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('concerns.inform')}}" method="GET">
                @csrf
                <div class="modal-body">
                    <input hidden value="{{encrypt($orderNo)}}" name="orderNo" />
                    <input hidden value="{{encrypt($orderDate)}}" name="orderDate" />
                    <input hidden value="{{encrypt($id)}}" name="concernId" />
                    <input hidden value="{{encrypt($deliveryDate)}}" name="deliveryDate" />
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">{{__('Recipient')}}</label>
                        <input readonly value="{{$email}}" type="text" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">{{__('Message')}}</label>
                        <textarea class="form-control" id="message-text" name="message">{{old('message')}}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                 <button type="submit" class="btn btn-primary">{{__('Send message')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

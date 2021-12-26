<div class="modal fade" id="{{$modalName}}" tabindex="-1" role="dialog" aria-labelledby="{{$modalName}}Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{$modalName}}Label">Enter Quantity</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('material.smart.request')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <input hidden type="text" name="materialName" class="form-control" value="{{$materialName}}" />
                    <input type="text" name="requestCount" class="form-control" />
                    @error('requestCount')
                    <p class="text-small text-danger">{{ $errors->first() }}</p>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Request</button>
                </div>
            </form>
        </div>
    </div>
</div>

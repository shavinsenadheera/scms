@component('mail::message')
    New order alert<br>
    Customer name: {{ $details['customer_name'] }}<br>
    Order no     : {{ $details['order_no'] }}<br>
    Please click following button or check the system.
    @component('mail::button', ['url' => \Illuminate\Support\Facades\URL::route('order.show',encrypt($details['order_id']))])
        Check order
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent

@component('mail::message')
# Reminder

Please check this order {{$orderNo}}

@component('mail::table')
| Order No     | Delivery Date    |
| -----------  |:----------------:|
| {{$orderNo}} | {{$deliveryDate}}|
@endcomponent

@component('mail::button', ['url' => \Illuminate\Support\Facades\URL::route('order.show',encrypt($data['url'])), 'color' => 'success'])
    View Order
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

@component('mail::message')
# Message for order concern

Order No - {{$orderNo}}
<br>
Order Date - {{$orderDate}}
<br>
Delivery Date - {{$deliveryDate}}

# Concern
{{$message}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent

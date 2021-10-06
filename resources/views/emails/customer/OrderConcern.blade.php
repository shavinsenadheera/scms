@component('mail::message')
# Message for order concern

Order No - {{$orderNo}}

Order Date - {{$orderDate}}

Delivery Date - {{$deliveryDate}}

# Concern

# {{$message}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent

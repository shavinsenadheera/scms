@component('mail::message')
Hey valuable customer,

Your order (#{{ $details['order_no'] }}) is starting to process.
<br>
Please use following link to track your order,
@component('mail::button', ['url' => ''])
Track order
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

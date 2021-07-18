@component('mail::message')
Hey valuable customer,

Order - #{{ $details['order_no'] }} {{ $details['status'] }}.
<br>
Check on ABCTL customer side system.
<br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent

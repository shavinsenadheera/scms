@component('mail::message')
# Introduction
Hi {{$details['name']}},
@if($details['status']=="Register")
Congratulations from ABCTL (Pvt) Ltd!
Your registration is successfully done!
@else
Your registration request is in {{$details['status']}}!
@endif

Thanks for being with us,<br>
{{ config('app.name') }}
@endcomponent

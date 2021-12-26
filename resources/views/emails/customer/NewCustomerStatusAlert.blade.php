@component('mail::message')
# Introduction
Hi {{$details['name']}},

Your registration request is in {{$details['status']}}!

Thanks,<br>
{{ config('app.name') }}
@endcomponent

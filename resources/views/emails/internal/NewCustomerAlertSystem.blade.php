@component('mail::message')
    Hi,

    Received new customer request!.

    Name: {{$details['name']}}
    Industry: {{$details['industry']}}
    Email: {{$details['email']}}
    Contact No: {{$details['contactNo']}}
    Message: {{$details['message']}}

    Thanks,
    {{ config('app.name') }}
@endcomponent

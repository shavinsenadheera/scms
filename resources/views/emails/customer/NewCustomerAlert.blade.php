@component('mail::message')
    Hi {{$details['name']}},

    Your request successfully delivered to us!.

    Thank you for choosing us,
    {{ config('app.name') }}
@endcomponent

@component('mail::message')
New MRN Alert<br>
Employee name    : {{ $details['employee_name'] }}<br>
Request material : {{ $details['request_material'] }}<br>
Request count    : {{ $details['request_count'] }}<br>
Please click following button or check the system.
@component('mail::button', ['url' => \Illuminate\Support\Facades\URL::route('log.show',encrypt($details['request_id']))])
    Check MRN
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

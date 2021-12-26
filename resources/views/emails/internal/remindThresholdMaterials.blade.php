@component('mail::message')
Material Threshold Alert!!!<br>

Please click following button or check the system.
@component('mail::button', ['url' => \Illuminate\Support\Facades\URL::route('log.show',encrypt($details['id']))])
Check Material
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

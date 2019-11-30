@component('mail::message')
# {{ $data['apartmentName']  }}

<p><b>Od:</b> {{ $data['name']  }} {{ $data['surname']  }}</p>

<p>:<b>Email</b> {{ $data['email'] }}</p>

<p><b>Datum:</b>{{ Carbon\Carbon::parse($data['start'])->format('d.m.Y.')}} - {{ Carbon\Carbon::parse($data['end'])->format('d.m.Y.')}}</p>

<div><b>Poruka:</b>
{{ $data['message'] }}
</div>
Thanks,<br>
{{ config('app.name') }}
@endcomponent

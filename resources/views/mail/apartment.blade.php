@component('mail::message')
<p><b>Apartman:</b> {{ $data['apartmentName']  }}<p>

<p><b>Od:</b> {{ $data['name']  }} {{ $data['surname']  }}</p>

<p><b>Email:</b> {{ $data['email'] }}</p>

<p><b>Datum:</b>{{ $data['start']}} - {{ $data['end']}}</p>

<div><b>Poruka:</b>
{{ $data['message'] }}
</div>
Thanks,<br>
{{ config('app.name') }}
@endcomponent

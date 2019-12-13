@component('mail::message')
<p><b>Apartman:</b> {{ $data['apartmentName']  }}<p>

<p><b>Od:</b> {{ $data['name']  }} {{ $data['surname']  }}</p>

<p><b>Email:</b> {{ $data['email'] }}</p>

<p><b>Datum:</b>{{ $data['start']}} - {{ $data['end']}}</p>

<p><b>Poruka:</b> {{ $data['message']  }}<p>

Thanks,<br>
@endcomponent

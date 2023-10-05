@component('mail::message')
# Hai {{$body->nama_lengkap}}

Permintaan penggantian alamat email baru. silakan klik link aktivasi dibawah ini.

@component('mail::button', ['url' => $body->link_aktivasi])
AKTIVASI EMAIL
@endcomponent

Terimakasih,<br>
BPS Provinsi Nusa Tenggara Barat
@endcomponent

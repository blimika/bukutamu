@component('mail::message')
# Hai {{$body->nama_lengkap}}

Permintaan penggantian alamat email baru. silakan klik link aktivasi dibawah ini.

@component('mail::button', ['url' => $body->link_aktivasi])
AKTIVASI EMAIL
@endcomponent

@component('mail::panel')
Jika mengalami kendala dalam klik tombol aktivasi, silakan copy paste link dibawah ini <br>
<strong>{{$body->link_aktivasi}}</strong>
@endcomponent

Terimakasih,<br>
Aplikasi Bukutamu <br>
BPS Provinsi Nusa Tenggara Barat<br>
Jl. Dr. Soedjono No. 74 Mataram NTB 83116
@endcomponent

@component('mail::message')
<h2>Hai {{$body->nama_lengkap}}</h2>
<p>Ada permintaan reset password akun pada sistem Bukutamu BPS Provinsi Nusa Tenggara Barat</p>

<div>
<p>Detil user : </p>
<p>
    Nama : {{$body->nama_lengkap}} <br />
    Usename : {{$body->username}} <br />
    Password baru : {{$body->passwd_baru}}
    Tanggal permintaan : {{$body->tanggal_minta}}
</p>
</div>
@component('mail::button', ['url' => 'https://wa.me/6281999952002'])
WA BPSNTB
@endcomponent

Terimakasih,<br />
Aplikasi Bukutamu <br />
BPS Provinsi Nusa Tenggara Barat<br />
Jl. Dr. Soedjono No. 74 Mataram NTB 83116
@endcomponent

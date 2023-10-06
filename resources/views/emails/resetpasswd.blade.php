@component('mail::message')
# Hai {{$body->nama_lengkap}}
<p>Ada permintaan reset password akun pada sistem Bukutamu BPS Provinsi Nusa Tenggara Barat</p>

<p>Detil Member </p>
<p>
    Nama : {{$body->nama_lengkap}} <br>
    Username : {{$body->username}} <br>
    <strong>Password baru : {{$body->passwd_baru}} <br></strong>
    Tanggal permintaan : {{$body->tanggal_minta}}
</p>

Informasi lebih lanjut hubungi : <br>
@component('mail::button', ['url' => 'https://wa.me/6281999952002','color'=>'success'])
WA BPSNTB
@endcomponent

Terimakasih,<br />
Aplikasi Bukutamu <br />
BPS Provinsi Nusa Tenggara Barat<br />
Jl. Dr. Soedjono No. 74 Mataram NTB 83116
@endcomponent

@component('mail::message')
<h2>Hai {{$body->nama_lengkap}}</h2>
<p>Anda sudah terdaftar pada sistem Bukutamu BPS Provinsi Nusa Tenggara Barat</p>
<p>Untuk aktivasi akun silakan klik @component('mail::button', ["url" => "{{route('member.aktivasi',$body->email_kodever)}}"])
    Aktivasi
    @endcomponent
</p>
<div>
<p>Detil pendaftaran : </p>
<p>
    Nama : {{$body->nama_lengkap}} <br />
    Usename : {{$body->username}} <br />
    Email : {{$body->email}} <br />
    Telepon : {{$body->telepon}} <br />
    Tanggal daftar : {{$body->tanggal_buat}}
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

@component('mail::message')
    # Hai {{$body->nama_lengkap}}

    Anda sudah terdaftar pada sistem Bukutamu BPS Provinsi Nusa Tenggara Barat.
    Untuk aktivasi akun silakan klik tombol dibawah ini

    @component('mail::button', ['url' => $body->link_aktivasi])
    AKTIVASI AKUN
    @endcomponent

    @component('mail::panel')
    Jika mengalami kendala dalam klik tombol aktivasi, silakan copy paste link dibawah ini <br>
    {{$body->link_aktivasi}}
    @endcomponent

    # Detil pendaftaran # <br>
    Nama : {{$body->nama_lengkap}} <br>
    Username : {{$body->username}} <br>
    Email : {{$body->email}} <br>
    Telepon : {{$body->telepon}} <br>
    Tanggal daftar : {{$body->tanggal_buat}} <br>

    Informasi lebih lanjut hubungi : <br>

    @component('mail::button', ['url' => 'https://wa.me/6281999952002'])
    WA BPSNTB
    @endcomponent

    Terimakasih,<br>
    Aplikasi Bukutamu <br>
    BPS Provinsi Nusa Tenggara Barat<br>
    Jl. Dr. Soedjono No. 74 Mataram NTB 83116
@endcomponent





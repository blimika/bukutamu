@component('mail::message')
    <h2>Hai {{$body->nama_lengkap}}</h2>
    <p>Anda sudah terdaftar pada sistem Bukutamu BPS Provinsi Nusa Tenggara Barat</p>
    <p>Untuk aktivasi akun silakan klik tombol dibawah ini</p>
    @component('mail::button', ['url' => $body->link_aktivasi])
    AKTIVASI
    @endcomponent
    @component('mail::panel')
    Jika mengalami kendala dalam klik tombol aktivasi, silakan copy paste link dibawah ini <br />
    {{$body->link_aktivasi}}
    @endcomponent
    
    <p>Detil pendaftaran : </p>
    <hr>
    <p>
        Nama : {{$body->nama_lengkap}} <br />
        Username : {{$body->username}} <br />
        Email : {{$body->email}} <br />
        Telepon : {{$body->telepon}} <br />
        Tanggal daftar : {{$body->tanggal_buat}}
    </p>
    
    Informasi lebih lanjut hubungi : @component('mail::button', ['url' => 'https://wa.me/6281999952002']) WA BPSNTB
    @endcomponent
    @component('mail::panel')
        Terimakasih,<br />
        Aplikasi Bukutamu <br />
        BPS Provinsi Nusa Tenggara Barat<br />
        Jl. Dr. Soedjono No. 74 Mataram NTB 83116
    @endcomponent
@endcomponent





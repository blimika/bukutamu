<!DOCTYPE html>
<html>
<head>
    <title>BUKUTAMU</title>
</head>

<body>

    <h2>Hai {{$body->nama_lengkap}}</h2>
    <p>Anda sudah terdaftar pada sistem Bukutamu BPS Provinsi Nusa Tenggara Barat</p>
    <p>Untuk aktivasi akun silakan klik <a href="{{route('member.aktivasi',$body->email_kodever)}}" target="_blank">AKTIVASI INI</a>
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

    <p><a href="https://wa.me/6281999952002">WA BPSNTB</a></p>
    <div>
    Terimakasih,<br />
    Aplikasi Bukutamu <br />
    BPS Provinsi Nusa Tenggara Barat<br />
    Jl. Dr. Soedjono No. 74 Mataram NTB 83116
    </div>

</body>
</html>





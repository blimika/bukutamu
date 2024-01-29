@component('mail::message')

# Hai {{ $body->nama_lengkap }}
Terimakasih, telah berkunjung BPS Provinsi Nusa Tenggara Barat.
Berikut nomor antrian Anda!


# Detil Kunjungan <br>
Nama : {{ $body->nama_lengkap }} <br>
Email : {{ $body->email }} <br>
Telepon : {{ $body->telepon }} <br>
Tanggal Kunjungan : {{ $body->tanggal }} <br>


@component('mail::panel')
Layanan : {{ $body->layanan_utama }} <br>
# Nomor Antrian : {{ $body->nomor_antrian }} <br />
@endcomponent


Terimakasih,<br>
Aplikasi Bukutamu <br>
BPS Provinsi Nusa Tenggara Barat<br>
Jl. Dr. Soedjono No. 74 Mataram NTB 83116

@endcomponent

@component('mail::message')

# Hai {{ $body->pengunjung_nama }}
Terimakasih, telah berkunjung BPS Provinsi Nusa Tenggara Barat.
Berikut nomor antrian Anda!


# Detil Kunjungan <br>
UID : {{ $body->kunjungan_uid }} <br>
Nama : {{ $body->pengunjung_nama }} <br>
Email : {{ $body->pengunjung_email }} <br>
Nomor HP : {{ $body->pengunjung_nomor_hp }} <br>
Tanggal Kunjungan : {{ $body->kunjungan_tanggal }} <br>


@component('mail::panel')
Layanan : {{ $body->layanan }} <br>
# Nomor Antrian : {{ $body->nomor_antrian }} <br />
@endcomponent


Terimakasih,<br>
Aplikasi Bukutamu <br>
BPS Provinsi Nusa Tenggara Barat<br>
Jl. Dr. Soedjono No. 74 Mataram NTB 83116

@endcomponent

@component('mail::message')

# Hai {{ $body->pengunjung_nama }}
Kami ingin mengucapkan terima kasih atas kunjungan Anda ke BPS Provinsi Nusa Tenggara Barat
pada {{ $body->kunjungan_tanggal }}. Kami berharap Anda memiliki pengalaman yang menyenangkan bersama kami.

# Detil Kunjungan <br>
UID : {{ $body->kunjungan_uid }} <br>
Nama : {{ $body->pengunjung_nama }} <br>
Email : {{ $body->pengunjung_email }} <br>
Nomor HP : {{ $body->pengunjung_nomor_hp }} <br>
Tanggal Kunjungan : {{ $body->kunjungan_tanggal }} <br>
Petugas yang melayani : {{ $body->petugas }} <br>

Untuk meningkatkan layanan kami, kami sangat menghargai jika Anda dapat meluangkan beberapa menit untuk mengisi feedback singkat berikut ini. Tanggapan Anda sangat berharga bagi kami untuk terus memberikan pelayanan terbaik.

@component('mail::button', ['url' => $body->link_feedback])
Link Feedback
@endcomponent

@component('mail::panel')
Jika mengalami kendala dalam klik tombol feedback, silakan copy paste link dibawah ini <br>
<strong>{{$body->link_feedback}}</strong>
@endcomponent

Sekali lagi, terima kasih atas kunjungan Anda dan kami berharap dapat menyambut Anda kembali di masa depan.
<br />
Salam hangat,<br>
Aplikasi Bukutamu <br>
BPS Provinsi Nusa Tenggara Barat<br>
Jl. Dr. Soedjono No. 74 Mataram NTB 83116
@endcomponent

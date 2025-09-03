@component('mail::message')
# Hai {{ $body->pengunjung_nama }}
Kami mengucapkan terima kasih atas kunjungan Anda ke BPS Provinsi Nusa Tenggara Barat.
<br />
Dalam rangka meningkatkan kualitas data dan pelayanan, <br />
BPS Provinsi NTB menyelenggarakan Survei Kebutuhan Data (SKD). <br />
Bapak/Ibu terpilih menjadi responden kami.<br />
Mohon kesediaannya untuk mengisi dengan lengkap pertanyaan-pertanyaan
pada link dibawah ini. Survei ini hanya membutuhkan waktu beberapa menit untuk diisi.

@component('mail::button', ['url' => $body->link_skd])
Link SKD
@endcomponent

@component('mail::panel')
Jika mengalami kendala dalam klik tombol, silakan copy paste link dibawah ini <br>
<strong>{{$body->link_skd}}</strong>
@endcomponent

Kerahasiaan jawaban Anda dilindungi Undang-undang No.16 Tahun 1997 tentang Statistik. <br />
<strong>Terima kasih atas partisipasi Anda!</strong><br /> <br />
Sekali lagi, terima kasih atas kunjungan Anda dan kami berharap dapat menyambut Anda kembali di masa depan.
<br />
Hubungi kami di: <br />
▶ Email : pst5200@bps.go.id <br />
🗣 Chat dgn Customer Service: https://wa.me/6281999952002 <br />
<br />
Salam hangat,<br>
BPS Provinsi Nusa Tenggara Barat<br>
Jl. Dr. Soedjono No. 74 Mataram NTB 83116
@endcomponent

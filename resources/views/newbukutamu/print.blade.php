<!DOCTYPE html>
<html lang="en">

<head>
    <title>Nomor Antrian</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style type="text/css">
        @media print {
            @page {
                size: 52mm 74mm;
                margin: 0;
            }
        }

        body {
            font-size: 10px;
            font-family: Calibri;
        }

        table {
            font-size: 10px;
            font-family: Calibri;
        }
    </style>

</head>

<body>
    <strong>BADAN PUSAT STATISTIK <br />PROVINSI NUSA TENGGARA BARAT</strong>
    <hr>
    UID : <b>{{ $data->kunjungan_uid}}</b> <br />
    Nama : <b>{{ $data->Pengunjung->pengunjung_nama }}</b> <br />
    Nomor Telepon : <b>{{ $data->Pengunjung->pengunjung_nomor_hp }}</b> <br />
    E-mail : <b>{{ $data->Pengunjung->pengunjung_email }}</b> <br />
    Tanggal kunjungan : <b>{{ $data->kunjungan_tanggal }} </b> <br />
    Nomor Antrian :
    <center>
        <h1>{{ $data->kunjungan_teks_antrian }} </h1>
    </center>
    <hr>

</body>

</html>

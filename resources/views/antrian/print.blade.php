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
    Nama : <b>{{ $data->tamu->nama_lengkap }}</b> <br />
    Nomor Telepon : <b>{{ $data->tamu->telepon }}</b> <br />
    E-mail : <b>{{ $data->tamu->email }}</b> <br />
    Tanggal kunjungan : <b>{{ $data->tanggal }} </b> <br />
    Nomor Antrian :
    <center>
        <h1>{{ $data->NomorAntrian->teks_antrian }} </h1>
    </center>
    <hr>

</body>

</html>

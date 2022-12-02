<script type="text/javascript">
    Highcharts.chart('chart-kunjungan-hc', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafik Jumlah Kunjungan dan Tamu Menurut Jenis Kelamin Bulan {{$dataBulan[$bulan]}} {{$tahun}}'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: {!! Generate::GrafikBulananHc($bulan,$tahun)['cat_final']!!},
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Kunjungan'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.0f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: {!! Generate::GrafikBulananHc($bulan,$tahun)['data_final']!!}
    });

    Highcharts.chart('chart-tahunan-hc', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafik Jumlah Kunjungan dan Tamu Menurut Jenis Kelamin Tahun {{$tahun}}'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: {!! Generate::GrafikTahunanHc($tahun)['cat_final']!!},
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Kunjungan'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.0f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: {!! Generate::GrafikTahunanHc($tahun)['data_final']!!}
    });
    </script>

<script>
    /*
    Morris.Bar({
        element: 'chart-kunjungan-depan',
        data: {!! Generate::GrafikBulanan($bulan,$tahun)!!},
        xkey: 'tanggal',
        ykeys: ['k_total','k_kantor', 'k_pst'],
        labels: ['Jumlah Kunjungan', 'Kunjungan Kantor','Kunjungan PST'],
        barColors:['#00bfc7', '#fb9678', '#9675ce'],
        hideHover: 'auto',
        gridLineColor: '#eef0f2',
        resize: true
    });

    Morris.Bar({
        element: 'chart-kunjungan-tahunan',
        data: {!! Generate::GrafikTahunan($tahun) !!},
        xkey: 'bulan_tahun',
        ykeys: ['k_total','k_kantor', 'k_pst'],
        labels: ['Total Kunjungan','Kunjungan Kantor', 'Kunjungan PST'],
        barColors:['#55ce63', '#2f3d4a', '#009efb'],
        gridLineColor: '#e0e0e0',
        hideHover: 'auto',
        resize: true

    });
    */
   // Dashboard 1 Morris-chart
$(function () {
    "use strict";
 // Morris donut chart
        
    Morris.Donut({
        element: 'donat-pekerjaan',
        data: {!! Generate::DonatPekerjaan($tahun)!!},
        resize: true,
        colors:['#3980DB','#9C814F','#DBA339','#506886','#5C5446','#009efb', '#55ce63', '#2f3d4a']
    });

    Morris.Donut({
        element: 'donat-pendidikan',
        data: {!! Generate::DonatPendidikan($tahun)!!},
        resize: true,
        colors:['#55ce63','#fccf03','#009efb', '#2f3d4a']
    });
 });    
</script>

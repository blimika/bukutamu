<!---widget bar--->
<div class="row">
    <div class="col-md-4 col-lg-2">
        <div class="card">
            <div class="box bg-info text-center">
                <h1 class="font-light text-white">{{Generate::JumlahKunjunganHari(\Carbon\Carbon::now())}}</h1>
                <h6 class="text-white">Kunjungan Hari Ini</h6>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg-2">
        <div class="card">
            <div class="box bg-primary text-center">
                <h1 class="font-light text-white">{{Generate::JumlahTamuHari(\Carbon\Carbon::now())}}</h1>
                <h6 class="text-white">Tamu Hari Ini</h6>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg-2">
        <div class="card">
            <div class="box bg-success text-center">
                <h1 class="font-light text-white">{{Generate::JumlahKunjunganBulan($bulan,$tahun)}}</h1>
                <h6 class="text-white">Kunjungan Bulan {{$dataBulanPendek[$bulan]}} {{$tahun}}</h6>
            </div>
        </div>
    </div>
    <!-- Column -->
    <div class="col-md-4 col-lg-2">
        <div class="card">
            <div class="box bg-megna text-center">
                <h1 class="font-light text-white">{{Generate::JumlahTamuBulan($bulan,$tahun)}}</h1>
                <h6 class="text-white">Tamu Bulan {{$dataBulanPendek[$bulan]}} {{$tahun}}</h6>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg-2">
        <div class="card">
            <div class="box bg-dark text-center">
                <h1 class="font-light text-white">{{Generate::JumlahKunjunganTahun($tahun)}}</h1>
                <h6 class="text-white">Kunjungan Tahun {{$tahun}}</h6>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-lg-2">
        <div class="card">
            <div class="box bg-warning text-center">
                <h1 class="font-light text-white">{{Generate::JumlahTamuTahun($tahun)}}</h1>
                <h6 class="text-white">Tamu Tahun {{$tahun}}</h6>
            </div>
        </div>
    </div>

</div>
<!---grafik depan--->
<div class="row">
    <!-- column -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div id="chart-kunjungan-hc" style="height: 340px;"></div>
            </div>
        </div>
    </div>
</div>
<!---batas grafik kunjungan--->
<div class="row">
    <!-- column 1-->
    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">Jumlah Kunjungan Menurut Pekerjaan Tahun {{$tahun}}</h4>
                <div id="donat-pekerjaan" style="height: 340px;"></div>
            </div>
        </div>
    </div>
    <!--batac column 1--->
    <div class="col-lg-6 col-md-6 col-xs-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">Jumlah Kunjungan Menurut Pendidikan Tahun {{$tahun}}</h4>
                <div id="donat-pendidikan" style="height: 340px;"></div>
            </div>
        </div>
    </div>
</div>
<!---batas grafik--->
<div class="row">
    <!-- column -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <!--<h4 class="card-title">Grafik Kunjungan Tahun {{$tahun}}</h4>-->
                <div id="chart-tahunan-hc" style="height: 340px;"></div>
            </div>
        </div>
    </div>
</div>

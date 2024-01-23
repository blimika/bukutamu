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

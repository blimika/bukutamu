<!---widget bar--->
<div class="row">
    <div class="col-md-4 col-lg-2">
        <div class="card">
            <div class="box bg-info text-center">
                <h1 class="font-light text-white">{{$kunjungan_hari_ini}}</h1>
                <h6 class="text-white">Kunjungan Hari Ini</h6>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg-2">
        <div class="card">
            <div class="box bg-primary text-center">
                <h1 class="font-light text-white">{{$pengunjung_hari_ini}}</h1>
                <h6 class="text-white">Pengunjung Hari Ini</h6>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg-2">
        <div class="card">
            <div class="box bg-success text-center">
                <h1 class="font-light text-white">{{$kunjungan_bulan_ini}}</h1>
                <h6 class="text-white">Kunjungan Bulan {{$nama_bulan_pendek}} {{$tahun}}</h6>
            </div>
        </div>
    </div>
    <!-- Column -->
    <div class="col-md-4 col-lg-2">
        <div class="card">
            <div class="box bg-megna text-center">
                <h1 class="font-light text-white">{{$pengunjung_bulan_ini}}</h1>
                <h6 class="text-white">Pengunjung Bulan {{$nama_bulan_pendek}} {{$tahun}}</h6>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg-2">
        <div class="card">
            <div class="box bg-dark text-center">
                <h1 class="font-light text-white">{{$kunjungan_tahun_ini}}</h1>
                <h6 class="text-white">Kunjungan Tahun {{$tahun}}</h6>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg-2">
        <div class="card">
            <div class="box bg-warning text-center">
                <h1 class="font-light text-white">{{$pengunjung_tahun_ini}}</h1>
                <h6 class="text-white">Pengunjung Tahun {{$tahun}}</h6>
            </div>
        </div>
    </div>
</div>

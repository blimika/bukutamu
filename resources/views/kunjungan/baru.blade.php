@extends('layouts.utama')
@section('konten')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Bukutamu BPS Provinsi Nusa Tenggara Barat</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Depan</a></li>
                <li class="breadcrumb-item active">Tambah Kunjungan Baru</li>
            </ol>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-lg-12 col-sm-12">
        @if (Session::has('message'))
        <div class="alert alert-{{ Session::get('message_type') }}" id="waktu2" style="margin-top:10px;">
            @if (Session::has('message_header'))
            <h4 class="alert-heading">{!! Session::get('message_header') !!}</h4>
            @endif
            {!! Session::get('message') !!}
        </div>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                    <h4 class="card-title text-right">Form Tambah Kunjungan</h4>
                    <h6 class="card-subtitle text-right">Hari {{Tanggal::HariPanjang(\Carbon\Carbon::now())}}</h6>
                    <div class="row"> <!---row atas awal--->
                        <div class="col-lg-6 col-sm-6"> <!---form sebelah kiri-->
                            <h4 class="card-title">Biodata Pengunjung</h4>
                            <h6 class="card-subtitle">silakan input data sesuai identitas yang dimiliki </h6>
                            <hr>
                            <form id="form_baru" class="form-horizontal m-t-20" action="{{route('simpan')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="tamu_id" id="tamu_id" value="" />
                            <input type="hidden" name="edit_tamu" id="edit_tamu" value="0" />
                            <input type="hidden" name="tamu_baru" id="tamu_baru" value="0" />
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="jenis_identitas">Jenis Identitas</label>
                                        <select class="form-control" id="jenis_identitas" name="jenis_identitas" required>
                                            <option value="">Pilih Jenis Identitas</option>
                                            @foreach ($Midentitas as $item_identitas)
                                                    <option value="{{$item_identitas->id}}">{{$item_identitas->nama}}</option>
                                            @endforeach
                                    </select>

                                </div>
                                <div class="form-group col-md-8">
                                        <div class="row">
                                            <div class="col-md-8">
                                                    <label for="nomor_identitas">Nomor identitas</label>
                                                    <input type="text" class="form-control" id="nomor_identitas" name="nomor_identitas" required>
                                            </div>
                                            <div class="col-md-4">
                                                    <br />
                                                    <button type="button" name="cek_id" id="cek_id" class="btn btn-info">CEK ID</button>
                                                    <button type="button" name="edit_id" id="edit_id" class="btn btn-success" disabled>EDIT</button>
                                            </div>

                                        </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                        <label for="nama_lengkap">Nama lengkap</label>
                                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required readonly>
                                </div>
                                <div class="form-group col-md-6 m-b-40">
                                        <label for="id_jk">Jenis Kelamin</label>
                                        <select class="form-control" id="id_jk" name="id_jk" required disabled>
                                        <option value=""></option>
                                        @foreach ($Mjk as $item_jk)
                                                <option value="{{$item_jk->id}}">{{$item_jk->nama}}</option>
                                        @endforeach
                                        </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                        <label for="tgl_lahir">Tanggal lahir</label>
                                        <input type="text" class="form-control" id="tgl_lahir" name="tgl_lahir" autocomplete="off" required readonly>
                                </div>
                                <div class="form-group col-md-6">
                                        <label for="id_mdidik">Pendidikan terakhir</label>
                                        <select class="form-control" id="id_mdidik" name="id_mdidik" required disabled>
                                                <option value=""></option>
                                                @foreach ($Mpendidikan as $item_didik)
                                                        <option value="{{$item_didik->id}}">{{$item_didik->nama}}</option>
                                                @endforeach
                                        </select>

                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                        <label for="id_kerja">Pekerjaan</label>
                                        <select class="form-control" id="id_kerja" name="id_kerja" required disabled>
                                                <option value=""></option>
                                                @foreach ($Mpekerjaan as $i_pekerjaan)
                                                        <option value="{{$i_pekerjaan->id}}">{{$i_pekerjaan->nama}}</option>
                                                @endforeach
                                        </select>

                                </div>
                                <div class="form-group col-md-6">
                                        <label for="telepon">Telepon</label>
                                        <input type="text" class="form-control" id="telepon" name="telepon" required readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                        <label for="kat_kerja">Kategori Pekerjaan</label>
                                        <select class="form-control" id="kat_kerja" name="kat_kerja" required disabled>
                                                <option disabled selected></option>
                                                @foreach ($Mkatpekerjaan as $id_katkerja)
                                                        <option value="{{$id_katkerja->id}}">{{$id_katkerja->nama}}</option>
                                                @endforeach
                                        </select>
                                </div>
                                <div class="form-group col-md-6">
                                        <label for="email">E-mail</label>
                                        <input type="text" class="form-control" id="email" name="email" readonly>
                                </div>
                            </div>
                            <div class="row">
                                    <div class="form-group col-md-6">
                                                    <label for="pekerjaan_detil">Sekolah/Univ/Instansi/Detil Pekerjaan</label>
                                                    <input type="text" class="form-control" id="pekerjaan_detil" name="pekerjaan_detil" required readonly>

                                    </div>
                                    <div class="form-group col-md-6">
                                            <label for="mwarga">Kewarganegaraan</label>
                                            <select class="form-control" id="mwarga" name="mwarga" required disabled>
                                                    <option disabled selected></option>
                                                    @foreach ($Mwarga as $id_warga)
                                                            <option value="{{$id_warga->id}}">{{$id_warga->nama}}</option>
                                                    @endforeach
                                            </select>
                                    </div>
                            </div>
                            <div class="row">
                                    <div class="form-group col-md-6">
                                            <label for="alamat">Alamat</label>
                                            <textarea class="form-control" rows="4" name="alamat" id="alamat" readonly></textarea>
                                    </div>
                                    <div class="form-group col-md-6" id="pst_perlu">
                                            <label for="keperluan">Keperluan/Data yang dicari</label>
                                            <textarea class="form-control" rows="4" id="keperluan" name="keperluan" required></textarea>
                                    </div>
                            </div>
                        </div> <!---batas form sebelah kiri--->
                        <div class="col-lg-6 col-sm-6"> <!---form sebelah kanan--->
                            <h4 class="card-title">Photo Pengunjung</h4>
                            <h6 class="card-subtitle">ambil posisi terlihat semua wajah</h6>
                            <hr>
                            @if (ENV('APP_WEBCAM_MODE') == true)
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <video id="video" width="640" height="480" autoplay aria-hidden="false"></video>
                                    <canvas id="canvas" width="640" height="480" aria-hidden="true"></canvas>
                                    <br />
                                    <button type="button" id="ambil_foto" class="btn btn-success">Ambil Foto</button>
                                    <button type="button" id="reset_foto" class="btn btn-danger" disabled>Ulangi</button>
                                    <input type="hidden" name="foto" id="foto" />
                                    <button type="button" id="tanpa_webcam" class="btn btn-warning">Tanpa Webcam</button>
                                    <button type="button" id="dengan_webcam" class="btn btn-success">Dengan Webcam</button>
                                </div>
                            </div>
                            @else
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <input type="hidden" name="foto" id="foto" />
                                    <button type="button" id="tanpa_webcam" class="btn btn-danger">Klik ini Tanpa Webcam</button>
                                </div>
                            </div>
                            @endif
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <h5>Tujuan Kedatangan ke : <span class="text-danger">*</span></h5>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="kantorcheck" name="tujuan_kedatangan" value="0" class="custom-control-input" required checked="checked">
                                        <label class="custom-control-label" for="kantorcheck">Kantor</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="pstcheck" name="tujuan_kedatangan" value="1" class="custom-control-input">
                                        <label class="custom-control-label" for="pstcheck">Pelayanan Statistik Terpadu</label>
                                    </div>           
                                    
                                </div>
                            </div>
                            <div class="row">
                                    <div class="form-group col-md-6" id="PSTlayanan">
                                            <h5>Layanan yang ingin diakses : <span class="text-danger">*</span></h5>
                                            @foreach ($Mlayanan as $item_layanan)
                                                    <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input pst_layanan" name="pst_layanan[]" value="{{$item_layanan->id}}" id="layanan_{{$item_layanan->id}}">
                                                            <label class="custom-control-label" for="layanan_{{$item_layanan->id}}">{{$item_layanan->nama}}</label>
                                                    </div>
                                            @endforeach

                                    </div>
                                    <div class="form-group col-md-6" id="PSTmanfaat">
                                                    <h5>Pemanfaatan hasil kunjungan : <span class="text-danger">*</span></h5>
                                                    @foreach ($MKunjungan as $item_kunjungan)
                                                            <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input pst_manfaat" name="pst_manfaat[]" value="{{$item_kunjungan->id}}" id="kunjungan_{{$item_kunjungan->id}}">
                                                                    <label class="custom-control-label" for="kunjungan_{{$item_kunjungan->id}}">{{$item_kunjungan->nama}}</label>
                                                            </div>
                                                    @endforeach
                                    </div>

                            </div>
                            <div class="row">
                                    <div class="form-group col-md-6" id="PSTFasilitas">
                                            <h5>Fasilitas Utama : <span class="text-danger">*</span></h5>
                                            <select name="fasilitas_utama" class="form-control pst_fasilitas">
                                                <option value="">Pilih Fasilitas</option>
                                                @foreach ($Mfasilitas as $item_fasilitas)
                                                    <option value="{{$item_fasilitas->id}}">{{$item_fasilitas->nama}}</option>
                                                @endforeach
                                            </select>
                                    </div>
                            </div>
                        </div><!---form sebelah kanan--->
                    </div> <!---batas row atas awal--->
                    <div class="row">
                        <div class="col-lg-2 col-md-2 offset-lg-5 offset-md-3">
                            <button type="submit" id="tambah_data" class="btn btn-success waves-effect waves-light" disabled>Simpan</button>
                            <button type="reset" class="btn btn-danger waves-effect waves-light">Reset</button>
                        </div>
                        <div class="col-lg-4">

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
    <!-- Date picker plugins css -->
    <link href="{{asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <style type="text/css">
        #PSTlayanan, #PSTmanfaat, #PSTlayanan_lama, #PSTmanfaat_lama, #PSTFasilitas, #PSTFasilitas_lama, #canvas, #dengan_webcam {
            display: none;
        }

    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--alerts CSS -->
    <link href="{{asset('assets/node_modules/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">
    
    <link href="{{asset('assets/node_modules/Magnific-Popup-master/dist/magnific-popup.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css')}}">
@stop
@section('js')
<script>
$('#pstcheck').change(function(){
        $('#PSTlayanan').show();
        $('#PSTmanfaat').show();
        $('#PSTFasilitas').show();
        $('.pst_fasilitas').prop('required',true);
});
$('#kantorcheck').change(function(){
        $('#PSTlayanan').hide();
        $('#PSTmanfaat').hide();
        $('#PSTFasilitas').hide();
        $('.pst_fasilitas').prop('required',false);
});

</script>
@include('kunjungan.jsbaru')
    <script src="{{asset('dist/js/pages/jasny-bootstrap.js')}}"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="{{asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>

    <!-- end - This is for export functionality only -->

    <!-- Sweet-Alert  -->
    <script src="{{asset('assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
    <!-- Magnific popup JavaScript -->
    <script src="{{asset('assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup-init.js')}}"></script>
    <script>
   $('#tgl_lahir').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd',
    toggleActive: true,
    todayHighlight: true
}).on('show.bs.modal', function(event) {
    // prevent datepicker from firing bootstrap modal "show.bs.modal"
    event.stopPropagation();
});
$('#tgl_lahir_lama').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd',
    toggleActive: true,
    todayHighlight: true
}).on('show.bs.modal', function(event) {
    // prevent datepicker from firing bootstrap modal "show.bs.modal"
    event.stopPropagation();
});
$("#tgl_kunjungan").datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd',
    toggleActive: true,
    todayHighlight: true
}).on('show.bs.modal', function(event) {
    // prevent datepicker from firing bootstrap modal "show.bs.modal"
    event.stopPropagation();
});

    </script>
@stop

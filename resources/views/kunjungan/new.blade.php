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
                <h2 class="card-title text-right">Form Tambah Kunjungan</h2>
                <h6 class="card-subtitle text-right">Hari {{Tanggal::HariPanjang(\Carbon\Carbon::now())}}</h6>
                <!---form kunjungan baru--->
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8 col-sm-12">
                        <form id="form_baru" class="form-horizontal m-t-20" action="{{route('simpan')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="tamu_id" id="tamu_id" value="" />
                            <input type="hidden" name="edit_tamu" id="edit_tamu" value="0" />
                            <input type="hidden" name="tamu_baru" id="tamu_baru" value="0" />
                            <h3 class="card-title">Jenis Kunjungan</h3>
                            <h6 class="card-subtitle">silakan isikan sesuai jenis kunjungan </h6>
                            <hr class="m-t-0 m-b-20">
                            @include('kunjungan.form-jenis-kunjungan')
                            <h3 class="card-title">Biodata Pengunjung</h3>
                            <h6 class="card-subtitle">silakan input data sesuai identitas yang dimiliki </h6>
                            <hr class="m-t-0 m-b-20">
                            @include('kunjungan.form-pj-kunjungan')
                            <h3 class="card-title">Photo Pengunjung</h3>
                            <h6 class="card-subtitle">ambil posisi terlihat semua wajah</h6>
                            <hr class="m-t-0 m-b-20">
                            @include('kunjungan.form-photo-kunjungan')
                            <h3 class="card-title">Tujuan Kedatangan</h3>
                            <hr class="m-t-0 m-b-20">
                            @include('kunjungan.form-tujuan-kunjungan')
                            <hr>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" id="tambah_data" class="btn btn-success waves-effect waves-light" disabled>Simpan</button>
                            <button type="reset" class="btn btn-danger waves-effect waves-light">Reset</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6"> </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-2"></div>
                </div>
                <!---batas form--->
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
    <!-- Date picker plugins css -->
    <link href="{{asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <style type="text/css">
        #canvas, #tanpa_webcam, #video, #ambil_foto, #reset_foto {
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
$( document ).ready(function() {
    $('#PSTLayanan').hide();
    $('#PSTManfaat').hide();
    $('#PSTFasilitas').hide();
    $('#LayananUtama').hide();
    $('#manfaat_nama').hide();
    $('#fas_lainnya').hide();
    $('#jumlah_tamu').hide();
    $('#jumlah_tamu_teks').hide();
    $('#tamu_laki').hide();
    $('#tamu_laki_teks').hide();
    $('#tamu_wanita').hide();
    $('#tamu_wanita_teks').hide();
});
$('#pstcheck').change(function(){
        $('#PSTManfaat').show();
        $('#PSTLayanan').show();
        $('#PSTFasilitas').show();
        $('#LayananUtama').show();
        $('.pst_fasilitas').prop('required',true);
        $('#keperluan_label').text("Data yang dicari");
});
$('#kantorcheck').change(function(){
        $('#PSTLayanan').hide();
        $('#PSTManfaat').hide();
        $('#PSTFasilitas').hide();
        $('#LayananUtama').hide();
        $('.pst_fasilitas').prop('required',false);
        $('#keperluan_label').text("Keperluan");
});
$('#kelompok').change(function(){
        $('#jumlah_tamu').show();
        $('#jumlah_tamu_teks').show();
        $('#jumlah_tamu').prop('required',true);
        $('#jumlah_tamu').prop('value',null);
        $('#tamu_laki_teks').show();
        $('#tamu_laki').show();
        $('#tamu_laki').prop('required',true);
        $('#tamu_laki').prop('value',null);
        $('#tamu_wanita').show();
        $('#tamu_wanita_teks').show();
        $('#tamu_wanita').prop('required',true);
        $('#tamu_wanita').prop('value',null);
});
$('#perorangan').change(function(){
        $('#jumlah_tamu').hide();
        $('#jumlah_tamu_teks').hide();
        $('#jumlah_tamu').prop('required',false);
        $('#jumlah_tamu').val(1);
        $('#tamu_laki_teks').hide();
        $('#tamu_laki').hide();
        $('#tamu_laki').prop('required',false);
        $('#tamu_laki').val(0);
        $('#tamu_wanita').hide();
        $('#tamu_wanita_teks').hide();
        $('#tamu_wanita').prop('required',false);
        $('#tamu_wanita').val(0);


});

</script>
@include('kunjungan.jsnew')
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

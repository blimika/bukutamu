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
                <li class="breadcrumb-item active">Tambah Kunjungan Terjadwal</li>
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
                <h2 class="card-title text-right">Form Kunjungan Terjadwal</h2>
                <h6 class="card-subtitle text-right">Hari {{Tanggal::HariPanjang(\Carbon\Carbon::now())}}</h6>
                <!---form kunjungan baru--->
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8 col-sm-12">
                        <form id="form_baru" class="form-horizontal m-t-20" action="{{route('simpan.terjadwal')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="edit_tamu" id="edit_tamu" value="0" />
                            <input type="hidden" name="tamu_baru" id="tamu_baru" value="0" />
                            <h3 class="card-title">Rencana Kunjungan</h3>
                            <h6 class="card-subtitle">silakan isikan rencana kunjungan </h6>
                            <hr class="m-t-0 m-b-20">
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Tanggal Kunjungan</label>
                                <div class="col-md-3" id="tgl_kunjungan_error">
                                    <input type="text" class="form-control" id="tgl_kunjungan" name="tgl_kunjungan" autocomplete="off" required style="border: 1px solid black;" placeholder="Tanggal kunjungan">
                                </div>
                            </div>
                            <!--jenis kunjungan-->
                            <h3 class="card-title">Jenis Kunjungan</h3>
                            <h6 class="card-subtitle">silakan isikan sesuai jenis kunjungan </h6>
                            <hr class="m-t-0 m-b-20">
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Jenis Kunjungan</label>
                                <div class="col-md-9" id="jenis_kunjungan">
                                    <div class="form-group col-md-12">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="perorangan" name="jenis_kunjungan" value="1" class="custom-control-input" required checked="checked">
                                            <label class="custom-control-label radio-inline" for="perorangan">Perorangan</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="kelompok" name="jenis_kunjungan" value="2" class="custom-control-input">
                                            <label class="custom-control-label radio-inline" for="kelompok">Kelompok</label>
                                        </div>
                                        <div class="input-group" id="jumlah_tamu_teks">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-success" type="button">J</button>
                                            </div>
                                        <input type="number" name="jumlah_tamu" id="jumlah_tamu" value="1" class="form-control jumlah_tamu col-md-3" placeholder="Jumlah tamu"/>
                                        </div>
                                        <div class="input-group" id="tamu_laki_teks">
                                            <div class="input-group-prepend text-info">
                                                <button class="btn btn-info" type="button">L</button>
                                            </div>
                                            <input type="number" name="tamu_laki" id="tamu_laki" value="0" class="form-control tamu_laki col-md-3" placeholder="Laki-laki"/>
                                        </div>
                                        <div class="input-group" id="tamu_wanita_teks">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-danger" type="button">P</button>
                                            </div>
                                        <input type="number" name="tamu_wanita" id="tamu_wanita" value="0" class="form-control tamu_wanita col-md-3" placeholder="Perempuan"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if (Auth::user()->tamu_id != 0)
                                @include('kunjungan.form-biodata-terjadwal')
                            @else
                            <!--batas jenis kunjungan-->
                            <input type="hidden" name="tamu_id" id="tamu_id" value="" />
                            <h3 class="card-title">Biodata Penanggung Jawab Kunjungan</h3>
                            <h6 class="card-subtitle">silakan input data sesuai identitas yang dimiliki </h6>
                            <hr class="m-t-0 m-b-20">
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Identitas</label>
                                <div class="col-md-4" id="jenis_identitas_error">
                                    <select class="form-control" id="jenis_identitas" name="jenis_identitas" required>
                                            <option value="">Pilih Jenis</option>
                                            @foreach ($Midentitas as $item_identitas)
                                                <option value="{{$item_identitas->id}}">{{$item_identitas->nama}}</option>
                                            @endforeach
                                    </select>
                                    <small class="form-control-feedback" id="jenis_identitas_teks"></small>
                                </div>
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md-7" id="nomor_identitas_error">
                                                <input type="text" class="form-control" placeholder="Nomor Identitas" id="nomor_identitas" name="nomor_identitas" required>
                                        </div>
                                        <div class="col-md-5">
                                                <button type="button" name="cek_id" id="cek_id" class="btn btn-info"><i class="fas fa-search"></i></button>
                                                <button type="button" name="edit_id" id="edit_id" class="btn btn-success" disabled><i class="fas fa-pencil-alt"></i></button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Nama lengkap</label>
                                <div class="col-md-9" id="nama_lengkap_error">
                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Jenis Kelamin</label>
                                <div class="col-md-4" id="id_jk_error">
                                    <select class="form-control" id="id_jk" name="id_jk" required disabled>
                                        <option value=""></option>
                                        @foreach ($Mjk as $item_jk)
                                                <option value="{{$item_jk->id}}">{{$item_jk->nama}}</option>
                                        @endforeach
                                        </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Tanggal lahir</label>
                                <div class="col-md-4" id="tgl_lahir_error">
                                    <input type="text" class="form-control" id="tgl_lahir" name="tgl_lahir" autocomplete="off" required readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">E-Mail</label>
                                <div class="col-md-9" id="email_error">
                                    <input type="text" class="form-control" id="email" name="email" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Nomor Handphone</label>
                                <div class="col-md-9" id="telepon_error">
                                    <input type="text" class="form-control" id="telepon" name="telepon" required readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Kewarganegaraan</label>
                                <div class="col-md-9" id="mwarga_error">
                                    <select class="form-control" id="mwarga" name="mwarga" required disabled>
                                        <option value=""></option>
                                        @foreach ($Mwarga as $id_warga)
                                                <option value="{{$id_warga->id}}">{{$id_warga->nama}}</option>
                                        @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Alamat</label>
                                <div class="col-md-9" id="alamat_error">
                                    <textarea class="form-control" rows="4" name="alamat" id="alamat" readonly></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Pendidikan terakhir</label>
                                <div class="col-md-4" id="id_mdidik_error">
                                    <select class="form-control" id="id_mdidik" name="id_mdidik" required disabled>
                                        <option value=""></option>
                                        @foreach ($Mpendidikan as $item_didik)
                                                <option value="{{$item_didik->id}}">{{$item_didik->nama}}</option>
                                        @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Pekerjaan Utama</label>
                                <div class="col-md-4" id="id_kerja_error">
                                    <select class="form-control" id="id_kerja" name="id_kerja" required disabled>
                                        <option value=""></option>
                                        @foreach ($Mpekerjaan as $i_pekerjaan)
                                                <option value="{{$i_pekerjaan->id}}">{{$i_pekerjaan->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Kategori Instansi/Institusi</label>
                                <div class="col-md-6" id="kat_kerja_error">
                                    <select class="form-control" id="kat_kerja" name="kat_kerja" required disabled>
                                        <option value=""></option>
                                        @foreach ($Mkatpekerjaan as $id_katkerja)
                                                <option value="{{$id_katkerja->id}}">{{$id_katkerja->nama}}</option>
                                        @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Nama Instansi/Institusi</label>
                                <div class="col-md-9" id="pekerjaan_detil_error">
                                    <input type="text" class="form-control" id="pekerjaan_detil" name="pekerjaan_detil" required readonly>
                                </div>
                            </div>
                            <!---batas biodata--->
                            @endif
                            <h3 class="card-title">Tujuan Kedatangan</h3>
                            <hr class="m-t-0 m-b-20">
                            <div class="row">
                                <div class="form-group col-md-6">
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
                            <div class="form-group row" id="PSTManfaat">
                                <div class="col-md-3">
                                <label class="control-label text-right">Pemanfaatan hasil kunjungan</label>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control" id="id_manfaat" name="id_manfaat">
                                        <option value="">Pilih salah satu</option>
                                        @foreach ($MManfaat as $i_manfaat)
                                                <option value="{{$i_manfaat->id}}">{{$i_manfaat->nama}}</option>
                                        @endforeach
                                    </select>
                                    <br />
                                    <input type="text" name="manfaat_nama" id="manfaat_nama" class="form-control manfaat_nama" placeholder="Pemanfaatan hasil kunjungan lainnya"/>
                                </div>
                            </div>
                            <div class="row">
                                    <div class="form-group col-md-6" id="PSTLayanan">
                                            <h5>Layanan yang ingin diakses : <span class="text-danger">*</span></h5>
                                            @foreach ($Mlayanan as $item_layanan)
                                                    <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input pst_layanan" name="pst_layanan[]" value="{{$item_layanan->id}}" id="layanan_{{$item_layanan->id}}">
                                                            <label class="custom-control-label" for="layanan_{{$item_layanan->id}}">{{$item_layanan->nama}}</label>
                                                    </div>
                                            @endforeach

                                    </div>
                                    <div class="form-group col-md-6" id="PSTFasilitas">
                                                    <h5>Fasilitas yang Digunakan : <span class="text-danger">*</span></h5>
                                                    @foreach ($Mfasilitas as $item_fasilitas)
                                                            <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input pst_fasilitas" name="pst_fasilitas[]" value="{{$item_fasilitas->id}}" id="fasilitas_{{$item_fasilitas->id}}">
                                                                    <label class="custom-control-label" for="fasilitas_{{$item_fasilitas->id}}">{{$item_fasilitas->nama}}</label>
                                                            </div>
                                                    @endforeach
                                                    <input type="text" name="fas_lainnya" id="fas_lainnya" class="form-control fas_lainnya" placeholder="Fasilitas lainnya yang digunakan"/>
                                    </div>

                            </div>
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3" id="keperluan_label">Keperluan</label>
                                <div class="col-md-9" id="keperluan_error">
                                    <textarea class="form-control" rows="4" id="keperluan" name="keperluan" required></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" id="tambah_data" class="btn btn-success waves-effect waves-light">Simpan</button>
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
        .border-hitam {
            border: 1px solid black;
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
        $('.pst_fasilitas').prop('required',true);
        $('#keperluan_label').text("Data yang dicari");
});
$('#kantorcheck').change(function(){
        $('#PSTLayanan').hide();
        $('#PSTManfaat').hide();
        $('#PSTFasilitas').hide();
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
@include('kunjungan.jsterjadwal')
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
    todayHighlight: true,
    startDate: new Date()
}).on('show.bs.modal', function(event) {
    // prevent datepicker from firing bootstrap modal "show.bs.modal"
    event.stopPropagation();
});

    </script>
@stop

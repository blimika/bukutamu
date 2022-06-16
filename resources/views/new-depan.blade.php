@extends('layouts.utama')
@section('konten')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Bukutamu</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Depan</a></li>
                <li class="breadcrumb-item active">Bukutamu</li>
            </ol>
            <!--<button type="button" class="btn btn-info d-none d-lg-block m-l-15" data-toggle="modal" data-target="#TambahModal"><i class="fa fa-plus-circle"></i> Tambah</button>-->
            <a href="{{route('kunjungan.baru')}}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Kunjungan Baru</a>
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
    <h5 class="card-subtitle float-right m-b-10">Hari {{Tanggal::HariPanjang(\Carbon\Carbon::now())}}</h5>
    </div>
</div>
@if ($Kunjungan->isEmpty())
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body"><b>Data pengunjung tidak tersedia</b>
            </div>
        </div>
    </div>
</div>
@else
<div class="row el-element-overlay">
    @foreach ($Kunjungan as $item)
    <!-- tampilan baru--->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="el-card-item">
                <div class="el-card-avatar el-overlay-1">
                    <img src="{{asset('storage/'.$item->file_foto)}}" alt="image" class="img-responsive"/>
                    <div class="el-overlay">
                        <ul class="el-info">
                            @if ($item->file_foto != NULL)
                            <li>
                                <a class="btn default btn-outline image-popup-vertical-fit" href="{{asset('storage'.$item->file_foto)}}" title="Nama : {{$item->tamu->nama_lengkap}} | Kunjungan : {{\Tanggal::HariPanjang($item->updated_at)}}">
                                    <i class="icon-magnifier"></i>
                                </a>
                            </li>
                            @endif
                            <li>
                                <a class="btn default btn-outline" href="javascript:void(0);" data-id="{{$item->tamu_id}}" data-toggle="modal" data-target="#ViewModal">
                                    <i class="icon-link"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="el-card-content">
                    <h4 class="box-title">{{$item->tamu->nama_lengkap}}</h4>
                    <small>{{$item->tamu->pekerjaan->nama}} - {{$item->tamu->kerja_detil}}</small>
                    <p>
                        @if ($item->tamu->jk->inisial=='L')
                        <span class="badge badge-info badge-pill">{{$item->tamu->jk->inisial}}</span>
                        @else
                        <span class="badge badge-danger badge-pill">{{$item->tamu->jk->inisial}}</span>
                        @endif
                        @if ($item->is_pst=='0')
                        <span class="badge badge-danger badge-pill">Kantor</span>
                        @else
                        <span class="badge badge-success badge-pill">PST</span>
                        @endif
                        <span class="badge badge-warning badge-pill">{{ \Carbon\Carbon::parse($item->tamu->tgl_lahir)->age}}</span>
                        <br />
                        <i>{{$item->keperluan}}</i>
                    </p>
                    <div class="m-r-10 float-right">
                        <span>{{ $item->created_at->diffForHumans()}}</span>
                        @if ($item->f_feedback==1)
                        <span data-toggle="tooltip" data-placement="top" title="{{$item->tamu->nama_lengkap}} belum memberikan feedback, klik tombol ini untuk memberikan feedback"><button type="button" class="btn waves-effect waves-light btn-rounded btn-sm btn-danger" data-tamuid="{{$item->tamu_id}}" data-toggle="modal" data-target="#FeedbackModal" data-kunjunganid="{{$item->id}}" >Feedback</button></span>
                        @else
                        <button type="button" class="btn btn-circle btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="{{$item->tamu->nama_lengkap}} sudah memberikan feedback"><i class="fas fa-check"></i></button>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- batas tampilan baru--->
    @endforeach
</div>
@endif
@include('modal-tambah')
@endsection

@section('css')
    <!-- Date picker plugins css -->
    <link href="{{asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <style type="text/css">
        #PSTlayanan, #PSTmanfaat, #PSTlayanan_lama, #PSTmanfaat_lama, #PSTFasilitas, #PSTFasilitas_lama, #canvas {
            display: none;
        }
        .starrating > input {display: none;}  /* Remove radio buttons */
        .starrating > label:before {
        content: "\f005"; /* Star */
        margin: 2px;
        font-size: 4em;
        font-family: FontAwesome;
        display: inline-block;
        }
        .starrating > label
        {
        color: #222222; /* Start color when not clicked */
        }

        .starrating > input:checked ~ label
        { color: #ffca08 ; } /* Set yellow color when star checked */
        .starrating > input:hover ~ label
        { color: #ffca08 ;  } /* Set yellow color when star hover */
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--alerts CSS -->
    <link href="{{asset('assets/node_modules/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/node_modules/Magnific-Popup-master/dist/magnific-popup.css')}}" rel="stylesheet">
    <!-- page css -->
    <link href="{{asset('dist/css/pages/user-card.css')}}" rel="stylesheet">
@stop
@section('js')
<script>
$('#pstcheck').change(function(){
        $('#PSTlayanan').toggle();
        $('#PSTmanfaat').toggle();
        $('#PSTFasilitas').toggle();
    });
    $('#pstcheck_lama').change(function(){
        $('#PSTlayanan_lama').toggle();
        $('#PSTmanfaat_lama').toggle();
        $('#PSTFasilitas_lama').toggle();
    });
</script>
@include('js')
    <script src="{{asset('dist/js/pages/jasny-bootstrap.js')}}"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="{{asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <!-- Sweet-Alert  -->
    <script src="{{asset('assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
    <!-- Magnific popup JavaScript -->
    <script src="{{asset('assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup.min.js')}}"></script>

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
   <script src="{{asset('assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup-init.js')}}"></script>
@stop

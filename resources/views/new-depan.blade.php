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
    <h5 class="card-subtitle float-right m-b-10 text-info">Hari {{Tanggal::HariPanjang(\Carbon\Carbon::now())}}</h5>
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
<div class="row">
    @foreach ($Kunjungan as $item)
    <!-- .col -->
    <div class="col-md-4 col-lg-4 col-xlg-3">
        <div class="card card-body">
            <div class="row align-items-center">
                <div class="col-md-4 col-lg-4 text-center">
                    @if ($item->file_foto != NULL)
                    <a class="image-popup-no-margins" href="{{asset('storage'.$item->file_foto)}}" title="Nama : {{$item->tamu->nama_lengkap}} | Kunjungan : {{\Tanggal::HariPanjang($item->updated_at)}}"> <img src="{{asset('storage/'.$item->file_foto)}}" alt="image" class="img-responsive" /> </a>
                    @endif
                </div>
                <div class="col-md-8 col-lg-8">
                    <h5 class="box-title m-b-0"><a href="#" class="text-info" data-id="{{$item->tamu_id}}" data-toggle="modal" data-target="#ViewModal">{{$item->tamu->nama_lengkap}}</a>
                        @if ($item->f_feedback==1)
                        <span data-toggle="tooltip" data-placement="top" title="{{$item->tamu->nama_lengkap}} belum memberikan feedback, klik tombol ini untuk memberikan feedback"><button type="button" class="float-right btn waves-effect waves-light btn-rounded btn-sm btn-danger" data-tamuid="{{$item->tamu_id}}" data-toggle="modal" data-target="#FeedbackModal" data-kunjunganid="{{$item->id}}" >Feedback</button></span>
                        @else
                        <button type="button" class="float-right btn btn-circle btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="{{$item->tamu->nama_lengkap}} sudah memberikan feedback"><i class="fas fa-check"></i></button>
                        @endif
                    </h5>
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
                    <p class="m-b-5">
                        <small>{{$item->tamu->pekerjaan->nama}} - {{$item->tamu->kerja_detil}}</small>
                    </p>

                    <address>
                        {{$item->tamu->alamat}}
                        <br/>
                        <abbr title="Nomor HP">HP:</abbr> {{$item->tamu->telepon}}
                    </address>
                    <i>{{$item->keperluan}}</i>
                    <br />
                    <small>{{ $item->created_at->diffForHumans()}}</small>
                </div>
            </div>
        </div>
    </div>
    <!-- /.col -->
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
    <link rel="stylesheet" type="text/css" href="{{asset('assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css')}}">
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

    <script>
         $(document).ready(function() {
            $('.image-popup-no-margins').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		closeBtnInside: false,
		fixedContentPos: true,
		mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
		image: {
			verticalFit: true
		},
		zoom: {
			enabled: true,
			duration: 300 // don't foget to change the duration also in CSS
		}
	});
            });
    </script>
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
@stop

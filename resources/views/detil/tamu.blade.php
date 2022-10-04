@extends('layouts.utama')
@section('konten')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Detil Pengunjung </h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Depan</a></li>
                <li class="breadcrumb-item active">Bukutamu</li>
            </ol>
            <button type="button" class="btn btn-info d-none d-lg-block m-l-15" data-toggle="modal" data-target="#InputDataLamaModal"><i class="fa fa-plus-circle"></i> Tambah</button>
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
                @if ($dataTamu)
                <ul class="timeline">
                    <li>
                        <div class="timeline-badge success"><i class="fas fa-chevron-circle-left"></i> </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">{{$dataTamu->nama_lengkap}}</h4>
                                <p><small class="text-muted"><i class="fa fa-clock-o"></i> Terdaftar: {{Tanggal::LengkapHariPanjang($dataTamu->created_at)}}</small> </p>
                            </div>
                            <div class="timeline-body">
                                <div class="m-t-20 row">
                                    <div class="col-md-3 col-xs-12"><img src="{{asset('storage/img/qrcode/'.$dataTamu->kode_qr.'-'.$dataTamu->id.'.png')}}" alt="user" class="img-responsive radius" /></div>
                                    <div class="col-md-9 col-xs-12">
                                        <p>Identitas <strong class="font-weight-bold">{{$dataTamu->identitas->nama}}</strong> nomor <strong class="font-weight-bold">{{$dataTamu->nomor_identitas}}</strong> lahir pada hari <strong class="font-weight-bold">{{Tanggal::HariPanjang($dataTamu->tgl_lahir)}}</strong> jenis kelamin <strong class="font-weight-bold">{{$dataTamu->jk->nama}}</strong> pekerjaan <strong class="font-weight-bold">{{$dataTamu->pekerjaan->nama}}</strong> di <strong class="font-weight-bold">{{$dataTamu->kerja_detil}}</strong> alamat <strong class="font-weight-bold">{{$dataTamu->alamat}}</strong> dengan email <strong class="font-weight-bold">{{$dataTamu->email}}</strong> and nomor hp <strong class="font-weight-bold">{{$dataTamu->telepon}}</strong></p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </li>
                    @foreach ($dataKunjungan as $item)
                        @if($loop->odd)
                            <li class="timeline-inverted">
                                <div class="timeline-badge warning">
                                    <i class="fas fa-chevron-circle-right"></i>
                                </div>
                        @else
                        <li>
                            <div class="timeline-badge success">
                                <i class="fas fa-chevron-circle-left"></i>
                            </div>
                        @endif
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">Kunjungan hari {{Tanggal::HariPanjang($item->tanggal)}}</h4>
                            </div>
                            <div class="timeline-body el-element-overlay">
                                @if ($item->file_foto)

                                <div class="el-card-item">
                                <div class="el-card-avatar el-overlay-1">
                                    <a class="image-popup-vertical-fit" href="{{asset('storage'.$item->file_foto)}}" title="Nama : {{$item->tamu->nama_lengkap}} | Kunjungan : {{\Tanggal::HariPanjang($item->updated_at)}}"> <img src="{{asset('storage'.$item->file_foto)}}" alt="user" /> </a>
                                </div>
                                </div>

                                @endif
                                <p>Kunjungan ke <strong class="font-weight-bold">{{$item->mTujuan->nama}}</strong> secara
                                    @if ($item->jenis_kunjungan == 1)
                                    <strong class="font-weight-bold">{{$item->jKunjungan->nama}}</strong>,
                                    @else
                                    <strong class="font-weight-bold">{{$item->jKunjungan->nama}}</strong> sebanyak <strong>{{$item->jumlah_tamu}} orang</strong>,
                                    @endif

                                    @if ($item->is_pst == 0)
                                        keperluan
                                    @else
                                        data yang dicari
                                    @endif
                                    <strong class="font-weight-bold">{{$item->keperluan}}</strong>
                                </p>
                                <p>
                                    @if ($item->f_feedback==1)
                                    <button type="button" class="btn waves-effect waves-light btn-rounded btn-sm btn-danger" data-tamuid="{{$item->tamu_id}}" data-toggle="modal" data-target="#FeedbackModal" data-kunjunganid="{{$item->id}}" >Feedback</button>
                                    @else
                                    <button type="button" class="btn btn-circle btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="{{$item->tamu->nama_lengkap}} sudah memberikan feedback"><i class="fas fa-check"></i></button>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </li>
                    @endforeach

                </ul>
                @else
                    data pengunjung tidak tersedia
                @endif

            </div>
        </div>
    </div>
</div>
@include('modal-feedback')
@endsection

@section('css')
    <!-- Date picker plugins css -->
    <link href="{{asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style type="text/css">
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
    <!--alerts CSS -->
    <link href="{{asset('assets/node_modules/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css')}}">
    <!-- Popup CSS -->
    <link href="{{asset('assets/node_modules/Magnific-Popup-master/dist/magnific-popup.css')}}" rel="stylesheet">
    <!-- page css -->
    <link href="{{asset('dist/css/pages/timeline-vertical-horizontal.css')}}" rel="stylesheet">
    <!-- page css -->
    <link href="{{asset('dist/css/pages/user-card.css')}}" rel="stylesheet">
@stop
@section('js')
    @include('js')
    <!-- Magnific popup JavaScript -->
    <script src="{{asset('assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup-init.js')}}"></script>
@stop

@extends('layouts.utama')
@section('konten')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Timeline Pengunjung </h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Depan</a></li>
                <li class="breadcrumb-item active">Bukutamu</li>
            </ol>
            <a href="{{route('newkunjungan')}}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Kunjungan Baru</a>
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
                @if ($data)
                <ul class="timeline">
                    <li>
                        <div class="timeline-badge success"><i class="fas fa-chevron-circle-left"></i> </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">{{$data->pengunjung_nama}}</h4>
                                <p><small class="text-muted"><i class="fa fa-clock-o"></i> Terdaftar: {{Tanggal::LengkapHariPanjang($data->created_at)}}</small> </p>
                            </div>
                            <div class="timeline-body">
                                <div class="m-t-20 row">
                                    <div class="col-md-3 col-xs-12">
                                        @if ($data->pengunjung_foto_profil != null)
                                            @if (Storage::disk('public')->exists($data->pengunjung_foto_profil))
                                             <a class="image-popup-vertical-fit" href="{{asset('storage'.$data->pengunjung_foto_profil)}}" title="Nama : {{$data->pengunjung_nama}}"><img src="{{asset('storage/'.$data->pengunjung_foto_profil)}}" alt="user" class="img-responsive radius" /></a>
                                            @else
                                            <img src="https://placehold.co/480x360/0022FF/FFFFFF/?text=photo+tidak+ada" alt="image" class="img-responsive"/></a>
                                            @endif
                                        @else
                                        <img src="https://placehold.co/480x360/0022FF/FFFFFF/?text=photo+tidak+ada" alt="image" class="img-responsive"/></a>
                                        @endif
                                    </div>
                                    <div class="col-md-9 col-xs-12">
                                        <dl class="row p-0">
                                            <dt class="col-sm-4">ID</dt>
                                            <dd class="col-sm-8">#{{$data->pengunjung_id}}</dd>
                                            <dt class="col-sm-4">UID</dt>
                                            <dd class="col-sm-8">{{$data->pengunjung_uid}}</dd>
                                            <dt class="col-sm-4">Jenis Kelamin</dt>
                                            <dd class="col-sm-8">{{$data->JenisKelamin->nama}}</dd>
                                            <dt class="col-sm-4">Tahun Lahir</dt>
                                            <dd class="col-sm-8">{{$data->pengunjung_tahun_lahir}}</dd>
                                            <dt class="col-sm-4">Pekerjaan</dt>
                                            <dd class="col-sm-8">{{$data->pengunjung_pekerjaan}}</dd>
                                            <dt class="col-sm-4">Pendidikan</dt>
                                            <dd class="col-sm-8">{{$data->Pendidikan->nama}}</dd>
                                            <dt class="col-sm-4">E-mail</dt>
                                            <dd class="col-sm-8">{{$data->pengunjung_email}}</dd>
                                            <dt class="col-sm-4">Nomor HP</dt>
                                            <dd class="col-sm-8">{{$data->pengunjung_nomor_hp}} <a href="http://wa.me/62{{substr($data->pengunjung_nomor_hp,1)}}" id="pengunjung_wa" target="_blank" class="btn waves-effect btn-success btn-xs waves-light"><i class="fab fa-whatsapp"></i></a></dd>
                                            <dt class="col-sm-4">Alamat</dt>
                                            <dd class="col-sm-8">{{$data->pengunjung_alamat}}</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    @if ($data->kunjungan)
                        @foreach ($data->kunjungan as $item)
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
                                    <h4 class="timeline-title">Kunjungan hari {{Tanggal::HariPanjang($item->kunjungan_tanggal)}} Jam {{\Carbon\Carbon::parse($item->created_at)->format('H:i')}} </h4>
                                </div>
                                <div class="timeline-body el-element-overlay">
                                    <div class="el-card-item">
                                        <div class="el-card-avatar el-overlay-1">
                                            @if ($item->kunjungan_foto != NULL)
                                                @if (Storage::disk('public')->exists($item->kunjungan_foto))
                                                <a class="image-popup-vertical-fit" href="{{asset('storage'.$item->kunjungan_foto)}}" title="Nama : {{$data->pengunjung_nama}}"> <img src="{{asset('storage'.$item->kunjungan_foto)}}" alt="user" /> </a>
                                                @else
                                                <img src="https://placehold.co/480x360/0022FF/FFFFFF/?text=photo+tidak+ada" alt="image" class="img-responsive"/>
                                                @endif
                                            @else
                                            <img src="https://placehold.co/480x360/0022FF/FFFFFF/?text=photo+tidak+ada" alt="image" class="img-responsive"/>
                                            @endif
                                        </div>
                                        <dl class="row p-0">
                                            <dt class="col-sm-3">ID</dt>
                                            <dd class="col-sm-9">#{{$item->kunjungan_id}}</dd>
                                            <dt class="col-sm-3">UID</dt>
                                            <dd class="col-sm-9">{{$item->kunjungan_uid}}</dd>
                                            <hr>
                                            <dt class="col-sm-3">Keperluan</dt>
                                            <dd class="col-sm-9">{{$item->kunjungan_keperluan}}</dd>
                                            <dt class="col-sm-3">Tindak Lanjut</dt>
                                            <dd class="col-sm-9"><i>{{$item->kunjungan_tindak_lanjut}}</i></dd>
                                            <dt class="col-sm-3">Petugas</dt>
                                            <dd class="col-sm-9">
                                                @if($item->kunjungan_petugas_id > 0)
                                                {{$item->Petugas->name}}
                                               @endif
                                                </dd>
                                            <hr style="width: 100%; color: black; height: 1px;" />
                                            <dt class="col-sm-3">Nilai Feedback</dt>
                                            <dd class="col-sm-9">
                                                @if ($item->kunjungan_flag_feedback == 2)
                                                    @for ($i = 1; $i < 7; $i++)
                                                        @if ($i <= $item->kunjungan_nilai_feedback)
                                                            <span class="fa fa-star text-warning"></span>
                                                        @else
                                                            <span class="fa fa-star"></span>
                                                        @endif
                                                    @endfor
                                                @else
                                                    <i>--- belum tersedia ----</i>
                                                @endif

                                            </dd>
                                            <dt class="col-sm-3">Komentar</dt>
                                            <dd class="col-sm-9"><i>{{$item->kunjungan_komentar_feedback}}</i></dd>
                                            <dt class="col-sm-3">Tanggal</dt>
                                            <dd class="col-sm-9">
                                                @if ($item->kunjungan_tanggal_feedback)
                                                    {{Tanggal::LengkapHariPanjang($item->kunjungan_tanggal_feedback)}}
                                                @else
                                                    <i>--- belum tersedia ----</i>
                                                @endif
                                            </dd>
                                            <dt class="col-sm-3">IP</dt>
                                            <dd class="col-sm-9">
                                                @if ($item->kunjungan_ip_feedback)
                                                    {{$item->kunjungan_ip_feedback}}
                                                @else
                                                    <i>--- tidak tersedia ----</i>
                                                @endif
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            </li>
                        @endforeach
                    @endif
                </ul>
                @else
                    <h3 class="text-center">Data Pengunjung tidak tersedia</h3>
                @endif
            </div>
        </div>
    </div>
</div>

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
     <!-- Sweet-Alert  -->
     <script src="{{asset('assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
    <!-- Magnific popup JavaScript -->
    <script src="{{asset('assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup-init.js')}}"></script>
@stop

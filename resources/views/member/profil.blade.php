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
                <li class="breadcrumb-item">Members</li>
                <li class="breadcrumb-item active">Profil</li>
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
        <div class="alert alert-{{ Session::get('message_type') }}" id="waktu2" style="margin-top:10px;">{{ Session::get('message') }}</div>
        @endif
    </div>
</div>
<div class="row">
    <!---kolom kiri--->
    <div class="col-lg-6 col-sm-6 col-xs-12">
        <div class="card">
            <div class="card-body">
                    <h4 class="card-title">Profilku</h4>

                    <center class="m-t-30">
                        @if (Auth::user()->user_foto != NULL)
                            @if (Storage::disk('public')->exists(Auth::user()->user_foto))
                            <img src="{{asset('storage'.Auth::user()->user_foto)}}" width="200" class="img-responsive radius" />
                            @else
                                <img src="https://via.placeholder.com/480x480/0022FF/FFFFFF/?text=photo+tidak+ada" class="img-circle" width="150" />
                            @endif
                        @else
                            <img src="https://via.placeholder.com/480x480/0022FF/FFFFFF/?text=photo+tidak+ada" class="img-circle" width="150" />
                        @endif

                        <h4 class="card-title m-t-10">{{Auth::user()->name}}</h4>
                        <h6 class="card-subtitle">{{Auth::user()->mLevel->nama}}</h6>

                    </center>
                            <hr>
                            <dl class="row">
                                <dt class="col-lg-3 col-md-3 col-xs-12">ID</dt>
                                <dd class="col-lg-9 col-sm-9">#{{Auth::user()->id}}</dd>
                                <dt class="col-lg-3 col-md-3 col-xs-12">Username</dt>
                                <dd class="col-lg-9 col-sm-9">{{Auth::user()->username}}</dd>
                                <dt class="col-lg-3 col-md-3 col-xs-12">Email</dt>
                                <dd class="col-lg-9 col-sm-9">
                                    @if (Auth::user()->email_kodever == "0")
                                        {{Auth::user()->email}} <span class="badge badge-pill badge-success">sudah verifikasi</span>
                                    @else
                                        {{Auth::user()->email_ganti}} <button class="btn btn-xs btn-danger btn-rounded mailverifikasi" data-id="{{Auth::user()->id}}" data-nama="{{Auth::user()->name}}">belum verifikasi</button>
                                    @endif
                                    </dd>
                                <dt class="col-lg-3 col-md-3 col-xs-12">Nomor Telepon</dt>
                                <dd class="col-lg-9 col-sm-9">
                                    @if (Auth::user()->telepon)
                                        {{Auth::user()->telepon}}
                                    @else
                                        -
                                    @endif
                                </dd>
                                <dt class="col-lg-3 col-md-3 col-xs-12">Last login</dt>
                                <dd class="col-lg-9 col-sm-9">{{\Carbon\Carbon::parse(Auth::user()->lastlogin)->isoFormat('dddd, D MMMM Y H:mm:ss')}}</dd>
                                <dt class="col-lg-3 col-md-3 col-xs-12">Last IP</dt>
                                <dd class="col-lg-9 col-sm-9">{{Auth::user()->lastip}}</dd>
                                <dt class="col-lg-3 col-md-3 col-xs-12">Dibuat </dt>
                                <dd class="col-lg-9 col-sm-9">
                                    @if (Auth::user()->created_at)
                                        {{\Carbon\Carbon::parse(Auth::user()->created_at)->isoFormat('dddd, D MMMM Y H:mm:ss')}}
                                    @else
                                        <i>-belum tersedia-</i>
                                    @endif
                                </dd>
                                <dt class="col-lg-3 col-md-3 col-xs-12">Diupdate</dt>
                                <dd class="col-lg-9 col-sm-9">
                                    @if (Auth::user()->updated_at)
                                        {{\Carbon\Carbon::parse(Auth::user()->updated_at)->isoFormat('dddd, D MMMM Y H:mm:ss')}}
                                    @else
                                        belum pernah update
                                    @endif
                                </dd>
                                <dt class="col-lg-3 col-md-3 col-xs-12">Akun aktivasi </dt>
                                <dd class="col-lg-9 col-sm-9">
                                    @if (Auth::user()->akun_verified_at)
                                        {{\Carbon\Carbon::parse(Auth::user()->akun_verified_at)->isoFormat('dddd, D MMMM Y H:mm:ss')}}
                                    @else
                                        <i>-belum tersedia-</i>
                                    @endif
                                </dd>
                                <dt class="col-lg-3 col-md-3 col-xs-12">Flag</dt>
                                <dd class="col-lg-9 col-sm-9">
                                    @if (Auth::user()->flag == 1)
                                        <span class="badge badge-pill badge-success">Aktif</span>
                                    @else
                                    <span class="badge badge-pill badge-danger">Non-Aktif</span>
                                    @endif

                                </dd>
                                <dt class="col-lg-3 col-md-3 col-xs-12">Tamu ID</dt>
                                <dd class="col-lg-9 col-sm-9">
                                    @if (Auth::user()->tamu_id == 0)
                                        <span class="badge badge-pill badge-danger">belum terkoneksi</span> <button class="btn btn-sm btn-rounded btn-success" id="KaitanPengunjung" data-id="{{Auth::user()->id}}" data-nama="{{Auth::user()->name}}" data-toggle="modal" data-target="#KaitkanModal"><i class="fas fa-bolt" data-toggle="tooltip" title="Kaitkan data pengunjung"></i> KAITKAN</button>
                                    @else
                                        <span class="badge badge-pill badge-success">sudah terkoneksi</span> <button class="btn btn-sm btn-rounded btn-danger putuskan" id="PutuskanKoneksi" data-id="{{Auth::user()->id}}" data-nama="{{Auth::user()->name}}" data-kodeqr="{{ Auth::user()->mtamu->kode_qr }}"><i class="fas fa-bolt" data-toggle="tooltip" title="Putuskan kaitan"></i> PUTUSKAN</button>
                                    @endif
                                </dd>
                            </dl>
                            <!--jika sudah terkoneksi-->
                            @if (Auth::user()->tamu_id != 0)
                                <dl class="row">
                                    <dt class="col-lg-3 col-md-3 col-xs-12">Tamu ID</dt>
                                    <dd class="col-lg-9 col-sm-9">#{{Auth::user()->mtamu->id}}</dd>
                                    <dt class="col-lg-3 col-md-3 col-xs-12">Nama Lengkap</dt>
                                    <dd class="col-lg-9 col-sm-9">{{Auth::user()->mtamu->nama_lengkap}}</dd>
                                    <dt class="col-lg-3 col-md-3 col-xs-12">Kode QR</dt>
                                    <dd class="col-lg-9 col-sm-9">{{Auth::user()->mtamu->kode_qr}}</dd>
                                    <dt class="col-lg-3 col-md-3 col-xs-12">Tanggal lahir</dt>
                                    <dd class="col-lg-9 col-sm-9">{{Auth::user()->mtamu->tgl_lahir}}</dd>
                                    <dt class="col-lg-3 col-md-3 col-xs-12">E-mail</dt>
                                    <dd class="col-lg-9 col-sm-9">{{Auth::user()->mtamu->email}}</dd>
                                    <dt class="col-lg-3 col-md-3 col-xs-12">Telepon</dt>
                                    <dd class="col-lg-9 col-sm-9">{{Auth::user()->mtamu->telepon}}</dd>
                                    <dt class="col-lg-3 col-md-3 col-xs-12">Total kunjungan</dt>
                                    <dd class="col-lg-9 col-sm-9">{{Auth::user()->mtamu->total_kunjungan}}</dd>
                                </dl>
                            @endif


            </div>
        </div>
    </div>
    <!---batas kolom kiri--->
    <!---kolom kanan -->
    <div class="col-lg-6 col-sm-6 col-xs-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Menu Profil</h4>
                <div class="col-lg-12 col-md-12 col-xs-12 m-t-30">
                    <button class="btn btn-rounded btn-sm btn-success" id="EditProfilTombol" data-id="{{Auth::user()->id}}" data-nama="{{Auth::user()->name}}"><i class="fas fa-pencil-alt" data-toggle="tooltip" title="Edit Data"></i> EDIT</button>
                    <button class="btn btn-rounded btn-sm btn-danger" id="GantiPasswdTombol" data-id="{{Auth::user()->id}}" data-nama="{{Auth::user()->name}}"><i class="fas fa-key" data-toggle="tooltip" title="Ganti Password"></i> GANTI PASSWORD</button>
                    <button class="btn btn-rounded btn-sm btn-warning" id="EditPhotoTombol" data-id="{{Auth::user()->id}}" data-nama="{{Auth::user()->name}}"><i class="fas fa-pencil-alt" data-toggle="tooltip" title="Edit Photo Profil"></i> Edit Photo</button>
                </div>
                <div class="m-t-10">
                    <center id="pesanerror">
                        <div class="alert alert-success m-5"><span id="tekserror"></span></div>
                    </center>
                    @include('member.form-gantipasswd')
                    @include('member.form-editprofil')
                </div>
            </div>
        </div>
    </div>
    <!--batas kolom kanan-->
</div>
@include('member.modal-profil')
@endsection

@section('css')
    <!-- Date picker plugins css -->
    <link href="{{asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--alerts CSS -->
    <link href="{{asset('assets/node_modules/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/node_modules/Magnific-Popup-master/dist/magnific-popup.css')}}" rel="stylesheet">

    <style type="text/css">
    #preloading, #pesanerror, #GantiPassword, #EditProfil
    {
        display: none;
    }
    .miring
    {
        font-style: italic;
    }
    .normal
    {
        font-style: normal;
    }
    </style>
@stop
@section('js')
    <script src="{{asset('dist/js/pages/jasny-bootstrap.js')}}"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="{{asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>

    <!-- Sweet-Alert  -->
    <script src="{{asset('assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
    <!-- Magnific popup JavaScript -->
    <script src="{{asset('assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup-init.js')}}"></script>
    @include('member.js-profil')
@stop

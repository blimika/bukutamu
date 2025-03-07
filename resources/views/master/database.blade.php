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
                <li class="breadcrumb-item active">Layanan Akses</li>
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
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                    <h4 class="card-title">Database sinkronisasi</h4>
                    Sinkronisasi data dari Bukutamu v2 ke sistem baru v3
                    <div class="row">
                    <div class="col-lg-8 col-xs-12">
                    <div class="table-responsive m-t-20">
                        <table id="dTabel" class="table table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Nama Tabel</th>
                                    <th>v2</th>
                                    <th>v3</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Pengunjung</td>
                                    <td>{{$pengunjung_lama}}</td>
                                    <td>{{$pengunjung_baru}}</td>
                                </tr>
                                <tr>
                                    <td>Kunjungan</td>
                                    <td>{{$kunjungan_lama}}</td>
                                    <td>{{$kunjungan_baru}}</td>
                                </tr>
                                <tr>
                                    <td>Ruang Tunggu</td>
                                    <td></td>
                                    <td>{{$kunjungan_antrian}}</td>
                                </tr>
                                <tr>
                                    <td>Feedback</td>
                                    <td></td>
                                    <td>{{$kunjungan_feedback}}</td>
                                </tr>
                                <tr>
                                    <td>Layanan PST (0)</td>
                                    <td></td>
                                    <td>{{$kunjungan_pst}}</td>
                                </tr>
                                <tr>
                                    <td>Kantor Lainnya (Penawaran)</td>
                                    <td></td>
                                    <td>{{$kunjungan_kantor}}</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right">
                                        <a href="{{route('database.antrian')}}" class="btn btn-danger">ANTRIAN</a>
                                        <a href="{{route('database.sinkron')}}" class="btn btn-info">KUNJUNGAN</a>
                                        <a href="{{route('database.feedback')}}" class="btn btn-success">FEEDBACK</a>
                                        <a href="{{route('database.pst')}}" class="btn btn-warning">PST</a>
                                        <a href="{{route('database.kantor')}}" class="btn btn-dark">KANTOR</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    </div>

                    </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
    <!-- Date picker plugins css -->
    <link href="{{asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--alerts CSS -->
    <link href="{{asset('assets/node_modules/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/node_modules/Magnific-Popup-master/dist/magnific-popup.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css')}}">
@stop
@section('js')
    <script src="{{asset('dist/js/pages/jasny-bootstrap.js')}}"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="{{asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <!-- This is data table -->
    <script src="{{asset('assets/node_modules/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js')}}"></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->

    <!-- Sweet-Alert  -->
    <script src="{{asset('assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
     <!-- Magnific popup JavaScript -->
     <script src="{{asset('assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup.min.js')}}"></script>
     <script src="{{asset('assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup-init.js')}}"></script>
@stop

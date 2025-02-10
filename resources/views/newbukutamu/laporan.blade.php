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
                    <li class="breadcrumb-item active">Tamu List</li>
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
                    {{ Session::get('message') }}</div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        Laporan Kunjungan dan Pengunjung Perbulan Tahun {{$tahun}}
                    </h4>
                    <center id="preloading">
                        <button class="btn btn-success" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading, Memproses data kunjungan...
                        </button>
                    </center>
                    <center id="pesanerror">
                        <div class="alert alert-success m-5"><span id="tekserror"></span></div>
                    </center>
                    <div class="table-responsive m-t-10">
                        <table id="dTabel" class="display table table-hover table-striped table-bordered" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr class="text-center">
                                    <th rowspan="2">#</th>
                                    <th rowspan="2">Bulan</th>
                                    <th rowspan="2">Kunjungan</th>
                                    <th colspan="3">Pengunjung</th>
                                </tr>
                                <tr class="text-center">
                                    <th>Laki-laki</th>
                                    <th>Perempuan</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td class="text-center">{{$loop->iteration}}</td>
                                        <td>{{$item->nama_bulan}}</td>
                                        <td class="text-right">{{$item->jumlah_kunjungan}}</td>
                                        <td class="text-right">{{$item->jumlah_laki}}</td>
                                        <td class="text-right">{{$item->jumlah_wanita}}</td>
                                        <td class="text-right">{{$item->jumlah_total}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2" class="text-center">Total</td>
                                    <td class="text-right">{{$data->sum('jumlah_kunjungan')}}</td>
                                    <td class="text-right">{{$data->sum('jumlah_laki')}}</td>
                                    <td class="text-right">{{$data->sum('jumlah_wanita')}}</td>
                                    <td class="text-right">{{$data->sum('jumlah_total')}}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <!-- Date picker plugins css -->
    <link href="{{ asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet"
        type="text/css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--alerts CSS -->
    <link href="{{ asset('assets/node_modules/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/node_modules/Magnific-Popup-master/dist/magnific-popup.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css') }}">
    <style type="text/css">
        #preloading,
        #pesanerror {
            display: none;
        }
    </style>
@stop
@section('js')
    <script src="{{ asset('dist/js/pages/jasny-bootstrap.js') }}"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="{{ asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <!-- This is data table -->
    <script src="{{ asset('assets/node_modules/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js') }}"></script>
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
    <script src="{{ asset('assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
    <!-- Magnific popup JavaScript -->
    <script src="{{ asset('assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup-init.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dTabel').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy','excel','print'
                ],
                responsive: true,
                "displayLength": 30,

            });
            $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-info btn-rounded');
        });
    </script>
@stop

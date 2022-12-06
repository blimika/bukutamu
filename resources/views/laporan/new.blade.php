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
                <li class="breadcrumb-item active">Laporan</li>
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
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        @include('laporan.filter')
                    </div>
                </div>
                    <h4 class="card-title">Laporan pengunjung BPS Provinsi Nusa Tenggara Barat Tahun {{$tahun}}</h4>

                    <div class="table-responsive m-t-40 row">
                        <table id="dTabel" class="display table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="text-center bg-warning">No</th>
                                    <th rowspan="2" class="text-center bg-warning">Bulan</th>
                                    <th colspan="4" class="text-center bg-info">PST</th>
                                    <th colspan="4" class="text-center bg-success">Kantor</th>
                                    <th colspan="4" class="text-center bg-danger">Total</th>
                                </tr>
                                <tr>
                                    <th class="text-center bg-info">K</th>
                                    <th class="text-center bg-info">L</th>
                                    <th class="text-center bg-info">P</th>
                                    <th class="text-center bg-info">T</th>
                                    <th class="text-center bg-success">K</th>
                                    <th class="text-center bg-success">L</th>
                                    <th class="text-center bg-success">P</th>
                                    <th class="text-center bg-success">T</th>
                                    <th class="text-center bg-danger">K</th>
                                    <th class="text-center bg-danger">L</th>
                                    <th class="text-center bg-danger">P</th>
                                    <th class="text-center bg-danger">T</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($i = 0; $i < 12; $i++)
                                    <tr>
                                        <td class="text-center">{{$i+1}}</td>
                                        <td>{{$data_pst[$i]->nama_bulan}}</td>
                                        <td class="text-right">{{$data_pst[$i]->k_total}}</td>
                                        <td class="text-right">{{$data_pst[$i]->tamu_laki}}</td>
                                        <td class="text-right">{{$data_pst[$i]->tamu_wanita}}</td>
                                        <td class="text-right">{{$data_pst[$i]->jumlah_tamu}}</td>
                                        <td class="text-right">{{$data_kantor[$i]->k_total}}</td>
                                        <td class="text-right">{{$data_kantor[$i]->tamu_laki}}</td>
                                        <td class="text-right">{{$data_kantor[$i]->tamu_wanita}}</td>
                                        <td class="text-right">{{$data_kantor[$i]->jumlah_tamu}}</td>
                                        <td class="text-right">{{$data_total[$i]->k_total}}</td>
                                        <td class="text-right">{{$data_total[$i]->tamu_laki}}</td>
                                        <td class="text-right">{{$data_total[$i]->tamu_wanita}}</td>
                                        <td class="text-right">{{$data_total[$i]->jumlah_tamu}}</td>
                                    </tr>
                                @endfor
                            </tbody>
                            <tfoot>
                                <tr class="bg-dark text-white">
                                    <td colspan="2" class="text-center">Total</td>
                                    <td class="text-right">{{$data_pst->sum('k_total')}}</td>
                                    <td class="text-right">{{$data_pst->sum('tamu_laki')}}</td>
                                    <td class="text-right">{{$data_pst->sum('tamu_wanita')}}</td>
                                    <td class="text-right">{{$data_pst->sum('jumlah_tamu')}}</td>
                                    <td class="text-right">{{$data_kantor->sum('k_total')}}</td>
                                    <td class="text-right">{{$data_kantor->sum('tamu_laki')}}</td>
                                    <td class="text-right">{{$data_kantor->sum('tamu_wanita')}}</td>
                                    <td class="text-right">{{$data_kantor->sum('jumlah_tamu')}}</td>
                                    <td class="text-right">{{$data_total->sum('k_total')}}</td>
                                    <td class="text-right">{{$data_total->sum('tamu_laki')}}</td>
                                    <td class="text-right">{{$data_total->sum('tamu_wanita')}}</td>
                                    <td class="text-right">{{$data_total->sum('jumlah_tamu')}}</td>

                            </tr>
                                <tr>
                                    <th rowspan="2" class="text-center bg-warning">No</th>
                                    <th rowspan="2" class="text-center bg-warning">Bulan</th>
                                    <th class="text-center bg-info">k</th>
                                    <th class="text-center bg-info">L</th>
                                    <th class="text-center bg-info">P</th>
                                    <th class="text-center bg-info">T</th>
                                    <th class="text-center bg-success">K</th>
                                    <th class="text-center bg-success">L</th>
                                    <th class="text-center bg-success">P</th>
                                    <th class="text-center bg-success">T</th>
                                    <th class="text-center bg-danger">K</th>
                                    <th class="text-center bg-danger">L</th>
                                    <th class="text-center bg-danger">P</th>
                                    <th class="text-center bg-danger">T</th>
                                </tr>
                                <tr>
                                    <th colspan="4" class="text-center bg-info">PST</th>
                                    <th colspan="4" class="text-center bg-success">Kantor</th>
                                    <th colspan="4" class="text-center bg-danger">Total</th>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="text-danger">
                            Keterangan : <br />
                            K : Kunjungan <br />
                            L : Tamu Laki-laki <br />
                            P : Tamu Perempuan <br />
                            T : Total tamu
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
    <!-- Date picker plugins css -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--alerts CSS -->
    <link href="{{asset('assets/node_modules/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css')}}">
@stop
@section('js')
@include('js')
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
    <script>
        $(function () {
            $('#dTabel').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy','excel','print'
                ],
                responsive: true,
                "displayLength": 30,

            });
            $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
        });

    </script>
    <!-- Sweet-Alert  -->
    <script src="{{asset('assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
    <script>

    </script>
@stop

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
                    <h4 class="card-title">Laporan pengunjung BPS Provinsi Nusa Tenggara Barat</h4>
                    
                    <div class="table-responsive m-t-40">
                        <table id="dTabel" class="display table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr class="bg-info">
                                    <th rowspan="2" class="text-center">No</th>
                                    <th rowspan="2" class="text-center">Bulan</th>
                                    <th colspan="3" class="text-center">PST</th>
                                    <th colspan="3" class="text-center">Kantor</th>
                                </tr>
                                <tr class="bg-info">
                                    <th class="text-center">Laki-Laki</th>
                                    <th class="text-center">Perempuan</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Laki-Laki</th>
                                    <th class="text-center">Perempuan</th>
                                    <th class="text-center">Total</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th rowspan="2" class="text-center">No</th>
                                    <th rowspan="2" class="text-center">Bulan</th>
                                    <th class="text-center">Laki-Laki</th>
                                    <th class="text-center">Perempuan</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Laki-Laki</th>
                                    <th class="text-center">Perempuan</th>
                                    <th class="text-center">Total</th>
                                </tr>
                                <tr>
                                    
                                    <th colspan="3" class="text-center">PST</th>
                                    <th colspan="3" class="text-center">Kantor</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @php
                                 $laki =0;
                                 $wanita =0;
                                 $total =0; 
                                 $kntrlaki =0;
                                 $kntrwanita =0;
                                 $kntrtotal =0;  
                                @endphp
                                @for ($i = 1; $i <= 12; $i++)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$dataBulan[$i]}}</td>
                                        <td>{{$dataKunjungan[$i]['pst_laki']}}</td>
                                        <td>{{$dataKunjungan[$i]['pst_perempuan']}}</td>
                                        <td>{{$dataKunjungan[$i]['pst_total']}}</td>
                                        <td>{{$dataKunjungan[$i]['kntr_laki']}}</td>
                                        <td>{{$dataKunjungan[$i]['kntr_perempuan']}}</td>
                                        <td>{{$dataKunjungan[$i]['kntr_total']}}</td>
                                    </tr>
                                    @php
                                        $laki = $laki + $dataKunjungan[$i]['pst_laki'];
                                        $wanita = $wanita + $dataKunjungan[$i]['pst_perempuan'];
                                        $total = $total + $dataKunjungan[$i]['pst_total'];
                                        $kntrlaki = $kntrlaki + $dataKunjungan[$i]['kntr_laki'];
                                        $kntrwanita = $kntrwanita + $dataKunjungan[$i]['kntr_perempuan'];
                                        $kntrtotal = $kntrtotal + $dataKunjungan[$i]['kntr_total'];
                                    @endphp
                                @endfor
                                <tr>
                                   
                                    <td colspan="2">Total</td>
                                    <td>{{$laki}}</td>
                                    <td>{{$wanita}}</td>
                                    <td>{{$total}}</td>
                                    <td>{{$kntrlaki}}</td>
                                    <td>{{$kntrwanita}}</td>
                                    <td>{{$kntrtotal}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
    <!-- Date picker plugins css -->
    <link href="{{asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <style type="text/css">
        #PSTlayanan, #PSTmanfaat, #PSTlayanan_lama, #PSTmanfaat_lama, #PSTFasilitas, #PSTFasilitas_lama {
            display: none;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--alerts CSS -->
    <link href="{{asset('assets/node_modules/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">
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
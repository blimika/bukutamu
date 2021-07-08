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
                <li class="breadcrumb-item active">Master Pengunjung</li>
            </ol>
            <button type="button" class="btn btn-info d-none d-lg-block m-l-15" data-toggle="modal" data-target="#TambahModal"><i class="fa fa-plus-circle"></i> Tambah</button>
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
                    <h4 class="card-title">Data pengunjung BPS Provinsi Nusa Tenggara Barat</h4>

                    <div class="table-responsive m-t-40">
                        <table id="dTabel" class="display table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Photo</th>
                                    <th>Nama</th>
                                    <th>No Identitas</th>
                                    <th>JK</th>
                                    <th>Tgl Lahir</th>
                                    <th>Email</th>
                                    <th>Pekerjaan</th>
                                    @if (Auth::user())
                                    <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Photo</th>
                                    <th>Nama</th>
                                    <th>No Identitas</th>
                                    <th>JK</th>
                                    <th>Tgl Lahir</th>
                                    <th>Email</th>
                                    <th>Pekerjaan</th>
                                    @if (Auth::user())
                                    <th>Aksi</th>
                                    @endif
                                </tr>
                            </tfoot>
                            <tbody>
                                @if ($dataTamu->isEmpty())
                                    <tr>
                                        <td colspan="8" class="text-center"><b>Data pengunjung tidak tersedia</b></td>
                                    </tr>
                                @else
                                    @foreach ($dataTamu as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td> @if ($item->tamu_foto != NULL)
                                                <a class="image-popup-vertical-fit" href="{{asset('storage/'.$item->tamu_foto)}}">
                                                <img src="{{asset('storage/'.$item->tamu_foto)}}" class="img-circle" width="60" height="60" />
                                                @endif</td>
                                            <td>{{$item->nama_lengkap}}</td>
                                            <td>{{$item->nomor_identitas}}</td>
                                            <td>
                                                @if ($item->jk->inisial=='L')
                                                <span class="badge badge-info badge-pill">{{$item->jk->inisial}}</span>
                                                @else
                                                <span class="badge badge-danger badge-pill">{{$item->jk->inisial}}</span>
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($item->tgl_lahir)->isoFormat('D MMMM Y')}}</td>
                                            <td>{{$item->email}}</td>
                                            <td>{{$item->pekerjaan->nama}}</td>
                                            <td>
                                                <button class="btn btn-sm btn-info" data-id="{{$item->id}}" data-toggle="modal" data-target="#ViewModal"><i class="fas fa-search" data-toggle="tooltip" title="View Data {{$item->nama_lengkap}}"></i></button>
                                                <button class="btn btn-sm btn-danger hapuspengunjung" data-id="{{$item->id}}" data-nama="{{$item->nama_lengkap}}"><i class="fas fa-trash" class="fas fa-key" data-toggle="tooltip" title="Hapus Data Pengunjung {{$item->nama_lengkap}}"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
</div>
@include('master.modal')
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
    todayHighlight: true
}).on('show.bs.modal', function(event) {
    // prevent datepicker from firing bootstrap modal "show.bs.modal"
    event.stopPropagation();
});
    </script>
    @include('master.js')
@stop

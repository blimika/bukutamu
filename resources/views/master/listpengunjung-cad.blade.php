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
                                    <th>Kode</th>
                                    <th>JK</th>
                                    <th>Tgl Lahir</th>
                                    <th>Email</th>
                                    <th>Pekerjaan</th>
                                    <th>Jumlah Kunjungan</th>
                                    @if (Auth::user()->level > 1)
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
                                    <th>Kode</th>
                                    <th>JK</th>
                                    <th>Tgl Lahir</th>
                                    <th>Email</th>
                                    <th>Pekerjaan</th>
                                    <th>Jumlah Kunjungan</th>
                                    @if (Auth::user()->level > 1)
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
                                            <td>
                                                @if ($item->tamu_foto != NULL)
                                                    <a class="image-popup" href="{{asset('storage/'.$item->tamu_foto)}}" title="Nama : {{$item->nama_lengkap}}">
                                                        <img src="{{asset('storage/'.$item->tamu_foto)}}" class="img-circle" width="60" height="60" class="img-responsive" />
                                                    </a>
                                                @endif
                                            </td>
                                            <td>{{$item->nama_lengkap}}</td>
                                            <td>{{$item->nomor_identitas}}  <br /> ({{$item->identitas->nama}})</td>
                                            <td>{{$item->kode_qr}}</td>
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
                                            <td>{{$item->kunjungan->count()}}</td>
                                            @if (Auth::user()->level > 1)
                                            <td>
                                                <button class="btn btn-sm btn-info" data-id="{{$item->id}}" data-toggle="modal" data-target="#ViewModal"><i class="fas fa-search" data-toggle="tooltip" title="View Data {{$item->nama_lengkap}}"></i></button>
                                                <button class="btn btn-sm btn-danger hapuspengunjungmaster" data-id="{{$item->id}}" data-nama="{{$item->nama_lengkap}}"><i class="fas fa-trash" class="fas fa-key" data-toggle="tooltip" title="Hapus Data Pengunjung {{$item->nama_lengkap}}"></i></button>
                                            </td>
                                            @endif
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
@include('modal-view')
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

@include('master.js')
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
        $(document).ready(function() {
            var table = $('#dTabel').dataTable({
            aLengthMenu: [
                [1, 2],
                [1, 2]
            ],
            dom: 'Bfrtip',
            buttons: [
                'copy','excel','print'
            ],
            responsive: true,
            iDisplayLength: 30,
            "fnDrawCallback": function () {
                $('.image-popup').magnificPopup({
                type: 'image',
                closeOnContentClick: true,
                closeBtnInside: false,
                fixedContentPos: true,

                image: {
                    verticalFit: true
                },
                zoom: {
                    enabled: true,
                    duration: 300 // don't foget to change the duration also in CSS
                },

                });
                }
            });
            $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
            });
    </script>
    <!-- Sweet-Alert  -->
    <script src="{{asset('assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
     <!-- Magnific popup JavaScript -->
     <script src="{{asset('assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup.min.js')}}"></script>
     <script src="{{asset('assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup-init.js')}}"></script>
@stop

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
                <li class="breadcrumb-item active">Tamu Terjadwal</li>
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
                    <h4 class="card-title">Data Kunjungan Terjadwal BPS Provinsi Nusa Tenggara Barat</h4>
                    <center id="preloading">
                        <button class="btn btn-success" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading, Memproses data kunjungan...
                          </button>
                    </center>
                    <center id="pesanerror">
                        <div class="alert alert-success m-5"><span id="tekserror"></span></div>
                    </center>
                    <div class="table-responsive m-t-40 tabeldata">
                        <table id="dTabel" class="display table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Keperluan</th>
                                    <th>Tanggal</th>
                                    <th>Kode Kunjungan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                                @if ($data->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center"><b>Data pengunjung terjadwal tidak tersedia</b></td>
                                    </tr>
                                @else
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>
                                                <a href="#" class="text-info" data-kodeqr="{{$item->tamu->kode_qr}}" data-toggle="modal" data-target="#ViewModal">{{$item->tamu->nama_lengkap}}</a>
                                                <br />
                                                @if ($item->tamu->jk->inisial=='L')
                                                <span class="badge badge-info badge-pill">{{$item->tamu->jk->inisial}}</span>
                                                @else
                                                <span class="badge badge-danger badge-pill">{{$item->tamu->jk->inisial}}</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{$item->keperluan}}
                                                <p>
                                                    @if ($item->is_pst=='0')
                                                        <span class="badge badge-danger badge-pill">Kantor</span>
                                                        @else
                                                        <span class="badge badge-success badge-pill">PST</span>
                                                        @endif
    
                                                        @if($item->jenis_kunjungan == 1)
                                                        <span class="badge badge-info badge-pill">{{$item->jKunjungan->nama}}</span>
                                                        @else
                                                        <span class="badge badge-warning badge-pill">{{$item->jKunjungan->nama}}
                                                            ({{$item->jumlah_tamu}} org)
                                                        </span>
                                                        <span class="badge badge-info badge-pill">
                                                            L {{$item->tamu_m}}
                                                        </span>
                                                        <span class="badge badge-danger badge-pill">
                                                            P {{$item->tamu_f}}
                                                        </span>
                                                        @endif
                                                    </p>
                                            </td>
                                            <td>{{$item->tanggal}}</td>
                                            <td>{{$item->kode_kunjungan}}</td>
                                            <td>
                                                @if(Auth::user()->level > 10)
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="ti-settings"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item hapuskunjungan" href="javascript:void(0)" data-id="{{$item->id}}" data-nama="{{$item->tamu->nama_lengkap}}" data-toggle="tooltip" title="Hapus Kunjungan ini">Hapus</a>
                                                    </div>
                                                </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Keperluan</th>
                                    <th>Tanggal</th>
                                    <th>Kode Kunjungan</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>

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
    <style type="text/css">
    #preloading, #pesanerror
    {
        display: none;
    }
    </style>
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
    <script type="text/javascript">
        $(document).ready(function(){
            //script button
            $(".synckunjungan").click(function(e) {
                e.preventDefault();
                $('#preloading').toggle();
                $('.tabeldata').toggle();
                $.ajax({
                    url: "{{route('listpengunjung.sync')}}",
                    method : 'get',
                    cache: false,
                    dataType: 'json',
                    success: function(data) {
                        $('#preloading').toggle();
                        $('.tabeldata').toggle();
                        if (data.status == true)
                        {
                            $('#pesanerror').toggle();
                            $('#pesanerror #tekserror').text(data.pesan_error);
                            $('#dTabel').DataTable().ajax.reload(null,false);
                        }
                    },
                    error: function() {
                        $('#preloading').toggle();
                        $('.tabeldata').toggle();

                    }
                });
            });
          // DataTable
          $('#dTabel').DataTable({
            dom: 'Bfrtip',
            iDisplayLength: 30,
            buttons: [
                'copy','excel','print'
            ],
            order: [3,'desc'],
            responsive: true,
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
</script>

@stop

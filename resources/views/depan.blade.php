@section('css')
    <!-- page css -->
    <link href="{{asset('dist/css/pages/floating-label.css')}}" rel="stylesheet">
    <!-- Date picker plugins css -->
    <link href="{{asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <style type="text/css">
        #pst_terpilih {
            display: none;
        } 
        #pst_layanan, #pst_manfaat {
            display: none;
        }
    </style>
@stop
@section('js')
    <script src="{{asset('dist/js/pages/jasny-bootstrap.js')}}"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="{{asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <!-- This is data table -->
    <script src="{{asset('assets/node_modules/datatables/jquery.dataTables.min.js')}}"></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <!--<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>-->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->
    <script>
   $("#tgl_lahir").datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd',
    toggleActive: true,
    todayHighlight: true
}).on('show.bs.modal', function(event) {
    // prevent datepicker from firing bootstrap modal "show.bs.modal"
    event.stopPropagation();
});
$('#dTabel').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'print'
        ]
    });
    $("#pstcheck").change(function () {
        $("#pst_layanan").toggle();
        $("#pst_manfaat").toggle();
})
    </script>
@stop
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
                <li class="breadcrumb-item active">Bukutamu</li>
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
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                    <h4 class="card-title">Data pengunjung BPS Provinsi Nusa Tenggara Barat</h4>
                    <h6 class="card-subtitle">Tanggal 13 November 2019</h6>
                    <div class="m-t-10 m-b-10">
                    @if (Session::has('message'))
                    <div class="alert alert-{{ Session::get('message_type') }}" id="waktu2" style="margin-top:10px;">{{ Session::get('message') }}</div>
                    @endif
                    </div>
                    <div class="table-responsive m-t-40">
                        <table id="dTabel" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>No Identitas</th>
                                    <th>JK</th>
                                    <th>Alamat</th>
                                    <th>Umur</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>No Identitas</th>
                                    <th>JK</th>
                                    <th>Alamat</th>
                                    <th>Umur</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @if ($Kunjungan->isEmpty())
                                    <tr>
                                        <td colspan="6">Data pengunjung tidak tersedia</td>
                                    </tr>
                                @else
                                    @foreach ($Kunjungan as $item)
                                    <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->tamu->nama_lengkap}}</td>
                                            <td>{{$item->tamu->nomor_identitas}}</td>
                                            <td>{{$item->tamu->jk->inisial}}</td>
                                            <td>{{$item->tamu->alamat}} 
                                                @if ($item->ispst==1)
                                                    
                                                    
                                                @endif
                                            </td>
                                            <td>{{$item->tamu->tgl_lahir}}</td>
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
@include('modal-tambah')
@endsection

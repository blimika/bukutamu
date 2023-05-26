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
                    <h4 class="card-title">Data Layanan</h4>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <form class="form-horizontal">
                                <div class="form-group row">
                                  <label for="bulan" class="col-sm-1 control-label">Filter</label>

                                <div class="col-md-2">
                                      <select name="bulan" id="bulan" class="form-control">
                                       <option value="0">Semua Bulan</option>
                                       @for ($i = 1; $i <= 12; $i++)
                                           <option value="{{$i}}" @if (request('bulan')==$i or $bulan==$i)
                                               selected
                                           @endif>{{$dataBulan[$i]}}</option>
                                       @endfor
                                      </select>
                                  </div>
                                  <div class="col-md-2">
                                      <select name="tahun" id="tahun" class="form-control">
                                       @foreach ($dataTahun as $iTahun)
                                       <option value="{{$iTahun->tahun}}" @if (request('tahun')==$iTahun->tahun or $tahun==$iTahun->tahun)
                                       selected
                                      @endif>{{$iTahun->tahun}}</option>
                                       @endforeach
                                      </select>
                                  </div>

                                  <div class="col-md-2">
                                      <button type="submit" class="btn btn-success">Filter</button>
                                  </div>
                                  <div class="col-md-2">
                                    <a href="{{route('genlayanan.sync',$tahun)}}" class="btn btn-info">Sync Layanan</a>
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive m-t-40">
                        <table id="dTabel" class="display table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Tanggal</th>
                                    <th>Kunjungan_id</th>
                                    <th>Layanan_id</th>
                                    <th>Layanan_nama</th>
                                    <th>layanan_nama_new</th>
                                    <th>created_at</th>
                                    <th>update_at</th>
                                    <th>aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Tanggal</th>
                                    <th>Kunjungan_id</th>
                                    <th>Layanan_id</th>
                                    <th>Layanan_nama</th>
                                    <th>layanan_nama_new</th>
                                    <th>created_at</th>
                                    <th>update_at</th>
                                    <th>aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @if ($dataLayanan->isEmpty())
                                    <tr>
                                        <td colspan="8" class="text-center"><b>Data layanan tidak tersedia</b></td>
                                    </tr>
                                @else
                                    @foreach ($dataLayanan as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->Kunjungan->tamu->nama_lengkap}}</td>
                                            <td>{{$item->Kunjungan->tanggal}}</td>
                                            <td>{{$item->kunjungan_id}}</td>
                                            <td>{{$item->layanan_id}}</td>
                                            <td>{{$item->layanan_nama}}</td>
                                            <td>{{$item->layanan_nama_new}}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
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
@include('lama.modal-kunjungan')
@include('modal-view')
@include('modal-feedback')
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


@include('lama.js')
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

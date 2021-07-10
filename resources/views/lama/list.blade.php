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
            <!--<button type="button" class="btn btn-info d-none d-lg-block m-l-15" data-toggle="modal" data-target="#InputDataLamaModal"><i class="fa fa-plus-circle"></i> Tambah</button>-->
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
            @if (Session::has('message_header'))
            <h4 class="alert-heading">{!! Session::get('message_header') !!}</h4>
            @endif
            {!! Session::get('message') !!}
        </div>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            @include('lama.filter')
                        </div>
                    </div>
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
                                    <th>Alamat</th>
                                    <th>Keperluan/Data dicari</th>
                                    <th>Umur</th>
                                    <th>Tamu</th>
                                    <th>Feedback</th>
                                    <th>Waktu Kunjungan</th>
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
                                    <th>Alamat</th>
                                    <th>Keperluan/Data dicari</th>
                                    <th>Umur</th>
                                    <th>Tamu</th>
                                    <th>Feedback</th>
                                    <th>Waktu Kunjungan</th>
                                    @if (Auth::user())
                                    <th>Aksi</th>
                                    @endif
                                </tr>
                            </tfoot>
                            <tbody>
                                @if ($Kunjungan->isEmpty())
                                    <tr>
                                        <td colspan="11" class="text-center"><b>Data pengunjung tidak tersedia</b></td>
                                    </tr>
                                @else
                                    @foreach ($Kunjungan as $item)
                                    <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>
                                                @if ($item->file_foto != NULL)
                                                <a class="image-popup" href="{{asset('storage/'.$item->file_foto)}}" title="Nama : {{$item->tamu->nama_lengkap}}">
                                                    <img src="{{asset('storage/'.$item->file_foto)}}" class="img-circle" width="60" height="60" />
                                                </a>
                                                @endif
                                            </td>
                                            <td><a href="#" class="text-info" data-id="{{$item->tamu_id}}" data-toggle="modal" data-target="#ViewModal">{{$item->tamu->nama_lengkap}}</a></td>
                                            <td>{{$item->tamu->nomor_identitas}}</td>
                                            <td>
                                                @if ($item->tamu->jk->inisial=='L')
                                                <span class="badge badge-info badge-pill">{{$item->tamu->jk->inisial}}</span>
                                                @else
                                                <span class="badge badge-danger badge-pill">{{$item->tamu->jk->inisial}}</span>
                                                @endif
                                            </td>
                                            <td>{{$item->tamu->alamat}} </td>
                                            <td>{{$item->keperluan}}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->tamu->tgl_lahir)->age}}</td>
                                            <td class="text-center">
                                                    @if ($item->is_pst=='0')
                                                    <span class="badge badge-danger badge-pill">Kantor</span>
                                                    @else
                                                    <span class="badge badge-success badge-pill">PST</span>
                                                    @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($item->f_feedback==1)
                                                <button type="button" class="btn waves-effect waves-light btn-rounded btn-sm btn-danger" data-tamuid="{{$item->tamu_id}}" data-toggle="modal" data-target="#FeedbackModal" data-kunjunganid="{{$item->id}}" >Feedback</button>
                                                @else
                                                <button type="button" class="btn btn-circle btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="{{$item->tamu->nama_lengkap}} sudah memberikan feedback"><i class="fas fa-check"></i></button>
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->isoFormat('dddd, D MMMM Y')}}</td>
                                            @if (Auth::user())
                                            <td>
                                                <button class="btn btn-sm btn-info ubahpstkantor" data-id="{{$item->id}}" data-nama="{{$item->tamu->nama_lengkap}}" data-ispst="{{$item->is_pst}}"><i class="fas fa-clipboard" data-toggle="tooltip" title="Ubah Status Kunjungan Ke @if ($item->is_pst == 0) PST @else Kantor @endif"></i></button>
                                                <button class="btn btn-sm btn-danger hapuskunjungan" data-id="{{$item->id}}" data-nama="{{$item->tamu->nama_lengkap}}"><i class="fas fa-trash" data-toggle="tooltip" title="Hapus Kunjungan ini"></i></button></td>
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
@include('modal-tambah')
@include('lama.modal')
@endsection

@section('css')
    <!-- Date picker plugins css -->
    <link href="{{asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <style type="text/css">
        #PSTlayanan, #PSTmanfaat, #PSTFasilitas, #PSTlayanan_lama, #PSTmanfaat_lama, #PSTFasilitas_lama, #canvas  {
            display: none;
        }
        .starrating > input {display: none;}  /* Remove radio buttons */
        .starrating > label:before {
        content: "\f005"; /* Star */
        margin: 2px;
        font-size: 4em;
        font-family: FontAwesome;
        display: inline-block;
        }
        .starrating > label
        {
        color: #222222; /* Start color when not clicked */
        }

        .starrating > input:checked ~ label
        { color: #ffca08 ; } /* Set yellow color when star checked */
        .starrating > input:hover ~ label
        { color: #ffca08 ;  } /* Set yellow color when star hover */
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
    <script src="{{asset('dist/js/pages/jasny-bootstrap.js')}}"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="{{asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <!-- This is data table -->
    <script src="{{asset('assets/node_modules/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js')}}"></script>
    <!-- Sweet-Alert  -->
    <script src="{{asset('assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->
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
/
    </script>
@include('lama.js')
@stop

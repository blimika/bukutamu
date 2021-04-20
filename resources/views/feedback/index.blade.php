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
        <div class="alert alert-{{ Session::get('message_type') }}" id="waktu2" style="margin-top:10px;">
            {!! Session::get('message') !!}
        </div>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Feedback Pengunjung BPS Provinsi Nusa Tenggara Barat</h4>
                <div class="row">
                    <div class="col-lg-3 col-md-12 border-right p-l-0">
                        <center class="m-t-30 m-b-40 p-t-20 p-b-20">
                            <font class="display-3">{{number_format($dataFeedback->average('feedback_nilai'),2, '.', '')}}</font>
                            <div class="m-b-10">
                                {{--Start Rating--}}
                                @for ($i = 0; $i < 6; $i++)
                                @if (floor($dataFeedback->average('feedback_nilai')) - $i >= 1)
                                    {{--Full Start--}}
                                    <i class="fa fa-star text-warning"> </i>
                                @elseif ($dataFeedback->average('feedback_nilai') - $i > 0)
                                    {{--Half Start--}}
                                    <i class="fas fa-star-half-alt text-warning"></i>
                                @else
                                    {{--Empty Start--}}
                                    <i class="far fa-star text-warning"> </i>
                                @endif
                                @endfor
                                {{--End Rating--}}
                            </div>
                            <h6 class="text-muted"><i class="fas fa-user"></i> {{$dataFeedback->count()}} total</h6>

                        </center>
                        <hr>
                    </div>
                    <div class="col-9">
                        <div class="row">
                            <div class="col-lg-1 col-md-2">
                                <span class="float-right">
                                    6 <span class="fa fa-star text-warning"></span>
                                </span>
                            </div>
                            <div class="col-lg-11 col-md-10">
                                <div class="progress ">
                                    <div class="progress-bar bg-success wow animated progress-animated" style="width: {{number_format(($dataFeedback->where('feedback_nilai','6')->count()/$dataFeedback->count())*100,2,".",",")}}%; height:20px;" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-10">
                            <div class="col-lg-1 col-md-2">
                                <span class="float-right">
                                    5 <span class="fa fa-star text-warning"></span>
                                </span>
                            </div>
                            <div class="col-lg-11 col-md-10">
                                <div class="progress ">
                                    <div class="progress-bar bg-info wow animated progress-animated" style="width: {{number_format(($dataFeedback->where('feedback_nilai','5')->count()/$dataFeedback->count())*100,2,".",",")}}%; height:20px;" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-10">
                            <div class="col-lg-1 col-md-2">
                                <span class="float-right">
                                    4 <span class="fa fa-star text-warning"></span>
                                </span>
                            </div>
                            <div class="col-lg-11 col-md-10">
                                <div class="progress ">
                                    <div class="progress-bar bg-warning wow animated progress-animated" style="width: {{number_format(($dataFeedback->where('feedback_nilai','4')->count()/$dataFeedback->count())*100,2,".",",")}}%; height:20px;" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-10">
                            <div class="col-lg-1 col-md-2">
                                <span class="float-right">
                                    3 <span class="fa fa-star text-warning"></span>
                                </span>
                            </div>
                            <div class="col-lg-11 col-md-10">
                                <div class="progress ">
                                    <div class="progress-bar bg-primary wow animated progress-animated" style="width: {{number_format(($dataFeedback->where('feedback_nilai','3')->count()/$dataFeedback->count())*100,2,".",",")}}%; height:20px;" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-10">
                            <div class="col-lg-1 col-md-2">
                                <span class="float-right">
                                    2 <span class="fa fa-star text-warning"></span>
                                </span>
                            </div>
                            <div class="col-lg-11 col-md-10">
                                <div class="progress ">
                                    <div class="progress-bar bg-inverse wow animated progress-animated" style="width: {{number_format(($dataFeedback->where('feedback_nilai','2')->count()/$dataFeedback->count())*100,2,".",",")}}%; height:20px;" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-10">
                            <div class="col-lg-1 col-md-2">
                                <span class="float-right">
                                    1 <span class="fa fa-star text-warning"></span>
                                </span>
                            </div>
                            <div class="col-lg-11 col-md-10">
                                <div class="progress ">
                                    <div class="progress-bar bg-danger wow animated progress-animated" style="width: {{number_format(($dataFeedback->where('feedback_nilai','1')->count()/$dataFeedback->count())*100,2,".",",")}}%; height:20px;" role="progressbar" aria-valuenow="0%" aria-valuemin="0%" aria-valuemax="100%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if (Auth::user())
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        @foreach ($dataNamaFeedback as $item)
                            <div class="m-t-10">
                                <h5><strong>{{$item->Kunjungan->tamu->nama_lengkap}}</strong></h5>
                                @for ($i = 1; $i < 7; $i++)
                                    @if ($i <= $item->feedback_nilai)
                                        <span class="fa fa-star text-warning"></span>
                                    @else
                                        <span class="fa fa-star"></span>
                                    @endif
                                @endfor
                                <span class="text-muted"><i>{{\Carbon\Carbon::parse($item->feedback_tanggal)->isoFormat('D MMMM Y')}}</i></span>
                                <div class="m-t-10">
                                    @if ($item->imbalan_nilai == 2)
                                        <i><b class="text-success">Tidak ada</b> pemberian imbalan</i>
                                    @else
                                    <i><b class="text-danger">Ada</b> pemberian imbalan</i>
                                    @endif
                                    <br />
                                    @if ($item->pungli_nilai == 2)
                                        <i><b class="text-success">Tidak ada</b> pungli</i>
                                    @else
                                    <i><b class="text-danger">Ada</b> pungli</i>
                                    @endif
                                    <br />{{$item->feedback_komentar}}
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                    <div class="col-8">
                        {{$dataNamaFeedback->links()}}
                    </div>
                </div>
                @endif
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
        #PSTlayanan, #PSTmanfaat, #PSTlayanan_lama, #PSTmanfaat_lama, #PSTFasilitas, #PSTFasilitas_lama {
            display: none;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--alerts CSS -->
    <link href="{{asset('assets/node_modules/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css')}}">
    <link href="{{asset('dist/css/pages/progressbar-page.css')}}" rel="stylesheet">
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

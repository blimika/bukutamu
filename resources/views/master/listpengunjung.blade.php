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
            <a href="javascript:void(0)" class="btn btn-info d-lg-block m-l-15 synckunjungan"><i class="fas fa-sync"></i> Sync Kunjungan</a>
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
                                    <th>Photo</th>
                                    <th>Nama</th>
                                    <th>No Identitas</th>
                                    <th>JK</th>
                                    <th>Tgl Lahir</th>
                                    <th>Email</th>
                                    <th>Pekerjaan</th>
                                    <th>Jumlah Kunjungan</th>
                                    @if (Auth::user()->level > 1)
                                    <th>User ID</th>
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
                                    <th>Jumlah Kunjungan</th>
                                    @if (Auth::user()->level > 1)
                                    <th>User ID</th>
                                    <th>Aksi</th>
                                    @endif
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
@include('master.modal-edit')
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
@include('master.js-edit')
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
             processing: true,
             serverSide: true,
             ajax: "{{route('pengunjung.page')}}",
             columns: [
                { data: 'id' },
                { data: 'tamu_foto', orderable: false },
                { data: 'nama_lengkap' },
                { data: 'nomor_identitas' },
                { data: 'id_jk' },
                { data: 'tgl_lahir' },
                { data: 'email' },
                { data: 'id_mkerja' },
                { data: 'total_kunjungan' },
                { data: 'user_id' },
                { data: 'aksi', orderable: false },
             ],
            dom: 'Bfrtip',
            iDisplayLength: 30,
            buttons: [
                'copy','excel','print'
            ],
            order: [0,'desc'],
            responsive: true,
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
                //hapus tamu
                $(".hapuspengunjungmaster").click(function (e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    var nama = $(this).data('nama');
                    Swal.fire({
                                title: 'Akan dihapus?',
                                text: "Data pengunjung "+nama+" akan dihapus permanen",
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Hapus'
                            }).then((result) => {
                                if (result.value) {
                                    //response ajax disini
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });
                                    $.ajax({
                                        url : '{{route('pengunjung.hapus')}}',
                                        method : 'post',
                                        data: {
                                            id: id
                                        },
                                        cache: false,
                                        dataType: 'json',
                                        success: function(data){
                                            if (data.status == true)
                                            {
                                                Swal.fire(
                                                    'Berhasil!',
                                                    ''+data.hasil+'',
                                                    'success'
                                                ).then(function() {
                                                    $('#dTabel').DataTable().ajax.reload(null,false);
                                                });
                                            }
                                            else
                                            {
                                                Swal.fire(
                                                    'Error!',
                                                    ''+data.hasil+'',
                                                    'danger'
                                                );
                                            }

                                        },
                                        error: function(){
                                            Swal.fire(
                                                'Error',
                                                'Koneksi Error',
                                                'danger'
                                            );
                                        }

                                    });

                                }
                            })
                });
                //batas hapus
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
@include('js')
@stop

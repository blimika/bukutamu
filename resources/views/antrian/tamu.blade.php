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
                <li class="breadcrumb-item active">Tamu List</li>
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
                    <h4 class="card-title">Data Kunjungan BPS Provinsi Nusa Tenggara Barat</h4>
                    <div class="table-responsive m-t-40">
                        <table id="dTabel" class="display table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Photo</th>
                                    <th>Nama</th>
                                    <th>Keperluan</th>
                                    <th>Tanggal</th>
                                    <th>Layanan</th>
                                    <th>Nomor Antrian</th>
                                    <th>Mulai</th>
                                    <th>Akhir</th>
                                    <th>Petugas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Photo</th>
                                    <th>Nama</th>
                                    <th>Keperluan</th>
                                    <th>Tanggal</th>
                                    <th>Layanan</th>
                                    <th>Nomor Antrian</th>
                                    <th>Mulai</th>
                                    <th>Akhir</th>
                                    <th>Petugas</th>
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
          // DataTable
          $('#dTabel').DataTable({
             processing: true,
             serverSide: true,
             ajax: "{{route('tamu.antrianlist')}}",
             columns: [
                { data: 'id' },
                { data: 'photo', orderable: false  },
                { data: 'nama_lengkap' },
                { data: 'keperluan' },
                { data: 'tanggal' },
                { data: 'layanan' },
                { data: 'nomor_antrian' },
                { data: 'jam_datang' },
                { data: 'jam_pulang' },
                { data: 'petugas_id' },
                { data: 'aksi', orderable: false },
             ],
            dom: 'Bfrtip',
            iDisplayLength: 30,
            buttons: [
                'copy','excel','print'
            ],
            order: [3,'desc'],
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
            //mulai layanan klik
            $(".mulailayanan").click(function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var nama = $(this).data('nama');
                var tanggal = $(this).data('tanggal');
                Swal.fire({
                            title: 'Mulai layanan?',
                            text: "Data kunjungan "+nama+" tanggal "+tanggal+" akan mulai dilayani",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Mulai'
                        }).then((result) => {
                            if (result.value) {
                                //response ajax disini
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                $.ajax({
                                    url : '{{route('tamu.mulailayanan')}}',
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
            //batas mulai
            //mulai layanan klik
            $(".akhirlayanan").click(function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var nama = $(this).data('nama');
                var tanggal = $(this).data('tanggal');
                Swal.fire({
                            title: 'Akhir layanan?',
                            text: "Data kunjungan "+nama+" tanggal "+tanggal+" layanan akan diakhiri",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Akhiri'
                        }).then((result) => {
                            if (result.value) {
                                //response ajax disini
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                $.ajax({
                                    url : '{{route('tamu.akhirlayanan')}}',
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
            //batas mulai
                //hapus kunjungan depan
            $(".hapuskunjungantamu").click(function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var nama = $(this).data('nama');
                var tanggal = $(this).data('tanggal');
                Swal.fire({
                            title: 'Akan dihapus?',
                            text: "Data kunjungan "+nama+" tanggal "+tanggal+" akan dihapus permanen",
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
                                    url : '{{route('hapus.kunjungan')}}',
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

@stop

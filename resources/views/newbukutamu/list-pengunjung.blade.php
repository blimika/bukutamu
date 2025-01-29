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
                <div class="alert alert-{{ Session::get('message_type') }}" id="waktu2" style="margin-top:10px;">
                    {{ Session::get('message') }}</div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        Data Pengunjung BPS Provinsi Nusa Tenggara Barat
                    </h4>

                    <center id="pesanerror">
                        <div class="alert alert-success m-5"><span id="tekserror"></span></div>
                    </center>
                    <div class="table-responsive m-t-40">
                        <table id="dTabel" class="tabeldata display table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>UID</th>
                                    <th>Nama</th>
                                    <th>Nomor HP</th>
                                    <th>Tahun Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Pekerjaan</th>
                                    <th>Pendidikan</th>
                                    <th>Total Kunjungan</th>
                                    <th>Alamat</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>UID</th>
                                    <th>Nama</th>
                                    <th>Nomor HP</th>
                                    <th>Tahun Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Pekerjaan</th>
                                    <th>Pendidikan</th>
                                    <th>Total Kunjungan</th>
                                    <th>Alamat</th>
                                    <th>Email</th>
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
    @include('newbukutamu.modal-pengunjung')
@endsection

@section('css')
    <!-- Date picker plugins css -->
    <link href="{{ asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet"
        type="text/css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--alerts CSS -->
    <link href="{{ asset('assets/node_modules/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/node_modules/Magnific-Popup-master/dist/magnific-popup.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css') }}">
    <style type="text/css">
        #preloading,
        #pesanerror {
            display: none;
        }
    </style>
@stop
@section('js')
    <script src="{{ asset('dist/js/pages/jasny-bootstrap.js') }}"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="{{ asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <!-- This is data table -->
    <script src="{{ asset('assets/node_modules/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js') }}"></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->

    <!-- Sweet-Alert  -->
    <script src="{{ asset('assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
    <!-- Magnific popup JavaScript -->
    <script src="{{ asset('assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup-init.js') }}"></script>
    <script>
        $(document).ready(function() {
            // DataTable
            $('#dTabel').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('pengunjung.pagelist') }}",
                columns: [
                    {data: 'pengunjung_uid'},
                    {data: 'pengunjung_nama'},
                    {data: 'pengunjung_nomor_hp'},
                    {data: 'pengunjung_tahun_lahir'},
                    {data: 'pengunjung_jk'},
                    {data: 'pengunjung_pekerjaan'},
                    {data: 'pengunjung_pendidikan'},
                    {data: 'pengunjung_total_kunjungan'},
                    {data: 'pengunjung_alamat'},
                    {data: 'pengunjung_email'},
                    {data: 'aksi',orderable: false},
                ],
                dom: 'Bfrtip',
                iDisplayLength: 20,
                buttons: [
                    'copy', 'excel', 'print'
                ],
                responsive: true,
                "fnDrawCallback": function() {
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
                    $('.tabeldata').on('click','.hapuspengunjung',function(e) {
                        e.preventDefault();
                        var id = $(this).data('id');
                        var nama = $(this).data('nama');
                        Swal.fire({
                            title: 'Akan dihapus?',
                            text: "Data pengunjung " + nama + " akan dihapus permanen",
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
                                        'X-CSRF-TOKEN': $(
                                            'meta[name="csrf-token"]').attr(
                                            'content')
                                    }
                                });
                                $.ajax({
                                    url: '{{ route('pengunjung.hapus') }}',
                                    method: 'post',
                                    data: {
                                        id: id
                                    },
                                    cache: false,
                                    dataType: 'json',
                                    success: function(data) {
                                        if (data.status == true) {
                                            Swal.fire(
                                                'Berhasil!',
                                                '' + data.hasil + '',
                                                'success'
                                            ).then(function() {
                                                $('#dTabel')
                                                    .DataTable()
                                                    .ajax.reload(
                                                        null, false
                                                    );
                                            });
                                        } else {
                                            Swal.fire(
                                                'Error!',
                                                '' + data.hasil + '',
                                                'danger'
                                            );
                                        }

                                    },
                                    error: function() {
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
@stop

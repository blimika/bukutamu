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
                    <li class="breadcrumb-item active">Kunjungan List</li>
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
                        Data Kunjungan BPS Provinsi Nusa Tenggara Barat
                    </h4>
                    <!--form upload jadwal petugas-->
                    <div class="row">
                        <div class="col-lg-8">
                            Petugas PST Hari {{Tanggal::HariPanjang(\Carbon\Carbon::now())}} :
                            <br />
                            <span class="badge badge-success">
                                @if ($PetugasJaga->petugas1_id > 0)
                                    {{$PetugasJaga->Petugas1->name}}
                                @else
                                    -
                                @endif
                            </span>
                            <span class="badge badge-info">
                                @if ($PetugasJaga->petugas2_id > 0)
                                    {{$PetugasJaga->Petugas2->name}}
                                @else
                                    -
                                @endif
                            </span>
                        </div>
                        <div class="col-lg-4 text-right">
                            @if (Auth::User()->level > 10)
                                <a href="{{ route('wa.format') }}" class="btn btn-info">
                                    <i class="ti-export"></i> &nbsp;Format Import</a>
                                <a href="javascript:void(0)" class="btn btn-success m-l-15" data-toggle="modal"
                                    data-target="#ImportDataWhatsapp"><i class="ti-import"></i> Import Data</a>
                            @endif
                        </div>
                    </div>

                    <!--batas-->
                    <center id="preloading">
                        <button class="btn btn-success" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading, Memproses data kunjungan...
                        </button>
                    </center>
                    <center id="pesanerror">
                        <div class="alert alert-success m-5"><span id="tekserror"></span></div>
                    </center>
                    <div class="m-t-40">
                        <table id="dTabel" class="tabeldata display table table-hover table-striped table-bordered table-responsive" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <th>UID</th>
                                    <th>Nama</th>
                                    <th>Tanggal</th>
                                    <th>Keperluan</th>
                                    <th>Tindak Lanjut</th>
                                    <th>Antrian</th>
                                    <th>Mulai</th>
                                    <th>Akhir</th>
                                    <th>Petugas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('newbukutamu.modal-kunjungan')
    @include('newbukutamu.modal-feedback')
    @include('newbukutamu.modal-tindaklanjut')
    @include('newbukutamu.modal-tujuan')
    @include('newbukutamu.modal-jenis')
    @include('newbukutamu.modal-whatsapp')
    @include('newbukutamu.modal-petugas')
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
    <link href="{{asset('assets/node_modules/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <style type="text/css">
        #preloading,
        #pesanerror,
        #moreTeks {
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
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->
    <!---moment.js url--->
    <script src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>
    <!-- Sweet-Alert  -->
    <script src="{{asset('assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
    <!-- Magnific popup JavaScript -->
    <script src="{{asset('assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{asset('assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup-init.js') }}"></script>
    <script src="{{asset('assets/node_modules/select2/dist/js/select2.full.min.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            // DataTable
            $('#dTabel').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('kunjungan.pagelist') }}",
                columns: [
                    {data: 'kunjungan_uid',orderable: false},
                    {data: 'pengunjung_nama'},
                    {data: 'kunjungan_tanggal'},
                    {data: 'kunjungan_keperluan'},
                    {data: 'kunjungan_tindak_lanjut'},
                    {data: 'kunjungan_teks_antrian'},
                    {data: 'kunjungan_jam_datang'},
                    {data: 'kunjungan_jam_pulang'},
                    {data: 'kunjungan_petugas_id'},
                    {data: 'aksi',orderable: false},
                ],
                order: [2,'desc'],
                dom: 'Bfrtip',
                iDisplayLength: 20,
                buttons: [
                    'copy', 'excel', 'print'
                ],
                responsive: false,
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
                    $('.tabeldata').on('click','.kirimnomorantrian',function(e) {
                        e.preventDefault();
                        var uid = $(this).data('uid');
                        var id = $(this).data('id');
                        var nama = $(this).data('nama');
                        var email = $(this).data('email');
                        Swal.fire({
                            title: 'Kirim nomor antrian?',
                            text: "Nomor Antrian an. " + nama +
                                " dikirim ke alamat email " + email +
                                " sekarang?",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Kirim'
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
                                    url: '{{ route("kunjungan.kirimnomor") }}',
                                    method: 'post',
                                    data: {
                                        uid: uid,
                                        id: id,
                                        nama: nama,
                                        email: email
                                    },
                                    cache: false,
                                    dataType: 'json',
                                    success: function(data) {
                                        if (data.status == true) {
                                            Swal.fire(
                                                'Berhasil!',
                                                '' + data.message + '',
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
                                                '' + data.message + '',
                                                'error'
                                            );
                                        }

                                    },
                                    error: function() {
                                        Swal.fire(
                                            'Error',
                                            'Koneksi Error',
                                            'error'
                                        );
                                    }

                                });

                            }
                        })
                    });
                    $('.tabeldata').on('click','.mulailayanan',function(e) {
                        e.preventDefault();
                        var id = $(this).data('id');
                        var uid = $(this).data('uid');
                        var nama = $(this).data('nama');
                        var tanggal = $(this).data('tanggal');
                        Swal.fire({
                            title: 'Mulai layanan?',
                            text: "Data kunjungan " + nama + " tanggal " + tanggal +
                                " akan mulai dilayani",
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
                                        'X-CSRF-TOKEN': $(
                                            'meta[name="csrf-token"]').attr(
                                            'content')
                                    }
                                });
                                $.ajax({
                                    url: '{{ route("kunjungan.mulai") }}',
                                    method: 'post',
                                    data: {
                                        id: id,
                                        uid: uid,
                                        nama: nama,
                                        tanggal: tanggal
                                    },
                                    cache: false,
                                    dataType: 'json',
                                    success: function(data) {
                                        if (data.status == true) {
                                            Swal.fire(
                                                'Berhasil!',
                                                '' + data.message + '',
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
                                                '' + data.message + '',
                                                'error'
                                            );
                                        }

                                    },
                                    error: function() {
                                        Swal.fire(
                                            'Error',
                                            'Koneksi Error',
                                            'error'
                                        );
                                    }

                                });

                            }
                        })
                    });
                    //batas mulai
                    //mulai layanan klik
                    $('.tabeldata').on('click','.akhirlayanan',function(e) {
                        e.preventDefault();
                        var id = $(this).data('id');
                        var uid = $(this).data('uid');
                        var nama = $(this).data('nama');
                        var tanggal = $(this).data('tanggal');
                        Swal.fire({
                            title: 'Akhir layanan?',
                            text: "Data kunjungan " + nama + " tanggal " + tanggal +
                                " layanan akan diakhiri",
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
                                    url: '{{ route("kunjungan.akhir") }}',
                                    method: 'post',
                                    data: {
                                        id: id,
                                        uid: uid,
                                        nama: nama,
                                        tanggal: tanggal
                                    },
                                    cache: false,
                                    dataType: 'json',
                                    success: function(data) {
                                        if (data.status == true) {
                                            Swal.fire(
                                                'Berhasil!',
                                                '' + data.message + '',
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
                                                '' + data.message + '',
                                                'error'
                                            );
                                        }

                                    },
                                    error: function() {
                                        Swal.fire(
                                            'Error',
                                            'Koneksi Error',
                                            'error'
                                        );
                                    }

                                });

                            }
                        })
                    });
                    //batas mulai
                    //klik more
                    $('.tabeldata').on('click','.btnMore',function(e) {
                        let td = $(this).closest('td');
                        let display =  td.children('#dots').css("display");
                        if (display == "none") {
                            td.children("#dots").show();
                            td.children('.btnMore').text('more');
                            td.children('.btnMore').removeClass("btn-danger").addClass("btn-info");
                            td.children("#moreTeks").hide();
                        }
                        else {
                            td.children("#dots").hide();
                            td.children('.btnMore').text('less');
                            td.children('.btnMore').removeClass("btn-info").addClass("btn-danger");
                            td.children("#moreTeks").show();
                        }
                        e.stopImmediatePropagation();
                    });
                    //hapus kunjungan
                    //copy link feedback
                    $('.tabeldata').on('click','.copyurlfeedback',function(e) {
                        e.preventDefault();

                        var copyText = $(this).attr('href');
                        document.addEventListener('copy', function(e) {
                            e.clipboardData.setData('text/plain', copyText);
                            e.preventDefault();
                        }, true);

                        document.execCommand('copy');

                        Swal.fire(
                            'Berhasil',
                            'Link url feedback sudah tercopy',
                            'success'
                        );

                    });
                    //batas
                    $('.tabeldata').on('click','.hapuskunjungan',function(e) {
                        e.preventDefault();
                        var id = $(this).data('id');
                        var uid = $(this).data('uid');
                        var nama = $(this).data('nama');
                        var tanggal = $(this).data('tanggal');
                        Swal.fire({
                            title: 'Akan dihapus?',
                            text: "Data kunjungan an. " + nama + " tanggal "+ tanggal +" akan dihapus permanen",
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
                                    url: '{{ route("kunjungan.hapus") }}',
                                    method: 'post',
                                    data: {
                                        uid: uid,
                                        id: id,
                                        nama: nama,
                                        tanggal: tanggal
                                    },
                                    cache: false,
                                    dataType: 'json',
                                    success: function(data) {
                                        if (data.status == true) {
                                            Swal.fire(
                                                'Berhasil!',
                                                '' + data.message + '',
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
                                                '' + data.message + '',
                                                'error'
                                            );
                                        }

                                    },
                                    error: function() {
                                        Swal.fire(
                                            'Error',
                                            'Koneksi Error',
                                            'error'
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
    @include('newbukutamu.js-kunjungan')
    @include('newbukutamu.js-feedback')
    @include('newbukutamu.js-importdatawa')
    @include('newbukutamu.js-petugas')
@stop

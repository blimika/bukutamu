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
                <li class="breadcrumb-item active">Layanan Akses</li>
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
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                    <h4 class="card-title">Data Akses Layanan Bukutamu</h4>
                    <div class="row">
                        <div class="col-lg-8 col-xs-12">
                    <div class="table-responsive m-t-40">
                        <table id="dTabel" class="display table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>IP</th>
                                    <th>Flag</th>
                                    <th>created_at</th>
                                    <th>update_at</th>
                                    <th>aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>IP</th>
                                    <th>Flag</th>
                                    <th>created_at</th>
                                    <th>update_at</th>
                                    <th>aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                        </div>
                        <div class="col-lg-4 col-xs-12">
                            <h4 class="card-title">Input IP Akses Layanan Baru</h4>
                                <h6 class="card-subtitle">akses menu tambah kunjungan baru</h6>
                                <form class="mt-4" name="formIpAkses">
                                    <div class="form-group">
                                        <label for="ipaddress">IP Address</label>
                                        <input type="text" class="form-control" name="ipaddress" id="ipaddress" aria-describedby="ipaddress" placeholder="Masukan IP Address">
                                        <small id="ipaddress_teks" class="form-text text-muted">ip address yang bisa akses menu tambah kunjungan baru</small>
                                    </div>
                                    <button type="submit" id="simpanakses" class="btn btn-primary">Simpan</button>
                                </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@include('master.modal-editakses')
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
            $('#dTabel').DataTable({
             processing: true,
             serverSide: true,
             ajax: "{{route('layanan.listakses')}}",
             columns: [
                { data: 'id' },
                { data: 'ip' },
                { data: 'flag' },
                { data: 'created_at' },
                { data: 'updated_at' },
                { data: 'aksi', orderable: false },
             ],
            dom: 'Bfrtip',
            iDisplayLength: 30,
            buttons: [
                'copy','excel','print'
            ],
            responsive: true,
            "fnDrawCallback": function () {
                //hapus tamu
                $(".hapusakses").click(function (e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    var ip = $(this).data('ip');
                    Swal.fire({
                                title: 'Akan dihapus?',
                                text: "Data akses ip ("+ip+") akan dihapus permanen",
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
                                        url : '{{route('layanan.hapusakses')}}',
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
                //ubah flag depan
                $(".ubahflagakses").click(function (e) {
                        e.preventDefault();
                        var id = $(this).data('id');
                        var ipaddress = $(this).data('ip');
                        var flag = $(this).data('flag');
                        var flag_nama;
                        if (flag == 0)
                        {
                            //akan diubah ke
                            flag_nama = "No-Edit";
                        }
                        else
                        {
                            flag_nama = "Edit";
                        }
                        Swal.fire({
                                    title: 'Akan diubah?',
                                    text: "Data IP . ("+ipaddress+") akan diubah ke "+flag_nama+"?",
                                    type: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Ubah'
                                }).then((result) => {
                                    if (result.value) {
                                        //response ajax disini
                                        $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            }
                                        });
                                        $.ajax({
                                            url : '{{route('layanan.ubahflagakses')}}',
                                            method : 'post',
                                            data: {
                                                id: id,
                                                ip: ipaddress,
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
                                                        'error'
                                                    );
                                                }

                                            },
                                            error: function(){
                                                Swal.fire(
                                                    'Error',
                                                    'Koneksi Error '+data.hasil+'',
                                                    'error'
                                                );
                                            }

                                        });

                                    }
                                })
                    });

                //batas flag member
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
@include('master.jsakses')

@stop

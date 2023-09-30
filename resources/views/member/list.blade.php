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
                <li class="breadcrumb-item active">Members</li>
            </ol>
            @if (Auth::User()->level > 10)
                <a href="javascript:void(0)" class="btn btn-success d-lg-block m-l-15" data-toggle="modal" data-target="#TambahMember"><i class="fa fa-plus-circle"></i> Member</a>
            @endif
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
                    <h4 class="card-title">Data member</h4>

                    <div class="table-responsive m-t-40 tabeldata">
                        <table id="dTabel" class="display table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Photo</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>E-Mail</th>
                                    <th>Telepon</th>
                                    <th>Level</th>
                                    <th>IP</th>
                                    <th>Lastlogin</th>
                                    <th>Flag</th>
                                    @if (Auth::user()->level > 1)
                                        <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Photo</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>E-Mail</th>
                                    <th>Telepon</th>
                                    <th>Level</th>
                                    <th>IP</th>
                                    <th>Lastlogin</th>
                                    <th>Flag</th>
                                    @if (Auth::user()->level > 1)
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
@include('member.modal-tambah')
@include('member.modal-view')
@include('member.modal-edit')
@include('member.modal-gantipasswd')
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
    .miring
    {
        font-style: italic;
    }
    .normal
    {
        font-style: normal;
    }
    </style>
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
    <!-- Sweet-Alert  -->
    <script src="{{asset('assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
    <!-- Magnific popup JavaScript -->
    <script src="{{asset('assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup-init.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
          // DataTable
          $('#dTabel').DataTable({
             processing: true,
             serverSide: true,
             ajax: "{{route('member.page')}}",
             columns: [
                { data: 'id' },
                { data: 'user_foto', orderable: false },
                { data: 'name' },
                { data: 'username' },
                { data: 'email' },
                { data: 'telepon' },
                { data: 'level_nama' },
                { data: 'lastip' },
                { data: 'lastlogin' },
                { data: 'flag' },
                { data: 'aksi', orderable: false },
             ],
            dom: 'Bfrtip',
            iDisplayLength: 30,
            buttons: [
                'copy','excel','print'
            ],
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
                $(".hapusmember").click(function (e) {
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
                                        url : '{{route('member.hapus')}}',
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
                                                    'error'
                                                );
                                            }

                                        },
                                        error: function(){
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
                //ubah flag member
                //ubah kunjungan depan
                    $(".ubahflagmember").click(function (e) {
                        e.preventDefault();
                        var id = $(this).data('id');
                        var nama = $(this).data('nama');
                        var flagmember = $(this).data('flagmember');
                        var flag_nama;
                        if (flagmember == 0)
                        {
                            //akan diubah ke
                            flag_nama = "Aktif";
                        }
                        else
                        {
                            flag_nama = "Nonaktif";
                        }
                        Swal.fire({
                                    title: 'Akan diubah?',
                                    text: "Data member an. "+nama+" akan diubah ke "+flag_nama,
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
                                            url : '{{route('member.ubahflag')}}',
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
    @include('member.js-tambah')
    @include('member.js-view')
    @include('member.js-gantipasswd')
@stop

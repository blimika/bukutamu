
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Daftar Member Bukutamu BPS Provinsi Nusa Tenggara Barat">
    <meta name="author" content="I Putu Dyatmika">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicon.png')}}">
    <title>Daftar Bukutamu - BPS Provinsi NTB</title>

    <!-- page css -->
    <link href="{{ asset('dist/css/pages/login-register-lock.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">
    <!--alerts CSS -->
    <link href="{{asset('assets/node_modules/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">
    <style type="text/css">
        #preloading, #pesanerror
        {
            display: none;
        }
    </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Bukutamu</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper" class="login-register login-sidebar" style="background-image:url({{ asset('assets/images/background/login-register.jpg') }});">
        <div class="login-box card">
            <div class="card-body">
                <form class="form-horizontal form-material" id="formDaftar" method="POST" action="#">
                    <div class="text-center">
                        <a href="{{ url('') }}" class="text-center m-b-40"><img src="{{asset('assets/images/logo-bktamu.png')}}" alt="Home" /><br/><img src="{{asset('assets/images/tulisan-bukutamu.png')}}" alt="Home" /></a>
                    </div>
                    <h3 class="box-title m-t-40 m-b-0">Daftar Sekarang</h3><small>Bukutamu BPS Provinsi Nusa Tenggara Barat</small>
                    <center id="preloading" class="m-t-5 m-b-5">
                        <button class="btn btn-success" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading, Memproses pendaftaran member...
                          </button>
                    </center>
                    <center id="pesanerror">
                        <div class="alert alert-success m-t-5 m-b-5"><span id="tekserror"></span></div>
                    </center>
                    <div id="BoxDaftarMember">
                        @csrf
                        <div class="form-group m-t-20">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group m-t-20">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="" name="username" id="username" placeholder="Username" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group m-t-20">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="" name="telepon" id="telepon" placeholder="Nomor Telepon" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="" name="email" id="email" placeholder="Email" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" required="" name="passwd" id="passwd" placeholder="Password" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" required="" name="ulangi_passwd" id="ulangi_passwd" placeholder="Ulangi Password" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <span id="member_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit" name="daftar" id="daftar">DAFTAR</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            <p>Sudah memiliki akun? <a href="{{ route('login') }}" class="text-info m-l-5"><b>Masuk</b></a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('assets/node_modules/jquery/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('assets/node_modules/popper/popper.min.js') }}"></script>
    <script src="{{ asset('assets/node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- Sweet-Alert  -->
    <script src="{{asset('assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
    @include('users.js-daftar')
    <script type="text/javascript">
        $(function() {
            $(".preloader").fadeOut();
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
        // ==============================================================
        // Login and Recover Password
        // ==============================================================
        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
    </script>
</body>

</html>

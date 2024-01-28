<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">
    <title>Display Antrian Pelayanan Statistik Terpadu</title>

    <!-- page css -->
    <link href="{{ asset('dist/css/pages/login-register-lock.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">
    <style>
        .nomorantrian {
            font-size: 150px;
        }

        .namapetugas {
            font-size: 40px;
        }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="horizontal-nav boxed skin-megna card-no-border">
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
    <section id="wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center">
                        <h1>Pelayanan Statistik Terpadu <br />
                            Badan Pusat Statistik Provinsi Nusa Tenggara Barat</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-1">
            </div>
            <div class="col-lg-5">
                <div class="card bg-info text-center">
                    <div class="card-header">
                        <h1 class="text-white">Nomor Antrian</h1>
                    </div>
                    <div class="card-body">
                        <span class="text-white nomorantrian">
                            {{ $data1['nomor_antrian'] }}
                        </span>
                        <hr class="text-white">
                        <span class="text-white namapetugas">
                            @if ($data1['loket_status'] == true)
                                Petugas {{ $data1['loket_petugas'] }}
                            @else
                                {{ $data1['loket_petugas'] }}
                            @endif
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">

                <div class="card bg-success text-center">
                    <div class="card-header">
                        <h1 class="text-white">Nomor Antrian</h1>
                    </div>
                    <div class="card-body">
                        <span class="text-white nomorantrian">
                            {{ $data2['nomor_antrian'] }}
                        </span>
                        <hr class="text-white">
                        <span class="text-white namapetugas">
                            @if ($data2['loket_status'] == true)
                                Petugas {{ $data2['loket_petugas'] }}
                            @else
                                {{ $data2['loket_petugas'] }}
                            @endif
                        </span>
                    </div>

                </div>

            </div>
            <div class="col-lg-1">
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
    <!--Custom JavaScript -->
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

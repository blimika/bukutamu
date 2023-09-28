
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
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicon.png')}}">
    <title>Bukutamu BPS Provinsi Nusa Tenggara Barat</title>
    <!-- page css -->
    <link href="{{asset('assets/node_modules/register-steps/steps.css')}}" rel="stylesheet">
    <link href="{{asset('dist/css/pages/register3.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('dist/css/style.min.css')}}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="skin-default card-no-border">
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
    <section id="wrapper" class="step-register">
        <div class="register-box">
            <div class="">
                <a href="{{ url('') }}" class="text-center m-b-40"><img src="{{asset('assets/images/logo-bktamu.png')}}" alt="Home" /><br/><img src="{{asset('assets/images/tulisan-bukutamu.png')}}" alt="Home" /></a>
                <!-- multistep form -->
                <form id="msform" method="POST" action="{{ route('member.daftar') }}">
                    <!-- progressbar -->
                    <ul id="eliteregister">
                        <li class="active">Akun info</li>
                        <li>Data profil</li>
                    </ul>
                    <!-- fieldsets -->
                    <fieldset>
                        <h2 class="fs-title">Akun Info</h2>
                        <h3 class="fs-subtitle">Halaman 1</h3>
                        <input type="text" name="username" placeholder="Username" autocomplete="off" required/>
                        <input type="text" name="email" placeholder="Email" autocomplete="off" required />
                        <input type="password" name="passwd" placeholder="Password" required />
                        <input type="password" name="ulangi_passwd" placeholder="Ulangi Password" required />
                        <input type="button" name="next" class="next action-button" value="Selanjutnya" />
                    </fieldset>
                    <fieldset>
                        <h2 class="fs-title">Data Profil</h2>
                        <h3 class="fs-subtitle">Halaman 2</h3>
                        <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" />
                        <input type="text" name="telepon" placeholder="Nomor Telepon" />
                        <input type="text" name="gplus" placeholder="Google Plus" />
                        <input type="button" name="previous" class="previous action-button" value="Sebelumnya" />
                        <input type="submit" name="submit" class="submit action-button" value="Kirim" />
                    </fieldset>
                </form>
                <div class="clear"></div>
            </div>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{asset('assets/node_modules/jquery/jquery-3.2.1.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('assets/node_modules/popper/popper.min.js')}}"></script>
    <script src="{{asset('assets/node_modules/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="{{asset('assets/node_modules/register-steps/jquery.easing.min.js')}}"></script>
    <script src="{{asset('assets/node_modules/register-steps/register-init.js')}}"></script>
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

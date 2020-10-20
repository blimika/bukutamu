<!-- ============================================================== -->
<!-- Logo -->
<!-- ============================================================== -->
<div class="navbar-header">
    <a class="navbar-brand" href="{{url('')}}">
        <!-- Logo icon -->
        
            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
            <!-- Dark Logo icon -->
            <!--<img src="{{asset('assets/images/logo-bktamu.png')}}" alt="homepage" class="dark-logo" />-->
            <!-- Light Logo icon -->
            <img src="{{asset('assets/images/logo-bktamu.png')}}" alt="homepage" class="light-logo" />
        <!--End Logo icon -->
        <!-- Logo text -->
        <span class="hidden-sm-down">
        <img src="{{asset('assets/images/tulisan-bktamu.png')}}" class="light-logo" alt="homepage" /></span> </a>
    </a>
</div>
<!-- ============================================================== -->
<!-- End Logo -->
<!-- ============================================================== -->
<div class="navbar-collapse">
    <!-- ============================================================== -->
    <!-- toggle and nav items -->
    <!-- ============================================================== -->
    <ul class="navbar-nav mr-auto">
        <!-- This is  -->
        <li class="nav-item"> <a class="nav-link nav-toggler d-block d-sm-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
        <li class="nav-item"> <a class="nav-link sidebartoggler d-none waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
        <!-- ============================================================== -->
        <!-- Search -->
        <!-- ============================================================== -->
    </ul>
    <!-- ============================================================== -->
    <!-- User profile and search -->
    <!-- ============================================================== -->
    <ul class="navbar-nav my-lg-0">
        <!-- ============================================================== -->
        <!-- User Profile -->
        <!-- ============================================================== -->
        <li class="nav-item dropdown u-pro">
            <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="hidden-md-down">
                @if (Auth::user())
            {{Auth::user()->name}} 
            @else 
            MASUK 
            @endif
            &nbsp;<i class="fa fa-angle-down"></i></span> </a>
            <div class="dropdown-menu dropdown-menu-right animated flipInY">
                @if (Auth::user())
                <a href="javascript:void(0)" class="dropdown-item"><i class="ti-user"></i> Ganti Password</a>
                <div class="dropdown-divider"></div>
                <a href="{{route('logout')}}" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                @else
                <!-- text-->
                <a href="{{route('login')}}" class="dropdown-item"><i class="ti-user"></i> Login</a>
                @endif
            </div>
        </li>
        <!-- ============================================================== -->
        <!-- End User Profile -->
        <!-- ============================================================== -->
    </ul>
</div>
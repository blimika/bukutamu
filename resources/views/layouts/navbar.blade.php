<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="user-pro">
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><span
                            class="hide-menu">
                            @if (Auth::user())
                                {{ Auth::user()->name }}
                            @else
                                MASUK
                            @endif
                        </span></a>
                    <ul aria-expanded="false" class="collapse">
                        @if (Auth::User())
                            <li><a href="{{ route('member.profil') }}"><i class="ti-user"></i> Profil</a></li>
                            <li><a href="{{ route('logout') }}"><i class="fa fa-power-off"></i> Logout</a></li>
                        @else
                            <li><a href="{{ route('login') }}"><i class="fas fa-power-off"></i> Login</a></li>
                            <li><a href="{{ route('daftar') }}"><i class="fas fa-power-off"></i> Daftar</a></li>
                        @endif
                    </ul>
                </li>
                <li class="nav-small-cap">--- PERSONAL</li>
                <li> <a class="waves-effect waves-dark" href="{{route('newdepan')}}" aria-expanded="false"><i
                            class="icon-speedometer"></i><span class="hide-menu">Depan </span></a>

                </li>
                @if (Auth::user() or Generate::CekAkses(\Request::getClientIp(true)))
                    <li>
                        <a class="waves-effect waves-dark ml-auto" href="#" aria-expanded="false"><i
                                class="ti-plus"></i><span class="hide-menu">Tambah Data</span></a>
                        <ul aria-expanded="false" class="collapse">
                            @if (Generate::CekAkses(\Request::getClientIp(true)))
                                <!--<li><a href="{{ route('kunjungan.baru') }}">Kunjungan Baru</a></li>-->
                                <li><a href="{{ route('newkunjungan') }}">New Kunjungan</a></li>
                            @endif

                        </ul>
                    </li>
                @endif
                <!--<li>
                                <a class="waves-effect waves-dark ml-auto" href="#" data-toggle="modal" data-target="#TambahModal" aria-expanded="false"><i class="ti-plus"></i><span class="hide-menu">Tambah Bukutamu</span></a>
                            </li>
                            <li>
                                <a class="waves-effect waves-dark ml-auto" href="#" data-toggle="modal" data-target="#InputDataLamaModal" aria-expanded="false"><i class="ti-layers"></i><span class="hide-menu">Input Data Lama</span></a>
                            </li>--->
                <!--<li>
                    <a class="waves-effect waves-dark ml-auto" href="{{ route('feedback.list') }}"><i
                            class="ti-medall"></i><span class="hide-menu">Feedback</span></a>
                </li>-->
                <li>
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                        class="ti-align-left"></i><span class="hide-menu">Kunjungan</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('laporan.newpengunjung') }}">Laporan</a></li>
                        @if (Generate::CekAkses(\Request::getClientIp(true)))
                            @if (Auth::user())
                                @if (Auth::user()->level > 5)
                                <li><a href="{{ route('listdata') }}">New List</a></li>
                                @endif
                            @endif
                            <li><a href="{{ route('newdisplay') }}" target="_blank">Display Antrian</a></li>
                        @endif
                    </ul>
                </li>
                @if (Generate::CekAkses(\Request::getClientIp(true)))
                @if (Auth::user())
                <li>
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                            class="ti-align-left"></i><span class="hide-menu">Pengunjung</span></a>
                    <ul aria-expanded="false" class="collapse">
                            <li><a href="{{ route('lama') }}">List Data</a></li>
                            <li><a href="{{ route('tamu.list') }}">List</a></li>
                            <li><a href="{{ route('pengunjung.newlist') }}">New List</a></li>
                    </ul>
                </li>
                @endif
                @endif
                @if (Auth::User())
                    @if (Auth::User()->level > 5)
                        <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)"
                                aria-expanded="false"><i class="ti-settings"></i><span
                                    class="hide-menu">Master</span></a>
                            <ul aria-expanded="false" class="collapse">
                                @if (Auth::User()->level > 10)
                                <li><a href="{{ route('pengunjung.list') }}">Pengunjung</a></li>
                                @endif
                                <li><a href="{{ route('member.list') }}">Member</a></li>
                                <li><a href="{{ route('layanan.akses') }}">Layanan Akses</a></li>
                                <li><a href="{{ route('master.tanggal') }}">Tanggal</a></li>
                                @if (Auth::User()->level == 20)
                                <li><a href="{{ route('master.database') }}">Database</a></li>
                                @endif
                            </ul>
                        </li>
                    @endif

                @endif
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->

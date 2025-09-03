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
                <li><a class="waves-effect waves-dark" href="{{url('')}}" aria-expanded="false"><i class="icon-speedometer"></i><span class="hide-menu">Depan </span></a>
                </li>
                @if (Auth::user() || Generate::CekAkses(\Request::getClientIp(true)))
                    @if (Generate::CekAkses(\Request::getClientIp(true)) || Auth::user()->level > 1)
                    <li><a class="waves-effect waves-dark ml-auto" href="#" aria-expanded="false"><i class="ti-plus"></i><span class="hide-menu">Tambah Data</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ route('newkunjungan') }}">Kunjungan Baru</a></li>
                                <li><a href="{{ route('newpermintaan') }}">Permintaan Data</a></li>
                            </ul>
                        </li>
                    @endif
                    <li><a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-align-left"></i><span class="hide-menu">Kunjungan</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('newlaporan') }}">Laporan</a></li>
                            @if (Auth::user())
                                @if (Auth::user()->level > 5)
                                <li><a href="{{ route('listdata') }}">List</a></li>
                                @endif
                            @endif
                        <li><a href="{{ route('newdisplay') }}" target="_blank">Display Antrian</a></li>
                    </ul>
                </li>
                    @if (Auth::user())
                        @if (Auth::user()->level > 5)
                        <li>
                            <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-align-left"></i><span class="hide-menu">Pengunjung</span></a>
                            <ul aria-expanded="false" class="collapse">
                                    <li><a href="{{ route('pengunjung.newlist') }}">List</a></li>
                                    <li><a href="{{ route('listfeedback') }}">Feedback</a></li>
                            </ul>
                        </li>
                        @endif
                    @endif
                @endif
                @if (Auth::User())
                    @if (Auth::User()->level > 5)
                        <li>
                            <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-settings"></i><span class="hide-menu">Master</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ route('member.list') }}">Member</a></li>
                                <li><a href="{{ route('layanan.akses') }}">Layanan Akses</a></li>
                                <li><a href="{{ route('master.tanggal') }}">Tanggal</a></li>
                                <li><a href="{{ route('kalendar') }}">Jadwal Jaga</a></li>
                                <li><a href="{{ route('penilaian') }}">Penilaian</a></li>
                                <li><a href="{{ route('whatsapp') }}">Whatsapp</a></li>
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

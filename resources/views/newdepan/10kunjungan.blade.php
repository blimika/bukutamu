<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">10 Kunjungan terakhir</h5>
                @if (Auth::user())
                    @if (Auth::user()->level > 5)
                        <a href="{{route('listdata')}}" class="btn btn-success btn-sm float-right">selengkapnya</a>
                    @endif
                @endif
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>Kunjungan</th>
                            <th>Layanan Utama</th>
                            <th>Keperluan</th>
                            <th class="text-center">Status</th>
                            <th>Petugas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($NewKunjungan->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center">Data tidak tersedia</td>
                            </tr>
                        @else
                            @foreach ($NewKunjungan as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->kunjungan_tanggal}}</td>
                                    <td>{{$item->Pengunjung->pengunjung_nama}}</td>
                                    <td>
                                        @if ($item->kunjungan_jenis == 1)
                                            <span class="badge badge-success badge-pill">
                                            {{$item->JenisKunjungan->nama}}
                                            </span>
                                        @else
                                            <span class="badge badge-warning badge-pill">
                                            {{$item->JenisKunjungan->nama}}
                                            </span>
                                            <br />
                                            <span class="badge badge-warning badge-pill">
                                                {{$item->kunjungan_jumlah_orang}} orang
                                                </span>
                                            <span class="badge badge-danger badge-pill">
                                                L {{$item->kunjungan_jumlah_pria}}
                                            </span>
                                            <span class="badge badge-info badge-pill">
                                                P {{$item->kunjungan_jumlah_wanita}}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->kunjungan_tujuan == 2)
                                            @if ($item->kunjungan_pst == 1)
                                                <span class="badge badge-success badge-pill">{{$item->Tujuan->inisial}}
                                                </span> <span class="badge badge-info badge-pill">{{$item->LayananUtama->nama}}
                                                </span>
                                            @elseif ($item->kunjungan_pst == 2)
                                                <span class="badge badge-success badge-pill">{{$item->Tujuan->inisial}}
                                                </span> <span class="badge badge-warning badge-pill">{{$item->LayananUtama->nama}}
                                                </span>
                                            @elseif ($item->kunjungan_pst == 3)
                                                <span class="badge badge-success badge-pill">{{$item->Tujuan->inisial}}
                                                </span> <span class="badge badge-danger badge-pill">{{$item->LayananUtama->nama}}
                                                </span>
                                            @else
                                                <span class="badge badge-success badge-pill">{{$item->Tujuan->inisial}}
                                                </span> <span class="badge badge-primary badge-pill">{{$item->LayananUtama->nama}}
                                                </span>
                                            @endif
                                        @else
                                            @if ($item->kunjungan_tujuan == 1)
                                                <span class="badge badge-danger badge-pill">{{$item->Tujuan->nama}}
                                                </span>
                                            @elseif($item->kunjungan_tujuan == 3)
                                                <span class="badge badge-warning badge-pill">{{$item->Tujuan->nama}}
                                                </span>
                                            @elseif($item->kunjungan_tujuan == 4)
                                                <span class="badge badge-info badge-pill">{{$item->Tujuan->nama}}
                                                </span>
                                            @elseif($item->kunjungan_tujuan == 5)
                                                <span class="badge badge-primary badge-pill">{{$item->Tujuan->nama}}
                                                </span>
                                            @else
                                                <span class="badge badge-dark badge-pill">{{$item->Tujuan->nama}}
                                                </span>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{$item->kunjungan_keperluan}}</td>
                                    <td class="text-center">
                                        @if ($item->kunjungan_flag_antrian == 1)
                                            <span class="badge badge-danger badge-pill">
                                                {{$item->FlagAntrian->nama}}
                                            </span>
                                        @elseif ($item->kunjungan_flag_antrian == 2)
                                            <span class="badge badge-warning badge-pill">
                                                {{$item->FlagAntrian->nama}}
                                            </span>
                                        @else
                                            <span class="badge badge-success badge-pill">
                                                {{$item->FlagAntrian->nama}}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->kunjungan_petugas_username)
                                        <span class="label label-info">               {{$item->kunjungan_petugas_username}}
                                        </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

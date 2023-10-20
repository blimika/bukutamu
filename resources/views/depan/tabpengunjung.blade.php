@if ($Kunjungan->isEmpty())
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body"><b><center>DATA PENGUNJUNG BELUM TERSEDIA</center></b>
            </div>
        </div>
    </div>
</div>
@else
<div class="row el-element-overlay">
    @foreach ($Kunjungan as $item)
    <!-- tampilan baru--->
    <div class="col-lg-3 col-md-6">
        <div class="card text-white bg-dark">
            <div class="el-card-item">
                <div class="el-card-avatar el-overlay-1">
                    @if ($item->file_foto != NULL)
                        @if (Storage::disk('public')->exists($item->file_foto))
                            <img src="{{asset('storage/'.$item->file_foto)}}" alt="image" class="img-responsive"/>
                        @else
                            <img src="https://via.placeholder.com/480x360/0022FF/FFFFFF/?text=photo+tidak+ada" alt="image" class="img-responsive"/>
                        @endif
                    @else
                        <img src="https://via.placeholder.com/480x360/0000FF/FFFFFF/?text=belum+ada+photo" alt="image" class="img-responsive"/>
                    @endif
                    <div class="el-overlay">
                        <ul class="el-info">
                            @if ($item->file_foto != NULL)
                                @if (Storage::disk('public')->exists($item->file_foto))
                                    <li>
                                        <a class="btn default btn-outline image-popup-vertical-fit" href="{{asset('storage'.$item->file_foto)}}" title="Nama : {{$item->tamu->nama_lengkap}} | Kunjungan : {{\Tanggal::HariPanjang($item->updated_at)}}">
                                            <i class="icon-magnifier"></i>
                                        </a>
                                    </li>
                                @else
                                    <li>
                                        <a class="btn default btn-outline image-popup-vertical-fit" href="https://via.placeholder.com/480x360/0000FF/FFFFFF/?text=Photo+tidak+ada" title="Nama : {{$item->tamu->nama_lengkap}} | Kunjungan : {{\Tanggal::HariPanjang($item->updated_at)}}">
                                            <i class="icon-magnifier"></i>
                                        </a>
                                    </li>
                                @endif

                            @else
                            <li>
                                <a class="btn default btn-outline image-popup-vertical-fit" href="https://via.placeholder.com/480x360/0000FF/FFFFFF/?text=belum+ada+photo" title="Nama : {{$item->tamu->nama_lengkap}} | Kunjungan : {{\Tanggal::HariPanjang($item->updated_at)}}">
                                    <i class="icon-magnifier"></i>
                                </a>
                            </li>
                            @endif
                            <li>
                                <a class="btn default btn-outline" href="javascript:void(0);" data-kodeqr="{{$item->tamu->kode_qr}}" data-toggle="modal" data-target="#ViewModal">
                                    <i class="icon-link"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="el-card-content">
                    <h4 class="box-title">{{$item->tamu->nama_lengkap}}</h4>
                    <small>{{$item->tamu->pekerjaan->nama}} - {{$item->tamu->kerja_detil}}</small>
                    <p>
                        @if ($item->tamu->jk->inisial=='L')
                        <span class="badge badge-info badge-pill">{{$item->tamu->jk->inisial}}</span>
                        @else
                        <span class="badge badge-danger badge-pill">{{$item->tamu->jk->inisial}}</span>
                        @endif
                        @if ($item->is_pst=='0')
                        <span class="badge badge-danger badge-pill">Kantor</span>
                        @else
                        <span class="badge badge-success badge-pill">PST</span>
                        @endif
                        <span class="badge badge-primary badge-pill">{{ \Carbon\Carbon::parse($item->tamu->tgl_lahir)->age}}</span>
                        @if($item->jenis_kunjungan == 1)
                        <span class="badge badge-info badge-pill">{{$item->jKunjungan->nama}}</span>
                        @else
                        <span class="badge badge-warning badge-pill">{{$item->jKunjungan->nama}}
                            ({{$item->jumlah_tamu}} org)
                        </span>
                        <span class="badge badge-info badge-pill">
                            L {{$item->tamu_m}}
                        </span>
                        <span class="badge badge-danger badge-pill">
                            P {{$item->tamu_f}}
                        </span>
                        @endif
                        <p class="m-r-5 m-l-5">
                            <i>{{$item->keperluan}}</i>
                        </p>
                        <span class="label label-success text-dark">{{Tanggal::LengkapHariPanjang($item->created_at)}}</span>
                    </p>
                    <div class="m-r-10 float-right">
                        <span>{{ $item->created_at->diffForHumans()}}</span>
                        @if ($item->f_feedback==1)
                        <span data-toggle="tooltip" data-placement="top" title="{{$item->tamu->nama_lengkap}} belum memberikan feedback, klik tombol ini untuk memberikan feedback"><button type="button" class="btn waves-effect waves-light btn-rounded btn-sm btn-danger" data-tamuid="{{$item->tamu_id}}" data-kodeqr="{{$item->tamu->kode_qr}}" data-toggle="modal" data-target="#FeedbackModal" data-kunjunganid="{{$item->id}}" >Feedback</button></span>
                        @else
                        <button type="button" class="btn btn-circle btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="{{$item->tamu->nama_lengkap}} sudah memberikan feedback"><i class="fas fa-check"></i></button>
                        @endif
                    </div>
                    @if (Auth::user())
                        @if (Auth::user()->level > 1)
                        <div class="float-left m-l-5">
                            <div class="btn-group">
                                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ti-settings"></i>
                                </button>
                                <div class="dropdown-menu animated flipInY">
                                    <a class="dropdown-item ubahpstkantor" href="javascript:void(0)" data-id="{{$item->id}}" data-nama="{{$item->tamu->nama_lengkap}}" data-ispst="{{$item->is_pst}}" data-toggle="tooltip" title="Ubah Status Kunjungan Ke @if ($item->is_pst == 0) PST @else Kantor @endif">Ubah Status</a>
                                    <a class="dropdown-item ubahjeniskunjungan" href="javascript:void(0)" data-id="{{$item->id}}" data-nama="{{$item->tamu->nama_lengkap}}" data-jnskunjungan="{{$item->jenis_kunjungan}}" data-fotokunjungan="@if ($item->file_foto) {{asset('storage/'.$item->file_foto)}} @else https://via.placeholder.com/640x480/0000FF/FFFFFF/?text=Tidak+ada+foto+pengunjung @endif" data-toggle="tooltip" title="Ubah Jenis Kunjungan Ke @if ($item->jenis_kunjungan == 1) {{$Mjkunjungan[1]->nama}} @else {{$Mjkunjungan[0]->nama}} @endif">Ubah Jenis</a>
                                    @if($item->jenis_kunjungan==2)
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="javascript:void(0)" data-id="{{$item->id}}" data-nama="{{$item->tamu->nama_lengkap}}" data-toggle="modal" data-target="#EditKunjunganModal">Edit</a>
                                    @endif
                                    @if(Auth::user()->level > 10)
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item hapuskunjungan" href="javascript:void(0)" data-id="{{$item->id}}" data-nama="{{$item->tamu->nama_lengkap}}" data-toggle="tooltip" title="Hapus Kunjungan ini">Hapus</a>
                                    @endif
                                </div>
                            </div>

                        </div>
                        @endif
                    @endif
                </div>

            </div>
        </div>
    </div>
    <!-- batas tampilan baru--->
    @endforeach
</div>
@endif

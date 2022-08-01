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
                    <img src="{{asset('storage/'.$item->file_foto)}}" alt="image" class="img-responsive"/>
                    @else
                    <img src="https://via.placeholder.com/480x360/0000FF/FFFFFF/?text=belum+ada+photo" alt="image" class="img-responsive"/>
                    @endif
                    <div class="el-overlay">
                        <ul class="el-info">
                            @if ($item->file_foto != NULL)
                            <li>
                                <a class="btn default btn-outline image-popup-vertical-fit" href="{{asset('storage'.$item->file_foto)}}" title="Nama : {{$item->tamu->nama_lengkap}} | Kunjungan : {{\Tanggal::HariPanjang($item->updated_at)}}">
                                    <i class="icon-magnifier"></i>
                                </a>
                            </li>
                            @else
                            <li>
                                <a class="btn default btn-outline image-popup-vertical-fit" href="https://via.placeholder.com/480x360/0000FF/FFFFFF/?text=belum+ada+photo" title="Nama : {{$item->tamu->nama_lengkap}} | Kunjungan : {{\Tanggal::HariPanjang($item->updated_at)}}">
                                    <i class="icon-magnifier"></i>
                                </a>
                            </li>
                            @endif
                            <li>
                                <a class="btn default btn-outline" href="javascript:void(0);" data-id="{{$item->tamu_id}}" data-toggle="modal" data-target="#ViewModal">
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
                        <span class="badge badge-warning badge-pill">{{ \Carbon\Carbon::parse($item->tamu->tgl_lahir)->age}}</span>
                        <span class="badge badge-primary badge-pill">{{$item->jKunjungan->nama}} @if($item->jenis_kunjungan > 1)
                            ({{$item->jumlah_tamu}} org)
                        @endif</span>
                        <br />
                        <i>{{$item->keperluan}}</i>
                        <br />
                        <small>{{Tanggal::HariPanjang($item->tanggal)}}</small>
                    </p>
                    <div class="m-r-10 float-right">
                        <span>{{ $item->created_at->diffForHumans()}}</span>
                        @if ($item->f_feedback==1)
                        <span data-toggle="tooltip" data-placement="top" title="{{$item->tamu->nama_lengkap}} belum memberikan feedback, klik tombol ini untuk memberikan feedback"><button type="button" class="btn waves-effect waves-light btn-rounded btn-sm btn-danger" data-tamuid="{{$item->tamu_id}}" data-toggle="modal" data-target="#FeedbackModal" data-kunjunganid="{{$item->id}}" >Feedback</button></span>
                        @else
                        <button type="button" class="btn btn-circle btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="{{$item->tamu->nama_lengkap}} sudah memberikan feedback"><i class="fas fa-check"></i></button>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- batas tampilan baru--->
    @endforeach
</div>
@endif

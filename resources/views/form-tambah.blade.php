<h4 class="box-title"><strong>Biodata Pengunjung</strong></h4>
<hr class="m-t-0 m-b-20">
<div class="row">
    <div class="form-group col-md-4">
        <label for="jenis_identitas">Jenis Identitas</label>
            <select class="form-control" id="jenis_identitas" name="jenis_identitas" required>
                <option disabled selected></option>
                @foreach ($Midentitas as $item_identitas)
                        <option value="{{$item_identitas->id}}">{{$item_identitas->nama}}</option>
                @endforeach
        </select>

    </div>
    <div class="form-group col-md-8">
            <div class="row">
                <div class="col-md-8">
                        <label for="nomor_identitas">Nomor identitas</label>
                        <input type="text" class="form-control" id="nomor_identitas" name="nomor_identitas" required>
                </div>
                <div class="col-md-4">
                        <br />
                        <button type="button" name="cek_id" id="cek_id" class="btn btn-info">CEK ID</button>
                        <button type="button" name="edit_id" id="edit_id" class="btn btn-success" disabled>EDIT</button>
                </div>

            </div>
        </div>
</div>

<div class="row">
        <div class="form-group col-md-6">
                <label for="nama_lengkap">Nama lengkap</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required readonly>
        </div>
        <div class="form-group col-md-6 m-b-40">
                <label for="id_jk">Jenis Kelamin</label>
                <select class="form-control" id="id_jk" name="id_jk" required disabled>
                <option disabled selected></option>
                @foreach ($Mjk as $item_jk)
                        <option value="{{$item_jk->id}}">{{$item_jk->nama}}</option>
                @endforeach
                </select>
        </div>
</div>
<div class="row">
        <div class="form-group col-md-6">
                <label for="tgl_lahir">Tanggal lahir</label>
                <input type="text" class="form-control" id="tgl_lahir" name="tgl_lahir" autocomplete="off" required readonly>
        </div>
        <div class="form-group col-md-6">
                <label for="id_mdidik">Pendidikan terakhir</label>
                <select class="form-control" id="id_mdidik" name="id_mdidik" required disabled>
                        <option disabled selected></option>
                        @foreach ($Mpendidikan as $item_didik)
                                <option value="{{$item_didik->id}}">{{$item_didik->nama}}</option>
                        @endforeach
                </select>

        </div>
</div>
<div class="row">
        <div class="form-group col-md-6">
                <label for="id_kerja">Pekerjaan</label>
                <select class="form-control" id="id_kerja" name="id_kerja" required disabled>
                        <option disabled selected></option>
                        @foreach ($Mpekerjaan as $i_pekerjaan)
                                <option value="{{$i_pekerjaan->id}}">{{$i_pekerjaan->nama}}</option>
                        @endforeach
                </select>

        </div>
        <div class="form-group col-md-6">
                <label for="telepon">Telepon</label>
                <input type="text" class="form-control" id="telepon" name="telepon" required readonly>
        </div>
</div>
<div class="row">
        <div class="form-group col-md-6">
                <label for="kat_kerja">Kategori Pekerjaan</label>
                <select class="form-control" id="kat_kerja" name="kat_kerja" required disabled>
                        <option disabled selected></option>
                        @foreach ($Mkatpekerjaan as $id_katkerja)
                                <option value="{{$id_katkerja->id}}">{{$id_katkerja->nama}}</option>
                        @endforeach
                </select>
        </div>
        <div class="form-group col-md-6">
                <label for="email">E-mail</label>
                <input type="text" class="form-control" id="email" name="email" readonly>
        </div>
</div>
<div class="row">
        <div class="form-group col-md-6">
                        <label for="pekerjaan_detil">Sekolah/Univ/Instansi/Detil Pekerjaan</label>
                        <input type="text" class="form-control" id="pekerjaan_detil" name="pekerjaan_detil" required readonly>

        </div>
        <div class="form-group col-md-6">
                <label for="mwarga">Kewarganegaraan</label>
                <select class="form-control" id="mwarga" name="mwarga" required disabled>
                        <option disabled selected></option>
                        @foreach ($Mwarga as $id_warga)
                                <option value="{{$id_warga->id}}">{{$id_warga->nama}}</option>
                        @endforeach
                </select>
        </div>
</div>
<div class="row">
        <div class="form-group col-md-6">
                <label for="alamat">Alamat</label>
                <textarea class="form-control" rows="4" name="alamat" id="alamat" readonly></textarea>
        </div>
        <div class="form-group col-md-6" id="pst_perlu">
                <label for="keperluan">Keperluan/Data yang dicari</label>
                <textarea class="form-control" rows="4" id="keperluan" name="keperluan" required></textarea>
        </div>
</div>
@if (ENV('APP_WEBCAM_MODE') == true)
<div class="row">
    <div class="form-group col-md-12">
        <video id="video" width="640" height="480" autoplay aria-hidden="false"></video>
        <canvas id="canvas" width="640" height="480" aria-hidden="true"></canvas>
        <br />
        <button type="button" id="ambil_foto" class="btn btn-success">Ambil Foto</button>
        <button type="button" id="reset_foto" class="btn btn-danger" disabled>Ulangi</button>
        <input type="hidden" name="foto" id="foto" />
        <button type="button" id="tanpa_webcam" class="btn btn-warning">Tanpa Webcam</button>
    </div>
</div>
@else
<div class="row">
    <div class="form-group col-md-12">
        <input type="hidden" name="foto" id="foto" />
        <button type="button" id="tanpa_webcam" class="btn btn-danger">Klik ini Tanpa Webcam</button>
    </div>
</div>
@endif
<div class="row">
        <div class="form-group col-md-6">
                        <h5>Tujuan Kedatangan : <span class="text-danger">*</span></h5>
                        <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="pst" value="1" id="pstcheck">
                                <label class="custom-control-label" for="pstcheck">Ke Pelayanan Statistik Terpadu?</label>
                        </div>
                </div>
</div>
<div class="row">
        <div class="form-group col-md-6" id="PSTlayanan">
                <h5>Layanan yang ingin diakses : <span class="text-danger">*</span></h5>
                @foreach ($Mlayanan as $item_layanan)
                        <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="pst_layanan[]" value="{{$item_layanan->id}}" id="layanan_{{$item_layanan->id}}">
                                <label class="custom-control-label" for="layanan_{{$item_layanan->id}}">{{$item_layanan->nama}}</label>
                        </div>
                @endforeach

        </div>
        <div class="form-group col-md-6" id="PSTmanfaat">
                        <h5>Pemanfaatan hasil kunjungan : <span class="text-danger">*</span></h5>
                        @foreach ($MKunjungan as $item_kunjungan)
                                <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="pst_manfaat[]" value="{{$item_kunjungan->id}}" id="kunjungan_{{$item_kunjungan->id}}">
                                        <label class="custom-control-label" for="kunjungan_{{$item_kunjungan->id}}">{{$item_kunjungan->nama}}</label>
                                </div>
                        @endforeach
        </div>

</div>
<div class="row">
        <div class="form-group col-md-6" id="PSTFasilitas">
                <h5>Fasilitas Utama : <span class="text-danger">*</span></h5>
                <select name="fasilitas_utama" class="form-control">
                    <option value="">Pilih Fasilitas</option>
                    @foreach ($Mfasilitas as $item_fasilitas)
                        <option value="{{$item_fasilitas->id}}">{{$item_fasilitas->nama}}</option>
                    @endforeach
                </select>
        </div>
</div>

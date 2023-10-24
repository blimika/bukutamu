<div id="EditBiodataMember" class="m-t-10">
    <form class="form-horizontal" name="formEditBiodata" id="formEditBiodata" action=""  method="POST">
        <div class="form-group row">
            <label class="control-label text-right col-md-3">Identitas</label>
            <div class="col-md-4" id="jenis_identitas_error">
                <select class="form-control" id="bio_jenis_identitas" name="bio_jenis_identitas" required>
                        <option value="">Pilih Jenis</option>
                        @foreach ($Midentitas as $item_identitas)
                            @if (Auth::user()->mtamu->id_midentitas == $item_identitas->id)
                            <option value="{{$item_identitas->id}}" selected>{{$item_identitas->nama}}</option>
                            @else
                                <option value="{{$item_identitas->id}}">{{$item_identitas->nama}}</option>
                            @endif

                        @endforeach
                </select>
                <small class="form-control-feedback" id="jenis_identitas_teks"></small>
            </div>
            <div class="col-md-5">
                <input type="text" class="form-control" placeholder="Nomor Identitas" value="{{Auth::user()->mtamu->nomor_identitas}}" id="bio_nomor_identitas" name="bio_nomor_identitas" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="control-label text-right col-md-3">Nama lengkap</label>
            <div class="col-md-9" id="nama_lengkap_error">
                <input type="text" class="form-control" id="bio_nama_lengkap" name="bio_nama_lengkap" value="{{Auth::user()->mtamu->nama_lengkap}}" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="control-label text-right col-md-3">Jenis Kelamin</label>
            <div class="col-md-4" id="id_jk_error">
                <select class="form-control" id="bio_id_jk" name="bio_id_jk" required>
                    <option value=""></option>
                    @foreach ($Mjk as $item_jk)
                        @if (Auth::user()->mtamu->id_jk == $item_jk->id)
                            <option value="{{$item_jk->id}}" selected>{{$item_jk->nama}}</option>
                        @else
                            <option value="{{$item_jk->id}}">{{$item_jk->nama}}</option>
                        @endif

                    @endforeach
                    </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="control-label text-right col-md-3">Tanggal lahir</label>
            <div class="col-md-4" id="tgl_lahir_error">
                <input type="text" class="form-control" id="bio_tgl_lahir" name="bio_tgl_lahir" autocomplete="off" value="{{Auth::user()->mtamu->tgl_lahir}}" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="control-label text-right col-md-3">E-Mail</label>
            <div class="col-md-9" id="email_error">
                <input type="text" class="form-control" id="bio_email" name="bio_email" value="{{Auth::user()->mtamu->email}}">
            </div>
        </div>
        <div class="form-group row">
            <label class="control-label text-right col-md-3">Nomor Handphone</label>
            <div class="col-md-9" id="telepon_error">
                <input type="text" class="form-control" id="bio_telepon" name="bio_telepon" value="{{Auth::user()->mtamu->telepon}}" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="control-label text-right col-md-3">Kewarganegaraan</label>
            <div class="col-md-9" id="mwarga_error">
                <select class="form-control" id="bio_mwarga" name="bio_mwarga" required>
                    <option value=""></option>
                    @foreach ($Mwarga as $id_warga)
                        @if (Auth::user()->mtamu->id_mwarga == $id_warga->id)
                            <option value="{{$id_warga->id}}" selected>{{$id_warga->nama}}</option>
                        @else
                            <option value="{{$id_warga->id}}">{{$id_warga->nama}}</option>
                        @endif

                    @endforeach
            </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="control-label text-right col-md-3">Alamat</label>
            <div class="col-md-9" id="alamat_error">
                <textarea class="form-control" rows="4" name="bio_alamat" id="bio_alamat">{{Auth::user()->mtamu->alamat}}</textarea>
            </div>
        </div>
        <div class="form-group row">
            <label class="control-label text-right col-md-3">Pendidikan terakhir</label>
            <div class="col-md-9" id="id_mdidik_error">
                <select class="form-control" id="bio_id_mdidik" name="bio_id_mdidik" required>
                    <option value=""></option>
                    @foreach ($Mpendidikan as $item_didik)
                        @if (Auth::user()->mtamu->id_mdidik == $item_didik->id)
                            <option value="{{$item_didik->id}}" selected>{{$item_didik->nama}}</option>
                        @else
                            <option value="{{$item_didik->id}}">{{$item_didik->nama}}</option>
                        @endif

                    @endforeach
            </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="control-label text-right col-md-3">Pekerjaan Utama</label>
            <div class="col-md-9" id="id_kerja_error">
                <select class="form-control" id="bio_id_kerja" name="bio_id_kerja" required>
                    <option value=""></option>
                    @foreach ($Mpekerjaan as $i_pekerjaan)
                        @if (Auth::user()->mtamu->id_mkerja == $i_pekerjaan->id)
                            <option value="{{$i_pekerjaan->id}}" selected>{{$i_pekerjaan->nama}}</option>
                        @else
                            <option value="{{$i_pekerjaan->id}}">{{$i_pekerjaan->nama}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="control-label text-right col-md-3">Kategori Instansi/Institusi</label>
            <div class="col-md-9" id="kat_kerja_error">
                <select class="form-control" id="bio_kat_kerja" name="bio_kat_kerja" required>
                    <option value=""></option>
                    @foreach ($Mkatpekerjaan as $id_katkerja)
                        @if (Auth::user()->mtamu->id_mkat_kerja == $id_katkerja->id)
                            <option value="{{$id_katkerja->id}}" selected>{{$id_katkerja->nama}}</option>
                        @else
                            <option value="{{$id_katkerja->id}}">{{$id_katkerja->nama}}</option>
                        @endif

                    @endforeach
            </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="control-label text-right col-md-3">Nama Instansi/Institusi</label>
            <div class="col-md-9" id="pekerjaan_detil_error">
                <input type="text" class="form-control" id="bio_pekerjaan_detil" name="bio_pekerjaan_detil" value="{{Auth::user()->mtamu->kerja_detil}}" required>
            </div>
        </div>
        <div class="form-group">
            <span id="bio_update_error" class="text-danger"></span>
        </div>
        <input type="hidden" id="bio_id" name="bio_id" value="{{Auth::user()->id}}" />
        <input type="hidden" id="bio_tamu_id" name="bio_tamu_id" value="{{Auth::user()->tamu_id}}" />
        <div class="form-group row">
            <div class="col-md-3">&nbsp;</div>
            <div class="col-md-9">
                <button type="submit" class="btn btn-success waves-effect" id="UpdateBiodata" name="UpdateBiodata">UPDATE</button>
            </div>
        </div>
        <!---batas biodata--->
    </form>
</div>

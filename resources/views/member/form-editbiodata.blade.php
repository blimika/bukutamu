<div id="EditBiodataMember" class="m-t-10">
    <form class="form-horizontal" name="formEditBiodata" id="formEditBiodata" action=""  method="POST">
        <div class="form-group row">
            <label class="control-label text-right col-md-3">Nomor Handphone</label>
            <div class="col-md-9" id="telepon_error">
                <input type="text" class="form-control" id="bio_nomor_hp" name="bio_nomor_hp" value="{{Auth::user()->Pengunjung->pengunjung_nomor_hp}}" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="control-label text-right col-md-3">Nama lengkap</label>
            <div class="col-md-9" id="nama_lengkap_error">
                <input type="text" class="form-control" id="bio_nama" name="bio_nama" value="{{Auth::user()->Pengunjung->pengunjung_nama}}" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="control-label text-right col-md-3">Jenis Kelamin</label>
            <div class="col-md-4" id="id_jk_error">
                <select class="form-control" id="bio_jk" name="bio_jk" required>
                    <option value=""></option>
                    @foreach ($Mjk as $item_jk)
                        @if (Auth::user()->Pengunjung->pengunjung_jk == $item_jk->id)
                            <option value="{{$item_jk->id}}" selected>{{$item_jk->nama}}</option>
                        @else
                            <option value="{{$item_jk->id}}">{{$item_jk->nama}}</option>
                        @endif
                    @endforeach
                    </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="control-label text-right col-md-3">Tahun lahir</label>
            <div class="col-md-4" id="tgl_lahir_error">
                <input type="text" class="form-control" id="bio_tahun_lahir" name="bio_tahun_lahir" autocomplete="off" value="{{Auth::user()->Pengunjung->pengunjung_tahun_lahir}}" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="control-label text-right col-md-3">E-Mail</label>
            <div class="col-md-9" id="email_error">
                <input type="text" class="form-control" id="bio_email" name="bio_email" value="{{Auth::user()->Pengunjung->pengunjung_email}}">
            </div>
        </div>
        <div class="form-group row">
            <label class="control-label text-right col-md-3">Pendidikan terakhir</label>
            <div class="col-md-9" id="id_mdidik_error">
                <select class="form-control" id="bio_pendidikan" name="bio_pendidikan" required>
                    <option value=""></option>
                    @foreach ($MasterPendidikan as $item_didik)
                        @if (Auth::user()->Pengunjung->pengunjung_pendidikan == $item_didik->kode)
                            <option value="{{$item_didik->kode}}" selected>{{$item_didik->nama}}</option>
                        @else
                            <option value="{{$item_didik->kode}}">{{$item_didik->nama}}</option>
                        @endif

                    @endforeach
            </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="control-label text-right col-md-3">Pekerjaan</label>
            <div class="col-md-9" id="pekerjaan_detil_error">
                <input type="text" class="form-control" id="bio_pekerjaan" name="bio_pekerjaan" value="{{Auth::user()->Pengunjung->pengunjung_pekerjaan}}" required>
            </div>
        </div>
        <div class="form-group row">
            <label class="control-label text-right col-md-3">Alamat</label>
            <div class="col-md-9" id="alamat_error">
                <textarea class="form-control" rows="4" name="bio_alamat" id="bio_alamat">{{Auth::user()->Pengunjung->pengunjung_alamat}}</textarea>
            </div>
        </div>
        <div class="form-group">
            <span id="bio_update_error" class="text-danger"></span>
        </div>
        <input type="hidden" id="bio_user_id" name="bio_user_id" value="{{Auth::user()->id}}" />
        <input type="hidden" id="bio_tamu_id" name="bio_tamu_id" value="{{Auth::user()->tamu_id}}" />
        <input type="hidden" id="bio_pengunjung_uid" name="bio_pengunjung_uid" value="{{Auth::user()->Pengunjung->pengunjung_uid}}" />
        <div class="form-group row">
            <div class="col-md-3">&nbsp;</div>
            <div class="col-md-9">
                <button type="submit" class="btn btn-success waves-effect" id="UpdateBiodata" name="UpdateBiodata">UPDATE</button>
            </div>
        </div>
        <!---batas biodata--->
    </form>
</div>

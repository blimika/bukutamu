<div class="form-group row">
    <label class="control-label text-right col-md-3">Identitas</label>
    <div class="col-md-4" id="jenis_identitas_error">
        <select class="form-control" id="jenis_identitas" name="jenis_identitas" required>
                <option value="">Pilih Jenis</option>
                @foreach ($Midentitas as $item_identitas)
                        <option value="{{$item_identitas->id}}">{{$item_identitas->nama}}</option>
                @endforeach
        </select>
        <small class="form-control-feedback" id="jenis_identitas_teks"></small>
    </div>
    <div class="col-md-5">
        <div class="row">
            <div class="col-md-7" id="nomor_identitas_error">
                    <input type="text" class="form-control" placeholder="Nomor Identitas" id="nomor_identitas" name="nomor_identitas" required>
            </div>
            <div class="col-md-5">
                    <button type="button" name="cek_id" id="cek_id" class="btn btn-info"><i class="fas fa-search"></i></button>
                    <button type="button" name="edit_id" id="edit_id" class="btn btn-success" disabled><i class="fas fa-pencil-alt"></i></button>
            </div>

        </div>
    </div>
</div>
<div class="form-group row">
    <label class="control-label text-right col-md-3">Nama lengkap</label>
    <div class="col-md-9" id="nama_lengkap_error">
        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required readonly>
    </div>
</div>
<div class="form-group row">
    <label class="control-label text-right col-md-3">Jenis Kelamin</label>
    <div class="col-md-4" id="id_jk_error">
        <select class="form-control" id="id_jk" name="id_jk" required disabled>
            <option value=""></option>
            @foreach ($Mjk as $item_jk)
                    <option value="{{$item_jk->id}}">{{$item_jk->nama}}</option>
            @endforeach
            </select>
    </div>
</div>
<div class="form-group row">
    <label class="control-label text-right col-md-3">Tanggal lahir</label>
    <div class="col-md-4" id="tgl_lahir_error">
        <input type="text" class="form-control" id="tgl_lahir" name="tgl_lahir" autocomplete="off" required readonly>
    </div>
</div>
<div class="form-group row">
    <label class="control-label text-right col-md-3">E-Mail</label>
    <div class="col-md-9" id="email_error">
        <input type="text" class="form-control" id="email" name="email" readonly>
    </div>
</div>
<div class="form-group row">
    <label class="control-label text-right col-md-3">Nomor Handphone</label>
    <div class="col-md-9" id="telepon_error">
        <input type="text" class="form-control" id="telepon" name="telepon" required readonly>
    </div>
</div>
<div class="form-group row">
    <label class="control-label text-right col-md-3">Kewarganegaraan</label>
    <div class="col-md-9" id="mwarga_error">
        <select class="form-control" id="mwarga" name="mwarga" required disabled>
            <option value=""></option>
            @foreach ($Mwarga as $id_warga)
                    <option value="{{$id_warga->id}}">{{$id_warga->nama}}</option>
            @endforeach
    </select>
    </div>
</div>
<div class="form-group row">
    <label class="control-label text-right col-md-3">Alamat</label>
    <div class="col-md-9" id="alamat_error">
        <textarea class="form-control" rows="4" name="alamat" id="alamat" readonly></textarea>
    </div>
</div>
<div class="form-group row">
    <label class="control-label text-right col-md-3">Pendidikan terakhir</label>
    <div class="col-md-4" id="id_mdidik_error">
        <select class="form-control" id="id_mdidik" name="id_mdidik" required disabled>
            <option value=""></option>
            @foreach ($Mpendidikan as $item_didik)
                    <option value="{{$item_didik->id}}">{{$item_didik->nama}}</option>
            @endforeach
    </select>
    </div>
</div>
<div class="form-group row">
    <label class="control-label text-right col-md-3">Pekerjaan Utama</label>
    <div class="col-md-4" id="id_kerja_error">
        <select class="form-control" id="id_kerja" name="id_kerja" required disabled>
            <option value=""></option>
            @foreach ($Mpekerjaan as $i_pekerjaan)
                    <option value="{{$i_pekerjaan->id}}">{{$i_pekerjaan->nama}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    <label class="control-label text-right col-md-3">Kategori Instansi/Institusi</label>
    <div class="col-md-6" id="kat_kerja_error">
        <select class="form-control" id="kat_kerja" name="kat_kerja" required disabled>
            <option value=""></option>
            @foreach ($Mkatpekerjaan as $id_katkerja)
                    <option value="{{$id_katkerja->id}}">{{$id_katkerja->nama}}</option>
            @endforeach
    </select>
    </div>
</div>
<div class="form-group row">
    <label class="control-label text-right col-md-3">Nama Instansi/Institusi</label>
    <div class="col-md-9" id="pekerjaan_detil_error">
        <input type="text" class="form-control" id="pekerjaan_detil" name="pekerjaan_detil" required readonly>
    </div>
</div>
<!---batas biodata--->

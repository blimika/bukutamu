<div class="form-group row">
    <label class="control-label text-right col-md-3">Nomor Handphone</label>
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-6" id="nomor_hp_error">
                <input type="text" class="form-control" placeholder="Nomor WhatsApp (08xxxx)" id="nomor_hp" name="nomor_hp" required>
            </div>
            <div class="col-md-6">
                    <button type="button" name="cek_hp" id="cek_hp" class="btn btn-info"><i class="fas fa-search"></i></button>
                    <button type="button" name="edit_hp" id="edit_hp" class="btn btn-success" disabled><i class="fas fa-pencil-alt"></i></button>
            </div>

        </div>
    </div>
</div>
<div class="form-group row">
    <label class="control-label text-right col-md-3">Nama lengkap</label>
    <div class="col-md-9" id="pengunjung_nama_error">
        <input type="text" class="form-control border-black" id="pengunjung_nama" name="pengunjung_nama" required readonly>
    </div>
</div>
<div class="form-group row">
    <label class="control-label text-right col-md-3">Jenis Kelamin</label>
    <div class="col-md-4" id="pengunjung_jk_error">
        <select class="form-control" id="pengunjung_jk" name="pengunjung_jk" required disabled>
            <option value=""></option>
            @foreach ($Mjk as $item_jk)
                    <option value="{{$item_jk->id}}">{{$item_jk->nama}}</option>
            @endforeach
            </select>
    </div>
</div>
<div class="form-group row">
    <label class="control-label text-right col-md-3">Tahun lahir</label>
    <div class="col-md-4" id="pengunjung_tahun_lahir_error">
        <input type="text" class="form-control" id="pengunjung_tahun_lahir" name="pengunjung_tahun_lahir" required readonly>
    </div>
</div>
<div class="form-group row">
    <label class="control-label text-right col-md-3">Pekerjaan</label>
    <div class="col-md-9" id="pengunjung_pekerjaan_error">
        <input type="text" class="form-control border-black" id="pengunjung_pekerjaan" name="pengunjung_pekerjaan" required readonly>
    </div>
</div>
<div class="form-group row">
    <label class="control-label text-right col-md-3">Pendidikan terakhir</label>
    <div class="col-md-4" id="pengunjung_pendidikan_error">
        <select class="form-control" id="pengunjung_pendidikan" name="pengunjung_pendidikan" required disabled>
            <option value=""></option>
            @foreach ($MasterPendidikan as $item_didik)
                    <option value="{{$item_didik->id}}">{{$item_didik->nama}}</option>
            @endforeach
    </select>
    </div>
</div>
<div class="form-group row">
    <label class="control-label text-right col-md-3">E-Mail</label>
    <div class="col-md-9" id="pengunjung_email_error">
        <input type="text" class="form-control" id="pengunjung_email" name="pengunjung_email" readonly>
    </div>
</div>
<div class="form-group row">
    <label class="control-label text-right col-md-3">Alamat</label>
    <div class="col-md-9" id="pengunjung_alamat_error">
        <textarea class="form-control" rows="4" name="pengunjung_alamat" id="pengunjung_alamat" readonly></textarea>
    </div>
</div>

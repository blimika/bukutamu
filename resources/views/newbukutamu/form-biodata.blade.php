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
    <div class="col-md-9" id="nama_lengkap_error">
        <input type="text" class="form-control border-black" id="nama_lengkap" name="nama_lengkap" required readonly>
    </div>
</div>
<div class="form-group row">
    <label class="control-label text-right col-md-3">Jenis Kelamin</label>
    <div class="col-md-4" id="id_jk_error">
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
    <div class="col-md-4" id="tgl_lahir_error">
        <input type="text" class="form-control" id="tahun_lahir" name="tahun_lahir" autocomplete="off" required readonly>
    </div>
</div>
<div class="form-group row">
    <label class="control-label text-right col-md-3">Pekerjaan</label>
    <div class="col-md-9" id="pekerjaan_error">
        <input type="text" class="form-control border-black" id="pekerjaan" name="pekerjaan" required readonly>
    </div>
</div>
<div class="form-group row">
    <label class="control-label text-right col-md-3">Pendidikan terakhir</label>
    <div class="col-md-4" id="pendidikan_id_error">
        <select class="form-control" id="pendidikan_id" name="pendidikan_id" required disabled>
            <option value=""></option>
            @foreach ($MasterPendidikan as $item_didik)
                    <option value="{{$item_didik->id}}">{{$item_didik->nama}}</option>
            @endforeach
    </select>
    </div>
</div>
<div class="form-group row">
    <label class="control-label text-right col-md-3">E-Mail</label>
    <div class="col-md-9" id="email_error">
        <input type="text" class="form-control" id="email" name="email" readonly>
    </div>
</div>

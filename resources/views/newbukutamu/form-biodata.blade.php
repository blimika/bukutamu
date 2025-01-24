<div class="form-group row">
    <label class="control-label text-right col-md-3">Nomor Handphone</label>
    <div class="col-md-9" id="telepon_error">
        <input type="text" class="form-control" id="telepon" name="telepon" required readonly>
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
        <select class="form-control" id="id_jk" name="id_jk" required disabled>
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
    <div class="col-md-4" id="id_mdidik_error">
        <select class="form-control" id="id_mdidik" name="id_mdidik" required>
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

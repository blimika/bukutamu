<div class="form-group row">
    <label class="control-label text-right col-md-3" id="tujuan_label">Tujuan</label>
    <div class="col-md-9" id="tujuan_error">
        <select class="form-control" id="kunjungan_tujuan" name="kunjungan_tujuan">
            <option value="">Pilih salah satu</option>
            @foreach ($MasterTujuan as $item)
                <option value="{{$item->kode}}">{{$item->nama}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row" id="PSTLayanan">
    <label class="control-label text-right col-md-3" id="layananpst_label">Layanan PST</label>
    <div class="col-md-9" id="tujuan_error">
        <select class="form-control" id="layananpst_kode" name="layananpst_kode">
            <option value="">Pilih salah satu</option>
            @foreach ($MasterLayananPST as $item)
                <option value="{{$item->kode}}">{{$item->nama}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row">
    <label class="control-label text-right col-md-3" id="keperluan_label">Keperluan</label>
    <div class="col-md-9" id="keperluan_error">
        <textarea class="form-control" rows="4" id="keperluan" name="keperluan" required></textarea>
    </div>
</div>

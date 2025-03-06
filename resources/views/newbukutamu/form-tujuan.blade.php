<div class="form-group row">
    <label class="control-label text-right col-md-3" id="tujuan_label">Tujuan</label>
    <div class="col-md-9" id="kunjungan_tujuan_error">
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
    <div class="col-md-9" id="layananpst_kode_error">
        <select class="form-control" id="layananpst_kode" name="layananpst_kode">
            <option value="">Pilih salah satu</option>
            @foreach ($MasterLayananPST as $item)
                <option value="{{$item->kode}}">{{$item->nama}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row" id="LayananKantor">
    <label class="control-label text-right col-md-3" id="layanan_kantor_kode_label">Layanan Kantor</label>
    <div class="col-md-9" id="layanan_kantor_kode_error">
        <select class="form-control" id="layanan_kantor_kode" name="layanan_kantor_kode">
            <option value="">Pilih salah satu</option>
            @foreach ($MasterLayananKantor as $item)
                <option value="{{$item->kode}}">{{$item->nama}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row">
    <label class="control-label text-right col-md-3" id="keperluan_label">Keperluan</label>
    <div class="col-md-9" id="kunjungan_keperluan_error">
        <textarea class="form-control" rows="4" id="kunjungan_keperluan" name="kunjungan_keperluan" required></textarea>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-6">
        <div class="custom-control custom-radio">
            <input type="radio" id="kantorcheck" name="tujuan_kedatangan" value="0" class="custom-control-input" required checked="checked">
            <label class="custom-control-label" for="kantorcheck">Kantor</label>
        </div>
        <div class="custom-control custom-radio">
            <input type="radio" id="pstcheck" name="tujuan_kedatangan" value="1" class="custom-control-input">
            <label class="custom-control-label" for="pstcheck">Pelayanan Statistik Terpadu</label>
        </div>

    </div>
</div>
<div class="form-group row" id="PSTManfaat">
    <div class="col-md-3">
    <label class="control-label text-right">Pemanfaatan hasil kunjungan</label>
    </div>
    <div class="col-md-6">
        <select class="form-control" id="id_manfaat" name="id_manfaat">
            <option value="">Pilih salah satu</option>
            @foreach ($MManfaat as $i_manfaat)
                    <option value="{{$i_manfaat->id}}">{{$i_manfaat->nama}}</option>
            @endforeach
        </select>
        <br />
        <input type="text" name="manfaat_nama" id="manfaat_nama" class="form-control manfaat_nama" placeholder="Pemanfaatan hasil kunjungan lainnya"/>
    </div>
</div>
<div class="form-group row" id="LayananUtama">
    <div class="col-md-3">
    <label class="control-label text-right">Layanan Utama</label>
    </div>
    <div class="col-md-6">
        <select class="form-control" id="layanan_id" name="layanan_id">
            <option value="">Pilih salah satu</option>
            @foreach ($LayananUtama as $i_layanan)
                    <option value="{{$i_layanan->kode}}">{{$i_layanan->nama}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="row">
        <div class="form-group col-md-6" id="PSTLayanan">
                <h5>Layanan yang ingin diakses : <span class="text-danger">*</span></h5>
                @foreach ($Mlayanan as $item_layanan)
                        <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input pst_layanan" name="pst_layanan[]" value="{{$item_layanan->id}}" id="layanan_{{$item_layanan->id}}">
                                <label class="custom-control-label" for="layanan_{{$item_layanan->id}}">{{$item_layanan->nama}}</label>
                        </div>
                @endforeach

        </div>
        <div class="form-group col-md-6" id="PSTFasilitas">
                        <h5>Fasilitas yang Digunakan : <span class="text-danger">*</span></h5>
                        @foreach ($Mfasilitas as $item_fasilitas)
                                <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input pst_fasilitas" name="pst_fasilitas[]" value="{{$item_fasilitas->id}}" id="fasilitas_{{$item_fasilitas->id}}">
                                        <label class="custom-control-label" for="fasilitas_{{$item_fasilitas->id}}">{{$item_fasilitas->nama}}</label>
                                </div>
                        @endforeach
                        <input type="text" name="fas_lainnya" id="fas_lainnya" class="form-control fas_lainnya" placeholder="Fasilitas lainnya yang digunakan"/>
        </div>

</div>
<div class="form-group row">
    <label class="control-label text-right col-md-3" id="keperluan_label">Keperluan</label>
    <div class="col-md-9" id="keperluan_error">
        <textarea class="form-control" rows="4" id="keperluan" name="keperluan" required></textarea>
    </div>
</div>

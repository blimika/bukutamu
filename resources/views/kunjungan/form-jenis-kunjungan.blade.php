<div class="form-group row">
    <label class="control-label text-right col-md-3">Jenis Kunjungan</label>
    <div class="col-md-9" id="jenis_kunjungan">
        <div class="form-group col-md-12">
            <div class="custom-control custom-radio">
                <input type="radio" id="perorangan" name="jenis_kunjungan" value="1" class="custom-control-input" required checked="checked">
                <label class="custom-control-label radio-inline" for="perorangan">Perorangan</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" id="kelompok" name="jenis_kunjungan" value="2" class="custom-control-input">
                <label class="custom-control-label radio-inline" for="kelompok">Kelompok</label>
            </div>
            <div class="input-group" id="jumlah_tamu_teks">
                <div class="input-group-prepend">
                    <button class="btn btn-success" type="button">J</button>
                </div>
            <input type="number" name="jumlah_tamu" id="jumlah_tamu" value="1" class="form-control jumlah_tamu col-md-3" placeholder="Jumlah tamu"/>
            </div>
            <div class="input-group" id="tamu_laki_teks">
                <div class="input-group-prepend text-info">
                    <button class="btn btn-info" type="button">L</button>
                </div>
                <input type="number" name="tamu_laki" id="tamu_laki" value="0" class="form-control tamu_laki col-md-3" placeholder="Laki-laki"/>
            </div>
            <div class="input-group" id="tamu_wanita_teks">
                <div class="input-group-prepend">
                    <button class="btn btn-danger" type="button">P</button>
                </div>
            <input type="number" name="tamu_wanita" id="tamu_wanita" value="0" class="form-control tamu_wanita col-md-3" placeholder="Perempuan"/>
            </div>
        </div>
    </div>
</div>

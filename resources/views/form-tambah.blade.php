<div class="row">
    <div class="form-group col-md-6 m-b-40">
            <select class="form-control p-0" id="jenis_identitas" name="jenis_identitas" required>
                <option value=""></option>
                <option value="KTP">KTP</option>
                <option value="KARTU MAHASISWA">Kartu Mahasiswa</option>
                <option value="SIM">SIM</option>
                <option value="PASPOR">Paspor</option>
                <option value="LAINNYA">Lainnya</option>
            </select><span class="bar"></span>
            <label for="jenis_identitas">Jenis Identitas</label>
    </div>
    <div class="form-group col-md-6 row m-b-40">
            <div class="col-md-10">
                    <input type="text" class="form-control" id="nomor_identitas" name="nomor_identitas" required>
                    <span class="bar"></span>
                    <label for="nomor_identitas">Nomor identitas</label>
            </div>
            <div class="col-md-2">
                    <button type="button" name="cek_id" class="btn btn-info">CEK</button>
            </div>
        </div>
</div>

<div class="row">
        <div class="form-group col-md-6 m-b-40">
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                <span class="bar"></span>
                <label for="nama_lengkap">Nama lengkap</label>
        </div>
        <div class="form-group col-md-6 m-b-40">
                <select class="form-control p-0" id="jk" name="jk" required>
                    <option value=""></option>
                    <option value="L">Laki-Laki</option>
                    <option value="P">Perempuan</option>
                </select><span class="bar"></span>
                <label for="jk">Jenis Kelamin</label>
        </div>
</div>
<div class="row">
        <div class="form-group col-md-6 m-b-40">
                <input type="text" class="form-control" id="tgl_lahir" name="tgl_lahir" autocomplete="off" required>
                <span class="bar"></span>
                <label for="tgl_lahir">Tanggal lahir</label>
        </div>
        
        <div class="form-group col-md-6 m-b-40">
                <select class="form-control p-0" id="pendidikan" name="pendidikan" required>
                    <option value=""></option>
                    <option value="<=SMA"><=SMA</option>
                    <option value="D-III">D-III</option>
                    <option value="D-IV/S1">D-IV/S1</option>
                    <option value="S2/S3">S2/S3</option>
                </select><span class="bar"></span>
                <label for="pendidikan">Pendidikan</label>
        </div>
</div>
<div class="row">
        <div class="form-group col-md-6 m-b-40">
                <select class="form-control p-0" id="pekerjaan" name="pekerjaan" required>
                    <option value=""></option>
                    <option value="PELAJAR">Pelajar</option>
                    <option value="MAHASISWA">Mahasiswa</option>
                    <option value="PNS/ASN">PNS/ASN</option>
                    <option value="SWASTA">Swasta</option>
                    <option value="LAINNYA">Lainnya</option>
                </select><span class="bar"></span>
                <label for="pekerjaan">Pekerjaan</label>
        </div>
        <div class="form-group col-md-6 m-b-40">
                <input type="text" class="form-control" id="pekerjaan_detil" name="pekerjaan_detil" required>
                <span class="bar"></span>
                <label for="pekerjaan_detil">Sekolah/Univ/Instansi/Detil Pekerjaan</label>
        </div>
</div>
<div class="row">
        <div class="form-group col-md-6 m-b-40">
                <select class="form-control p-0" id="tujuan" name="tujuan" required>
                    <option value=""></option>
                    <option value="PST">Pelayanan Statistik Terpadu</option>
                    <option value="BERKUNJUNG">Berkunjung</option>
                    <option value="LAINNYA">Lainnya</option>
                </select><span class="bar"></span>
                <label for="tujuan">Tujuan Kedatangan</label>
        </div>
</div>

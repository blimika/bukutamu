<h4 class="box-title"><strong>Biodata Pengunjung</strong></h4>
<hr class="m-t-0 m-b-20">
<div class="row">
    <div class="form-group col-md-6">
        <label for="jenis_identitas">Jenis Identitas</label>
            <select class="form-control" id="jenis_identitas" name="jenis_identitas" required>
                <option disabled selected></option>
                @foreach ($Midentitas as $item_identitas)
                        <option value="{{$item_identitas->id}}">{{$item_identitas->nama}}</option>
                @endforeach
        </select>
            
    </div>
    <div class="form-group col-md-6 row">
            <div class="col-md-10">
                    <label for="nomor_identitas">Nomor identitas</label>
                    <input type="text" class="form-control" id="nomor_identitas" name="nomor_identitas" required>                    
            </div>
            <div class="col-md-2">
                        <label for="cek_id">&nbsp;</label>
                    <button type="button" name="cek_id" class="btn btn-info">CEK</button>
            </div>
        </div>
</div>

<div class="row">
        <div class="form-group col-md-6">
                <label for="nama_lengkap">Nama lengkap</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>                
        </div>
        <div class="form-group col-md-6 m-b-40">
                <label for="jk">Jenis Kelamin</label>
                <select class="form-control" id="jk" name="jk" required>
                <option disabled selected></option>
                @foreach ($Mjk as $item_jk)
                        <option value="{{$item_jk->id}}">{{$item_jk->nama}}</option>
                @endforeach  
                </select>             
        </div>
</div>
<div class="row">
        <div class="form-group col-md-6">
                <label for="tgl_lahir">Tanggal lahir</label>
                <input type="text" class="form-control" id="tgl_lahir" name="tgl_lahir" autocomplete="off" required>
        </div>
        <div class="form-group col-md-6">
                <label for="id_mdidik">Pendidikan terakhir</label>
                <select class="form-control" id="id_mdidik" name="id_mdidik" required>
                        <option disabled selected></option>
                        @foreach ($Mpendidikan as $item_didik)
                                <option value="{{$item_didik->id}}">{{$item_didik->nama}}</option>
                        @endforeach
                </select>
                
        </div>
</div>
<div class="row">
        <div class="form-group col-md-6">
                <label for="id_kerja">Pekerjaan</label>
                <select class="form-control" id="id_kerja" name="id_kerja" required>
                        <option disabled selected></option>
                        @foreach ($Mpekerjaan as $i_pekerjaan)
                                <option value="{{$i_pekerjaan->id}}">{{$i_pekerjaan->nama}}</option>
                        @endforeach
                </select>
                
        </div>
        <div class="form-group col-md-6">
                <label for="telepon">Telepon</label>
                <input type="text" class="form-control" id="telepon" name="telepon" required>      
        </div>
</div>
<div class="row">
        <div class="form-group col-md-6">
                <label for="kat_kerja">Kategori Pekerjaan</label>
                <select class="form-control" id="kat_kerja" name="kat_kerja" required>
                        <option disabled selected></option>
                        @foreach ($Mkatpekerjaan as $id_katkerja)
                                <option value="{{$id_katkerja->id}}">{{$id_katkerja->nama}}</option>
                        @endforeach
                </select>
        </div>
        <div class="form-group col-md-6">
                <label for="email">E-mail</label>
                <input type="text" class="form-control" id="email" name="email"> 
        </div>
</div>
<div class="row">
        <div class="form-group col-md-6">
                        <label for="pekerjaan_detil">Sekolah/Univ/Instansi/Detil Pekerjaan</label>
                        <input type="text" class="form-control" id="pekerjaan_detil" name="pekerjaan_detil" required> 
                        
        </div>
        <div class="form-group col-md-6">
                <label for="mwarga">Kewarganegaraan</label>
                <select class="form-control" id="mwarga" name="mwarga" required>
                        <option disabled selected></option>
                        @foreach ($Mwarga as $id_warga)
                                <option value="{{$id_warga->id}}">{{$id_warga->nama}}</option>
                        @endforeach
                </select>
        </div>
</div>
<div class="row">
        <div class="form-group col-md-6">
                <label for="alamat">Alamat</label>
                <textarea class="form-control" rows="4" name="alamat" id="alamat"></textarea>           
        </div>
        <div class="form-group col-md-6" id="pst_perlu">
                <label for="keperluan">Keperluan/Data yang dicari</label>
                <textarea class="form-control" rows="4" id="keperluan" name="keperluan"></textarea> 
        </div>
</div>
<div class="row">
        <div class="form-group col-md-6">
                        <h5>Tujuan Kedatangan : <span class="text-danger">*</span></h5>
                        <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="pst" value="1" id="pstcheck">
                                <label class="custom-control-label" for="pstcheck">Ke Pelayanan Statistik Terpadu?</label>
                        </div>            
                </div>                
</div>
<div class="row">
        <div class="form-group col-md-6" id="pst_layanan">
                <h5>Layanan yang ingin diakses : <span class="text-danger">*</span></h5>
                @foreach ($Mlayanan as $item_layanan)
                        <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="pst_layanan[]" value="{{$item_layanan->id}}" id="layanan_{{$item_layanan->id}}">
                                <label class="custom-control-label" for="layanan_{{$item_layanan->id}}">{{$item_layanan->nama}}</label>
                        </div> 
                @endforeach
                
        </div>
        <div class="form-group col-md-6" id="pst_manfaat">
                        <h5>Pemanfaatan hasil kunjungan : <span class="text-danger">*</span></h5>
                        @foreach ($MKunjungan as $item_kunjungan)
                                <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="pst_manfaat[]" value="{{$item_kunjungan->id}}" id="kunjungan_{{$item_kunjungan->id}}">
                                        <label class="custom-control-label" for="kunjungan_{{$item_kunjungan->id}}">{{$item_kunjungan->nama}}</label>
                                </div> 
                        @endforeach
        </div>
</div>
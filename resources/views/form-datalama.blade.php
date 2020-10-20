<h4 class="box-title"><strong>Biodata Pengunjung</strong></h4>
<hr class="m-t-0 m-b-20">
<div class="row">
    <div class="form-group col-md-6">
            <label for="tgl_kunjungan">Tanggal Kunjungan</label>
            <input type="text" class="form-control" id="tgl_kunjungan" name="tgl_kunjungan" autocomplete="off" required>
    </div>
    <div class="form-group col-md-6">            
    </div>
</div>
<div class="row">
    <div class="form-group col-md-4">
        <label for="jenis_identitas_lama">Jenis Identitas</label>
            <select class="form-control" id="jenis_identitas_lama" name="jenis_identitas_lama" required>
                <option disabled selected></option>
                @foreach ($Midentitas as $item_identitas)
                        <option value="{{$item_identitas->id}}">{{$item_identitas->nama}}</option>
                @endforeach
        </select>
            
    </div>
    <div class="form-group col-md-8">
            <div class="row">
                <div class="col-md-8">
                        <label for="nomor_identitas_lama">Nomor identitas</label>
                        <input type="text" class="form-control" id="nomor_identitas_lama" name="nomor_identitas_lama" required>                    
                </div>
                <div class="col-md-4">
                        <br />
                        <button type="button" name="cekid_lama" id="cekid_lama" class="btn btn-success">CEK ID</button>
                        <button type="button" name="editid_lama" id="editid_lama" class="btn btn-info" disabled><i class="fas fa-pencil-alt"></i> Edit</button>
                </div>
                
            </div>
     </div>
</div>

<div class="row">
        <div class="form-group col-md-6">
                <label for="nama_lengkap_lama">Nama lengkap</label>
                <input type="text" class="form-control" id="nama_lengkap_lama" name="nama_lengkap_lama" required readonly>                
        </div>
        <div class="form-group col-md-6 m-b-40">
                <label for="id_jk_lama">Jenis Kelamin</label>
                <select class="form-control" id="id_jk_lama" name="id_jk_lama" required disabled>
                <option disabled selected></option>
                @foreach ($Mjk as $item_jk)
                        <option value="{{$item_jk->id}}">{{$item_jk->nama}}</option>
                @endforeach  
                </select>             
        </div>
</div>
<div class="row">
        <div class="form-group col-md-6">
                <label for="tgl_lahir_lama">Tanggal lahir</label>
                <input type="text" class="form-control" id="tgl_lahir_lama" name="tgl_lahir_lama" autocomplete="off" required readonly>
        </div>
        <div class="form-group col-md-6">
                <label for="id_mdidik_lama">Pendidikan terakhir</label>
                <select class="form-control" id="id_mdidik_lama" name="id_mdidik_lama" required disabled>
                        <option disabled selected></option>
                        @foreach ($Mpendidikan as $item_didik)
                                <option value="{{$item_didik->id}}">{{$item_didik->nama}}</option>
                        @endforeach
                </select>
                
        </div>
</div>
<div class="row">
        <div class="form-group col-md-6">
                <label for="id_kerja_lama">Pekerjaan</label>
                <select class="form-control" id="id_kerja_lama" name="id_kerja_lama" required disabled>
                        <option disabled selected></option>
                        @foreach ($Mpekerjaan as $i_pekerjaan)
                                <option value="{{$i_pekerjaan->id}}">{{$i_pekerjaan->nama}}</option>
                        @endforeach
                </select>
                
        </div>
        <div class="form-group col-md-6">
                <label for="telepon_lama">Telepon</label>
                <input type="text" class="form-control" id="telepon_lama" name="telepon_lama" required readonly>      
        </div>
</div>
<div class="row">
        <div class="form-group col-md-6">
                <label for="kat_kerja_lama">Kategori Pekerjaan</label>
                <select class="form-control" id="kat_kerja_lama" name="kat_kerja_lama" required disabled>
                        <option disabled selected></option>
                        @foreach ($Mkatpekerjaan as $id_katkerja)
                                <option value="{{$id_katkerja->id}}">{{$id_katkerja->nama}}</option>
                        @endforeach
                </select>
        </div>
        <div class="form-group col-md-6">
                <label for="email_lama">E-mail</label>
                <input type="text" class="form-control" id="email_lama" name="email_lama" readonly> 
        </div>
</div>
<div class="row">
        <div class="form-group col-md-6">
                        <label for="pekerjaan_detil_lama">Sekolah/Univ/Instansi/Detil Pekerjaan</label>
                        <input type="text" class="form-control" id="pekerjaan_detil_lama" name="pekerjaan_detil_lama" required readonly> 
                        
        </div>
        <div class="form-group col-md-6">
                <label for="mwarga_lama">Kewarganegaraan</label>
                <select class="form-control" id="mwarga_lama" name="mwarga_lama" required disabled>
                        <option disabled selected></option>
                        @foreach ($Mwarga as $id_warga)
                                <option value="{{$id_warga->id}}">{{$id_warga->nama}}</option>
                        @endforeach
                </select>
        </div>
</div>
<div class="row">
        <div class="form-group col-md-6">
                <label for="alamat_lama">Alamat</label>
                <textarea class="form-control" rows="4" name="alamat_lama" id="alamat_lama" readonly></textarea>           
        </div>
        <div class="form-group col-md-6" id="keperluan_lama">
                <label for="keperluan">Keperluan/Data yang dicari</label>
                <textarea class="form-control" rows="4" id="keperluan_lama" name="keperluan_lama"></textarea> 
        </div>
</div>
<div class="row">
        <div class="form-group col-md-6">
                        <h5>Tujuan Kedatangan : <span class="text-danger">*</span></h5>
                        <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="pst_lama" value="1" id="pstcheck_lama">
                                <label class="custom-control-label" for="pstcheck_lama">Ke Pelayanan Statistik Terpadu?</label>
                        </div>            
                </div>                
</div>
<div class="row">
        <div class="form-group col-md-6" id="PSTlayanan_lama">
                <h5>Layanan yang ingin diakses : <span class="text-danger">*</span></h5>
                @foreach ($Mlayanan as $item_layanan)
                        <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="pst_layanan_lama[]" value="{{$item_layanan->id}}" id="layanan_lama_{{$item_layanan->id}}">
                                <label class="custom-control-label" for="layanan_lama_{{$item_layanan->id}}">{{$item_layanan->nama}}</label>
                        </div> 
                @endforeach
                
        </div>
        <div class="form-group col-md-6" id="PSTmanfaat_lama">
                        <h5>Pemanfaatan hasil kunjungan : <span class="text-danger">*</span></h5>
                        @foreach ($MKunjungan as $item_kunjungan)
                                <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="pst_manfaat_lama[]" value="{{$item_kunjungan->id}}" id="kunjungan_lama_{{$item_kunjungan->id}}">
                                        <label class="custom-control-label" for="kunjungan_lama_{{$item_kunjungan->id}}">{{$item_kunjungan->nama}}</label>
                                </div> 
                        @endforeach
        </div>
</div>
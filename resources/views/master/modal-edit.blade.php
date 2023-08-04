<div class="modal fade" id="EditMasterModal" tabindex="-1" role="dialog" aria-labelledby="vcenter">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-white" id="EditMasterModal">Edit Data Pengunjung</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal m-t-4" name="formEditMasterPengunjung" id="formEditMasterPengunjung" action=""  method="POST">
                    <input type="hidden" name="tamu_id" id="tamu_id" value=""/>
                    <dl class="row">
                    <dt class="col-sm-4">ID</dt>
                    <dd class="col-sm-8"><span id="tamu_id_teks"></span></dd>
                    </dl>
                   <!--<div class="row">
                    <img src="" id="foto_kunjungan" class="col-sm-12">
                   </div>-->
                    <hr class="m-t-0 m-b-4">
                    <div class="form-group">
                        <label for="jenis_identitas">Identitas</label>
                        <div class="row">
                            <div class="col-md-6">
                                <select class="form-control" id="jenis_identitas" name="jenis_identitas" required>
                                        <option value="">Pilih Jenis</option>
                                        @foreach ($Midentitas as $item_identitas)
                                                <option value="{{$item_identitas->id}}">{{$item_identitas->nama}}</option>
                                        @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Nomor Identitas" id="nomor_identitas" name="nomor_identitas" required>
                                  
                            </div>
                        </div>
                       
                    </div>

                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_lengkap" aria-describedby="nama_lengkap" placeholder="Nama Lengkap" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Jenis Kelamin</label>

                            <select class="form-control" id="id_jk" name="id_jk" required>
                                <option value=""></option>
                                @foreach ($Mjk as $item_jk)
                                        <option value="{{$item_jk->id}}">{{$item_jk->nama}}</option>
                                @endforeach
                                </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Tanggal lahir</label>
                        <input type="text" class="form-control" id="tgl_lahir" name="tgl_lahir" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">E-Mail</label>
                            <input type="text" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Nomor Handphone</label>
                            <input type="text" class="form-control" id="telepon" name="telepon" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Kewarganegaraan</label>
                            <select class="form-control" id="mwarga" name="mwarga" required>
                                <option value=""></option>
                                @foreach ($Mwarga as $id_warga)
                                        <option value="{{$id_warga->id}}">{{$id_warga->nama}}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Alamat</label>
                            <textarea class="form-control" rows="4" name="alamat" id="alamat"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Pendidikan terakhir</label>
                            <select class="form-control" id="id_mdidik" name="id_mdidik" required>
                                <option value=""></option>
                                @foreach ($Mpendidikan as $item_didik)
                                        <option value="{{$item_didik->id}}">{{$item_didik->nama}}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Pekerjaan Utama</label>
                            <select class="form-control" id="id_kerja" name="id_kerja" required>
                                <option value=""></option>
                                @foreach ($Mpekerjaan as $i_pekerjaan)
                                        <option value="{{$i_pekerjaan->id}}">{{$i_pekerjaan->nama}}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Kategori Instansi/Institusi</label>
                            <select class="form-control" id="kat_kerja" name="kat_kerja" required>
                                <option value=""></option>
                                @foreach ($Mkatpekerjaan as $id_katkerja)
                                        <option value="{{$id_katkerja->id}}">{{$id_katkerja->nama}}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Nama Instansi/Institusi</label>
                            <input type="text" class="form-control" id="pekerjaan_detil" name="pekerjaan_detil" required>
                    </div>
                    <div class="form-group">
                        <span id="edit_pengunjung_error" class="text-danger"></span>
                    </div>
                    
            </div>
            <div class="modal-footer">
                <a href="" class="btn btn-warning waves-effect" id="tamu_timeline">TIMELINE</a>
                <button type="submit" class="btn btn-success waves-effect" id="updateDataPengunjung" data-dismiss="modal">UPDATE DATA</button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </form>
        </div>
    </div>
</div>
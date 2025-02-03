<div class="modal fade" id="ViewKunjunganModal" tabindex="-1" role="dialog" aria-labelledby="vcenter">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title" id="ViewKunjunganModal">View Data Kunjungan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <dl class="row">
                    <dt class="col-sm-4">ID</dt>
                    <dd class="col-sm-8"><span id="kunjungan_id"></span></dd>
                    <dt class="col-sm-4">UID</dt>
                    <dd class="col-sm-8"><span id="kunjungan_uid"></span></dd>
                    <dt class="col-sm-4">Nama</dt>
                    <dd class="col-sm-8"><span id="pengunjung_nama"></span></dd>
                    <dt class="col-sm-4">Jenis Kelamin</dt>
                    <dd class="col-sm-8"><span id="pengunjung_jk"></span></dd>
                    <dt class="col-sm-4">Tahun Lahir</dt>
                    <dd class="col-sm-8"><span id="pengunjung_tahun_lahir"></span></dd>
                    <dt class="col-sm-4">Pekerjaan</dt>
                    <dd class="col-sm-8"><span id="pengunjung_pekerjaan"></span></dd>
                    <dt class="col-sm-4">Pendidikan</dt>
                    <dd class="col-sm-8"><span id="pengunjung_pendidikan"></span></dd>
                    <dt class="col-sm-4">E-mail</dt>
                    <dd class="col-sm-8"><span id="pengunjung_email"></span></dd>
                    <dt class="col-sm-4">Nomor HP</dt>
                    <dd class="col-sm-8"><span id="pengunjung_nomor_hp"></span> <a href="" id="pengunjung_wa" target="_blank" class="btn waves-effect btn-success btn-xs waves-light"><i class="fab fa-whatsapp"></i></a></dd>
                    <dt class="col-sm-4">Alamat</dt>
                    <dd class="col-sm-8"><span id="pengunjung_alamat"></span></dd>
                    <hr style="width: 100%; color: black; height: 1px;" />
                    <dt class="col-sm-4">Foto Kunjungan</dt>
                    <dd class="col-sm-12"><img src="" id="kunjungan_foto" class="col-sm-12"></dd>
                    <dt class="col-sm-4">Tanggal</dt>
                    <dd class="col-sm-8"><span id="kunjungan_tanggal"></span></dd>
                    <dt class="col-sm-4">Jenis</dt>
                    <dd class="col-sm-8"><span id="kunjungan_jenis"></span></dd>
                    <dt class="col-sm-4">Tujuan</dt>
                    <dd class="col-sm-8"><span id="kunjungan_tujuan"></span></dd>
                    <dt class="col-sm-4">Nomor Antrian</dt>
                    <dd class="col-sm-8"><span id="kunjungan_nomor_antrian"></span></dd>
                    <dt class="col-sm-4">Flag Antrian</dt>
                    <dd class="col-sm-8"><span id="kunjungan_flag_antrian"></span></dd>
                    <dt class="col-sm-4">Mulai Layanan</dt>
                    <dd class="col-sm-8"><span id="kunjungan_jam_datang"></span></dd>
                    <dt class="col-sm-4">Akhir Layanan</dt>
                    <dd class="col-sm-8"><span id="kunjungan_jam_pulang"></span></dd>
                    <dt class="col-sm-12">Keperluan/Data dicari</dt>
                    <dd class="col-sm-12"><span id="kunjungan_keperluan"></span></dd>
                    <dt class="col-sm-12">Tindak Lanjut</dt>
                    <dd class="col-sm-12"><span id="kunjungan_tindak_lanjut"></span></dd>
                </dl>

            </div>
            <div class="modal-footer">
                <a href="" class="btn btn-success waves-effect" id="pengunjung_timeline">TIMELINE</a>
                <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!---flag antrian modal--->
<div class="modal fade" id="EditFlagAntrianModal" tabindex="-1" role="dialog" aria-labelledby="vcenter">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title" id="EditFlagAntrianModal">Edit Flag Antrian</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal m-t-4" name="formEditFlagAntrian" id="formEditFlagAntrian" action=""  method="POST">
                    <input type="hidden" name="edit_id" id="edit_id" value=""/>
                    <input type="hidden" name="edit_uid" id="edit_uid" value=""/>
                <dl class="row">
                    <dt class="col-sm-4">ID</dt>
                    <dd class="col-sm-8"><span id="kunjungan_id"></span></dd>
                    <dt class="col-sm-4">UID</dt>
                    <dd class="col-sm-8"><span id="kunjungan_uid"></span></dd>
                    <dt class="col-sm-4">Nama</dt>
                    <dd class="col-sm-8"><span id="pengunjung_nama"></span></dd>
                    <hr style="width: 100%; color: black; height: 1px;" />
                    <dt class="col-sm-4">Tanggal</dt>
                    <dd class="col-sm-8"><span id="kunjungan_tanggal"></span></dd>
                    <dt class="col-sm-4">Jenis</dt>
                    <dd class="col-sm-8"><span id="kunjungan_jenis"></span></dd>
                    <dt class="col-sm-4">Tujuan</dt>
                    <dd class="col-sm-8"><span id="kunjungan_tujuan"></span></dd>
                    <dt class="col-sm-4">Nomor Antrian</dt>
                    <dd class="col-sm-8"><span id="kunjungan_nomor_antrian"></span></dd>
                    <dt class="col-sm-4">Mulai Layanan</dt>
                    <dd class="col-sm-8"><span id="kunjungan_jam_datang"></span></dd>
                    <dt class="col-sm-4">Akhir Layanan</dt>
                    <dd class="col-sm-8"><span id="kunjungan_jam_pulang"></span></dd>
                </dl>
                <hr style="width: 100%; color: black; height: 1px;" />
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label class="control-label">Flag Antrian</label>
                    </div>
                    <div class="col-sm-8">
                        <select class="form-control" id="edit_flag_antrian" name="edit_flag_antrian" required>
                            <option value="">Pilih salah satu</option>
                            @foreach ($master_flag_antrian as $item)
                                <option value="{{$item->kode}}">{{$item->nama}}</option>
                            @endforeach
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <span id="edit_kunjungan_error" class="text-danger"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="" class="btn btn-info waves-effect" id="pengunjung_timeline">TIMELINE</a>
                <button type="submit" class="btn btn-success waves-effect" id="updateFlagAntrian" data-dismiss="modal">UPDATE DATA</button>
                <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </form>
        </div>
    </div>
</div>

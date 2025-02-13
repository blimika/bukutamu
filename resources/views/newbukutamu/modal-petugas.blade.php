<div class="modal fade" id="EditPetugasModal" role="dialog" aria-labelledby="vcenter">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title" id="title">Edit Petugas Kunjungan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal m-t-4" name="formTindakLanjut" id="formTindakLanjut" action="" method="post">
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
                    <dt class="col-sm-4">Petugas Layanan</dt>
                    <dd class="col-sm-8"><span id="kunjungan_petugas_nama"></span></dd>
                </dl>
                <hr style="width: 100%; color: black; height: 1px;" />
                <dl class="row">
                    <dt class="col-sm-4">Keperluan / Data yang dicari</dt>
                    <dd class="col-sm-8"><span id="kunjungan_keperluan"></span></dd>
                </dl>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label class="control-label">Petugas Layanan Baru</label>
                    </div>
                    <div class="col-sm-8">
                        <select class="select2 form-control" style="width: 100%; height:36px;" id="kunjungan_petugas_baru" name="kunjungan_petugas_baru">
                            <option value="">Pilih salah satu</option>
                            @foreach ($DataPetugas as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <span id="edit_petugas_error" class="text-danger"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success waves-effect" id="simpanPetugas" data-dismiss="modal">SIMPAN DATA</button>
                <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </form>
        </div>
    </div>
</div>

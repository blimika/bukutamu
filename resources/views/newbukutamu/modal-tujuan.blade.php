<div class="modal fade" id="EditTujuanModal" tabindex="-1" role="dialog" aria-labelledby="vcenter">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title" id="title">Ubah Tujuan Kunjungan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal m-t-4" name="formUbahTujuan" id="formUbahTujuan" action="" method="post">
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
                    <dt class="col-sm-4">Keperluan / Data yang dicari</dt>
                    <dd class="col-sm-8"><span id="kunjungan_keperluan"></span></dd>
                </dl>
                <hr style="width: 100%; color: black; height: 1px;" />

                <div class="form-group row">
                    <div class="col-sm-4">
                        <label class="control-label">Tujuan Baru</label>
                    </div>
                    <div class="col-sm-8">
                        <select class="form-control" id="kunjungan_tujuan_baru" name="kunjungan_tujuan_baru">
                            <option value="">Pilih salah satu</option>
                            @foreach ($MasterTujuan as $item)
                                <option value="{{$item->kode}}">{{$item->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row" id="row_layananpst">
                    <div class="col-sm-4">
                        <label class="control-label">Layanan PST</label>
                    </div>
                    <div class="col-sm-8">
                        <select class="form-control" id="layananpst_kode_baru" name="layananpst_kode_baru">
                            <option value="">Pilih salah satu</option>
                            @foreach ($MasterLayananPST as $item)
                                <option value="{{$item->kode}}">{{$item->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row" id="row_layanankantor">
                    <div class="col-sm-4">
                        <label class="control-label">Layanan Kantor</label>
                    </div>
                    <div class="col-sm-8">
                        <select class="form-control" id="layanankantor_kode_baru" name="layanankantor_kode_baru">
                            <option value="">Pilih salah satu</option>
                            @foreach ($MasterLayananKantor as $item)
                                <option value="{{$item->kode}}">{{$item->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <span id="tujuan_baru_error" class="text-danger"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success waves-effect" id="simpanTujuanBaru" data-dismiss="modal">SIMPAN DATA</button>
                <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </form>
        </div>
    </div>
</div>

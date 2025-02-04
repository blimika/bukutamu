<!---flag antrian modal--->
<div class="modal fade" id="EditPengunjungModal" tabindex="-1" role="dialog" aria-labelledby="vcenter">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title" id="title">Edit Pengunjung</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal m-t-4" name="formEditPengunjung" id="formEditPengunjung" action=""  method="post">
                    <input type="hidden" name="pengunjung_id" id="pengunjung_id" value=""/>
                    <input type="hidden" name="pengunjung_uid" id="pengunjung_uid" value=""/>
                <dl class="row">
                    <dt class="col-sm-4">ID</dt>
                    <dd class="col-sm-8"><span id="teks_pengunjung_id"></span></dd>
                    <dt class="col-sm-4">UID</dt>
                    <dd class="col-sm-8"><span id="teks_pengunjung_uid"></span></dd>
                </dl>
                <hr style="width: 100%; color: black; height: 1px;" />
                <div class="form-group row">
                    <label class="control-label text-right col-md-3">Nomor Handphone</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" placeholder="Nomor WhatsApp (08xxxx)" id="pengunjung_nomor_hp" name="pengunjung_nomor_hp" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label text-right col-md-3">Nama</label>
                    <div class="col-md-9" id="pengunjung_nama_error">
                        <input type="text" class="form-control border-black" id="pengunjung_nama" name="pengunjung_nama" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label text-right col-md-3">Jenis Kelamin</label>
                    <div class="col-md-4" id="pengunjung_jk_error">
                        <select class="form-control" id="pengunjung_jk" name="pengunjung_jk" required>
                            <option value=""></option>
                            @foreach ($Mjk as $item_jk)
                                    <option value="{{$item_jk->id}}">{{$item_jk->nama}}</option>
                            @endforeach
                            </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label text-right col-md-3">Tahun lahir</label>
                    <div class="col-md-4" id="pengunjung_tahun_lahir_error">
                        <input type="text" class="form-control" id="pengunjung_tahun_lahir" name="pengunjung_tahun_lahir" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label text-right col-md-3">Pekerjaan</label>
                    <div class="col-md-9" id="pengunjung_pekerjaan_error">
                        <input type="text" class="form-control border-black" id="pengunjung_pekerjaan" name="pengunjung_pekerjaan" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label text-right col-md-3">Pendidikan terakhir</label>
                    <div class="col-md-6" id="pengunjung_pendidikan_error">
                        <select class="form-control" id="pengunjung_pendidikan" name="pengunjung_pendidikan" required>
                            <option value=""></option>
                            @foreach ($MasterPendidikan as $item_didik)
                                    <option value="{{$item_didik->id}}">{{$item_didik->nama}}</option>
                            @endforeach
                    </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label text-right col-md-3">E-Mail</label>
                    <div class="col-md-9" id="pengunjung_email_error">
                        <input type="text" class="form-control" id="pengunjung_email" name="pengunjung_email">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label text-right col-md-3">Alamat</label>
                    <div class="col-md-9" id="pengunjung_alamat_error">
                        <textarea class="form-control" rows="4" name="pengunjung_alamat" id="pengunjung_alamat"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <span id="edit_pengunjung_error" class="text-danger"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="" class="btn btn-info waves-effect" id="pengunjung_timeline">TIMELINE</a>
                <button type="submit" class="btn btn-success waves-effect" id="updatePengunjung" data-dismiss="modal">UPDATE DATA</button>
                <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </form>
        </div>
    </div>
</div>

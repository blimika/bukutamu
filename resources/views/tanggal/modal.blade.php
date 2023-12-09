<div class="modal fade" id="GenerateTanggal" tabindex="-1" role="dialog" aria-labelledby="vcenter">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-white">Generate Tanggal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal m-t-4" name="formGenerateTanggal" id="formGenerateTanggal" action="#"  method="POST">
                    <div class="form-group row">
                        <label class="control-label col-md-2">Tahun</label>
                        <div class="input-group col-md-10">
                            <select class="form-control" id="gentahun" name="gentahun" required>
                                    <option value="">Pilih</option>
                                    @for ($i = (date('Y')-3); $i < date('Y')+2; $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <span id="gen_error" class="text-danger"></span>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success waves-effect" id="GenData" data-dismiss="modal">Generate</button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </form>
        </div>
    </div>
</div>
<div class="modal fade" id="EditTanggal" tabindex="-1" role="dialog" aria-labelledby="vcenter">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-white">Edit Tanggal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal m-t-4" name="formEditTanggal" id="formEditTanggal" action="#"  method="POST">
                    <dl class="row">
                        <dt class="col-sm-4">ID</dt>
                        <dd class="col-sm-8"><span id="edit_id"></span></dd>
                        <dt class="col-sm-4">Hari</dt>
                        <dd class="col-sm-8"><span id="edit_hari"></span></dd>
                        <dt class="col-sm-4">Tanggal</dt>
                        <dd class="col-sm-8"><span id="edit_tanggal"></span></dd>
                        <dt class="col-sm-4">Jenis</dt>
                        <dd class="col-sm-8"><span id="edit_jenis"></span></dd>
                    </dl>
                    <hr />
                    <div class="form-group row">
                        <label class="control-label col-md-2">Jenis</label>
                        <div class="input-group col-md-10">
                            <select class="form-control" id="edit_jtanggal" name="jtanggal" required>
                                <option value="">Pilih</option>
                                @foreach ($jtanggal as $item)
                                    <option value="{{ $item->kode }}">{{ $item->nama }}</option>
                                @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2">Deskripsi</label>
                        <div class="input-group col-md-10">
                            <input type="text" class="form-control" id="edit_deskripsi" name="deskripsi" />
                        </div>
                    </div>
                    <div class="form-group">
                        <span id="tanggal_error" class="text-danger"></span>
                    </div>
                    <input type="hidden" id="id_tanggal" name="id_tanggal" value=""/>
                    <input type="hidden" id="hari_num" name="hari_num" value=""/>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success waves-effect" id="updatetgl" data-dismiss="modal">UPDATE</button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </form>
        </div>
    </div>
</div>

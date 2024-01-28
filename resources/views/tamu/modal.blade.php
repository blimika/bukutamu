<div class="modal fade" id="syncLayananUtama" tabindex="-1" role="dialog" aria-labelledby="vcenter">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-white">Sinkron Layanan Utama</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal m-t-4" name="formSyncLayananUtama" id="formSyncLayananUtama" action="#"  method="POST">
                    <div class="form-group row">
                        <label class="control-label col-md-2">Tahun</label>
                        <div class="input-group col-md-10">
                            <select class="form-control" id="tahun_kunjungan" name="tahun_kunjungan" required>
                                    <option value="">Pilih</option>
                                    @foreach ($dataTahun as $item)
                                        <option value="{{$item->tahun}}">{{$item->tahun}}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <span id="tahun_error" class="text-danger"></span>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success waves-effect" id="sinkron_antrian" data-dismiss="modal">Sinkronisasi</button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </form>
        </div>
    </div>
</div>

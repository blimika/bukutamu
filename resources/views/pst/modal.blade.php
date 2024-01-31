<div class="modal fade" id="SinkronPstLayanan" tabindex="-1" role="dialog" aria-labelledby="vcenter">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-white">Sinkron PST Layanan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal m-t-4" name="formGenerateTanggal" id="formGenerateTanggal" action="{{route('pst.sinkronlayanan')}}"
                    method="POST">
                    @csrf
                    <div class="form-group row">
                        <label class="control-label col-md-2">Tahun</label>
                        <div class="input-group col-md-10">
                            <select class="form-control" id="sinkron_tahun" name="sinkron_tahun" required>
                                <option value="">Pilih Tahun</option>
                                @foreach ($tahun as $item)
                                    <option value="{{$item->tahun}}" @if($item->tahun == $tahun_filter) selected
                                    @endif>{{$item->tahun}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-2">Master</label>
                        <div class="input-group col-md-10">
                            <select class="form-control" id="tabel_master" name="tabel_master" required>
                                <option value="">Pilih Tabel Master</option>
                                <option value="1">Mlay (Terbaru)</option>
                                <option value="2">MLayanan (Lama)</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <span id="gen_error" class="text-danger"></span>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success waves-effect" id="sinkronlayanan" name="sinkronlayanan">Sinkron Layanan</button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
            </form>
        </div>
    </div>
</div>

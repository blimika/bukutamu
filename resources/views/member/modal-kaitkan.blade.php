<div class="modal fade" id="KaitkanModal" tabindex="-1" role="dialog" aria-labelledby="vcenter">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-white" id="KaitkanModal">Kaitkan Member Pengunjung</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal m-t-4" name="formKaitkanMember" id="formKaitkanMember" action="#"  method="POST">
                    <dl class="row">
                        <dt class="col-sm-4">ID</dt>
                        <dd class="col-sm-8"><span id="kaitkan_id_teks"></span></dd>
                        <dt class="col-sm-4">Nama</dt>
                        <dd class="col-sm-8"><span id="kaitkan_nama"></span></dd>
                        <dt class="col-sm-4">username</dt>
                        <dd class="col-sm-8"><span id="kaitkan_username"></span></dd>
                    </dl>
                    <hr />
                    <div class="form-group">
                        <label class="control-label">Pengunjung</label>
                            <select class="form-control" id="kaitkan_tamuid" name="kaitkan_tamuid" required>
                                <option value="">Pilih Pengunjung</option>

                                </select>
                        </div>
                    <div class="form-group">
                        <span id="gantipasswd_error" class="text-danger"></span>
                    </div>
                    <input type="hidden" id="kaitkan_id" name="kaitkan_id" value="" />
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success waves-effect" id="KaitkanMember" data-dismiss="modal">Kaitkan</button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </form>
        </div>
    </div>
</div>

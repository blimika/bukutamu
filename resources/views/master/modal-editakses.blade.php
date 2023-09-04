<div class="modal fade" id="EditAksesModal" tabindex="-1" role="dialog" aria-labelledby="vcenter">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-white" id="EditAksesModal">Edit IP Address</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal m-t-4" name="formEditAkses" id="formEditAkses" action=""  method="POST">
                    <input type="hidden" name="id" id="id" value=""/>
                    <dl class="row">
                    <dt class="col-sm-4">ID</dt>
                    <dd class="col-sm-8"><span id="id_teks"></span></dd>
                    </dl>
                    <hr class="m-t-0 m-b-4">
                    <div class="form-group">
                        <label for="ipaddress">IP Address</label>
                        <input type="text" class="form-control" name="ipaddress" id="ipaddress" aria-describedby="ipaddress" placeholder="Masukan IP Address">
                    </div>

                    <div class="form-group">
                        <span id="edit_akses_error" class="text-danger"></span>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success waves-effect" id="updateDataAkses" data-dismiss="modal">UPDATE DATA</button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </form>
        </div>
    </div>
</div>

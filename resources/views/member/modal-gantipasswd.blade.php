<div class="modal fade" id="GantiPasswdModal" tabindex="-1" role="dialog" aria-labelledby="vcenter">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h4 class="modal-title text-white" id="GantiPasswdModal">Ganti Password</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal m-t-4" name="GantiPasswd" id="GantiPasswd" action="#"  method="POST">
                    <dl class="row">
                        <dt class="col-sm-4">ID</dt>
                        <dd class="col-sm-8"><span id="gp_id_teks"></span></dd>
                        <dt class="col-sm-4">Nama</dt>
                        <dd class="col-sm-8"><span id="gp_nama"></span></dd>
                        <dt class="col-sm-4">username</dt>
                        <dd class="col-sm-8"><span id="gp_username"></span></dd>
                    </dl>
                    <hr />
                    <div class="form-group">
                        <label class="gp_passwd">Password Baru</label>
                            <input type="password" class="form-control" id="gp_passwd" name="gp_passwd" required>
                    </div>
                    <div class="form-group">
                        <label class="gp_ulangi_passwd">Ulangi Password Baru</label>
                            <input type="password" class="form-control" id="gp_ulangi_passwd" name="gp_ulangi_passwd" required>
                    </div>
                    <div class="form-group">
                        <span id="gantipasswd_error" class="text-danger"></span>
                    </div>
                    <input type="hidden" id="gp_id" name="gp_id" value="" />
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success waves-effect" id="GantiPasswdMember" data-dismiss="modal">Ganti Password</button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </form>
        </div>
    </div>
</div>

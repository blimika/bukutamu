<div class="modal fade" id="GantiPasswdModal" tabindex="-1" role="dialog" aria-labelledby="vcenter">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h4 class="modal-title text-white" id="GantiPasswdModal">Ganti Password</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal m-t-4" name="GantiPasswd" id="GantiPasswd" action="{{ route('member.simpan') }}"  method="POST">

                    <div class="form-group">
                        <label for="edit_passwd_lama">Password Lama</label>
                        <input type="password" class="form-control" id="edit_passwd_lama" name="edit_passwd_lama" required>
                    </div>
                    <div class="form-group">
                        <label class="edit_passwd_baru">Password Baru</label>
                            <input type="password" class="form-control" id="edit_passwd_baru" name="edit_passwd_baru" required>
                    </div>
                    <div class="form-group">
                        <label class="edit_ulangi_passwdbaru">Ulangi Password Baru</label>
                            <input type="password" class="form-control" id="edit_ulangi_passwdbaru" name="edit_ulangi_passwdbaru" required>
                    </div>
                    <div class="form-group">
                        <span id="gantipasswd_error" class="text-danger"></span>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success waves-effect" id="GantiPasswd" data-dismiss="modal">Ganti Password</button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </form>
        </div>
    </div>
</div>

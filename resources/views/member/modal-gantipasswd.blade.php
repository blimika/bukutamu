<div class="modal fade" id="GantiPasswdModal" tabindex="-1" role="dialog" aria-labelledby="vcenter">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h4 class="modal-title text-white" id="GantiPasswdModal">Ganti Password</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal m-t-4" name="formEditMember" id="formEditMember" action="{{ route('member.simpan') }}"  method="POST">
                    
                    <div class="form-group">
                        <label for="control-label">Password Lama</label>
                        <input type="password" class="form-control" id="passwd_lama" name="passwd_lama" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Password Baru</label>
                            <input type="password" class="form-control" id="passwd_baru" name="passwd_baru" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Ulangi Password Baru</label>
                            <input type="password" class="form-control" id="passwd_baru_ulangi" name="passwd_baru_ulangi" required>
                    </div>
                    <div class="form-group">
                        <span id="member_error" class="text-danger"></span>
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
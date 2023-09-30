<div id="GantiPassword">
    <form class="form-horizontal m-t-4" name="formGantiPasswd" id="formGantiPasswd" action=""  method="POST">

        <div class="form-group">
            <label for="edit_passwd_lama">Password Lama</label>
            <input type="password" class="form-control" id="edit_passwd_lama" name="edit_passwd_lama" required>
        </div>
        <div class="form-group">
            <label for="edit_passwd_baru">Password Baru</label>
                <input type="password" class="form-control" id="edit_passwd_baru" name="edit_passwd_baru" required>
        </div>
        <div class="form-group">
            <label for="edit_ulangi_passwdbaru">Ulangi Password Baru</label>
                <input type="password" class="form-control" id="edit_ulangi_passwdbaru" name="edit_ulangi_passwdbaru" required>
        </div>
        <div class="form-group">
            <span id="gantipasswd_error" class="text-danger"></span>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success waves-effect" id="UpdatePasswd" name="UpdatePasswd">GANTI PASSWORD</button>
        </div>
    </form>
</div>

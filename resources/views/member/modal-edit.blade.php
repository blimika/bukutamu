<div class="modal fade" id="EditMemberModal" tabindex="-1" role="dialog" aria-labelledby="vcenter">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-white" id="EditMemberModal">Edit Member</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal m-t-4" name="formEditMember" id="formEditMember" action="{{ route('member.simpan') }}"  method="POST">
                    <div class="form-group">
                    <label class="control-label">Level</label>
                        <select class="form-control" id="edit_level" name="level" required>
                            <option value=""></option>
                            @foreach ($mlevel as $item)
                                    <option value="{{$item->kode}}">{{$item->nama}}</option>
                            @endforeach
                            </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_lengkap">Nama</label>
                        <input type="text" class="form-control" id="edit_name" aria-describedby="name" placeholder="name" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_lengkap">Username</label>
                        <input type="text" class="form-control" id="edit_username" aria-describedby="username" placeholder="username" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">E-Mail</label>
                            <input type="text" class="form-control" id="edit_email" name="email">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Telepon/WA</label>
                            <input type="text" class="form-control" id="edit_telepon" name="telepon">
                    </div>
                    <div class="form-group">
                        <span id="edit_member_error" class="text-danger"></span>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success waves-effect" id="UpdateMember" data-dismiss="modal">UPDATE</button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </form>
        </div>
    </div>
</div>

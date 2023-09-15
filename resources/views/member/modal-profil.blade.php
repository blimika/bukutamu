<div class="modal fade" id="KaitkanModal" tabindex="-1" role="dialog" aria-labelledby="vcenter">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-white" id="KaitkanModal">Kaitkan Akun Pengunjung</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal m-t-4" name="formKaitkanPengunjung" id="formKaitkanPengunjung" action="{{ route('member.simpan') }}"  method="POST">

                    <div class="form-group">
                        <label for="kodeqr">Kode QR Pengunjung</label>
                        <input type="text" class="form-control" id="kodeqr" aria-describedby="kodeqr" autocomplete="off" placeholder="Kode QR Pengunjung" required>
                    </div>

                    <div class="form-group">
                        <span id="kaitkan_error" class="text-danger"></span>
                    </div>
                    <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}" />
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success waves-effect" id="KaitkanPengunjung" data-dismiss="modal">KAITKAN</button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </form>
        </div>
    </div>
</div>

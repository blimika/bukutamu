<div class="modal fade" id="KaitkanModal" tabindex="-1" role="dialog" aria-labelledby="vcenter">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-white" id="KaitkanModal">Kaitkan Akun Pengunjung</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal m-t-4" name="formKaitkanPengunjung" id="formKaitkanPengunjung" action="#"  method="POST">

                    <div class="form-group row">
                        <label for="kodeqr" class="control-label col-md-2">Kode QR</label>
                        <div class="input-group col-md-10">
                            <input type="text" class="form-control" name="kodeqr" id="kodeqr" aria-describedby="kodeqr" autocomplete="off" placeholder="Kode QR Pengunjung" required>
                            <button type="button" name="cek_kodeqr" id="cek_kodeqr" class="btn btn-success"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 text-center font-weight-bold">
                            ATAU
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-4">Nomor HP</label>
                        <div class="input-group col-md-8">
                            <input type="text" class="form-control" placeholder="Nomor HP" id="nomor_hp" name="nomor_hp" required>
                            <span class="input-group-addon b-0">&nbsp;</span>
                            <button type="button" name="cek_hp" id="cek_hp" class="btn btn-info"><i class="fas fa-search"></i></button>

                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="gantiphoto" class="custom-control-input" id="gantiphoto" value="1">
                                <label class="custom-control-label" for="gantiphoto">Photo profil diganti</label>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <span id="kaitkan_error" class="text-danger"></span>
                    </div>
                    <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}" />
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success waves-effect" id="KaitkanPengunjung" data-dismiss="modal" disabled>KAITKAN</button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </form>
        </div>
    </div>
</div>

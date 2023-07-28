<div class="modal fade" id="ViewModal" tabindex="-1" role="dialog" aria-labelledby="vcenter">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title" id="ViewModal">View Data Pengunjung</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <dl class="row">
                    <dt class="col-sm-4">ID</dt>
                    <dd class="col-sm-8"><span id="tamu_id"></span></dd>
                    @if (Auth::user())
                    <dt class="col-sm-4">Identitas</dt>
                    <dd class="col-sm-8"><span id="tamu_identitas"></span></dd>
                    @endif
                    <dt class="col-sm-4">Nama Lengkap</dt>
                    <dd class="col-sm-8"><span id="tamu_nama"></span></dd>
                    <dt class="col-sm-4">Jenis Kelamin</dt>
                    <dd class="col-sm-8"><span id="tamu_jk"></span></dd>
                    <dt class="col-sm-4">Tanggal Lahir</dt>
                    <dd class="col-sm-8"><span id="tamu_lahir"></span></dd>
                    <dt class="col-sm-4">Pekerjaan</dt>
                    <dd class="col-sm-8"><span id="tamu_kerja"></span> <br /><span id="kerja_detil"></span> <br /><span id="kat_kerja_nama"></span></dd>
                    <dt class="col-sm-4">Pendidikan</dt>
                    <dd class="col-sm-8"><span id="tamu_pendidikan"></span></dd>
                    <dt class="col-sm-4">E-mail</dt>
                    <dd class="col-sm-8"><span id="tamu_email"></span></dd>
                    <dt class="col-sm-4">Telepon</dt>
                    <dd class="col-sm-8"><span id="tamu_telepon"></span> <a href="" id="tamu_wa" target="_blank" class="btn waves-effect btn-success btn-xs waves-light"><i class="fab fa-whatsapp"></i></a></dd>
                    <dt class="col-sm-4">Alamat</dt>
                    <dd class="col-sm-8"><span id="tamu_alamat"></span></dd>
                    <!--<dt class="col-sm-4">Kode QRcode</dt>
                    <dd class="col-sm-8"><img src="" id="kodeqr" width="200px"></dd>-->
                    <dt class="col-sm-4">Foto</dt>
                    <dd class="col-sm-8"><img src="" id="tamu_foto" class="col-sm-12"></dd>
                    <dt class="col-sm-4">Kunjungan</dt>
                    <dd class="col-sm-8"><span id="kunjungan_terakhir"></span></dd>
                </dl>

            </div>
            <div class="modal-footer">
                <a href="" class="btn btn-success waves-effect" id="tamu_timeline">TIMELINE</a>
                <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </form>
        </div>
    </div>
</div>

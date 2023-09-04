<div class="modal fade" id="ViewMemberModal" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-white" id="ViewMemberModal">Data Detil Member</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <dl class="row">
                    <dt class="col-sm-4">Nama</dt>
                    <dd class="col-sm-8"><span id="member_nama"></span></dd>
                    <dt class="col-sm-4">username</dt>
                    <dd class="col-sm-8"><span id="member_username"></span></dd>
                    <dt class="col-sm-4">Level</dt>
                    <dd class="col-sm-8"><span id="member_level"></span></dd>
                    <dt class="col-sm-4">Telepon</dt>
                    <dd class="col-sm-8"><span id="member_telepon"></span> <a href="" id="member_wa" target="_blank" class="btn waves-effect btn-success btn-xs waves-light"><i class="fab fa-whatsapp"></i></a></dd>
                    <dt class="col-sm-4">Tamu ID</dt>
                    <dd class="col-sm-8"><span id="tamu_id"></span></dd>
                    <dt class="col-sm-4">Lastlogin</dt>
                    <dd class="col-sm-8"><span id="member_lastlogin"></span></dd>
                    <dt class="col-sm-4">Last IP</dt>
                    <dd class="col-sm-8"><span id="member_lastip"></span></dd>
                    <dt class="col-sm-4">Flag</dt>
                    <dd class="col-sm-8"><span id="member_flag"></span></dd>
                    <dt class="col-sm-4">Dibuat</dt>
                    <dd class="col-sm-8"><span id="member_created"></span></dd>
                    <dt class="col-sm-4">Diupdate</dt>
                    <dd class="col-sm-8"><span id="member_updated"></span></dd>
                    <dt class="col-sm-4">Foto</dt>
                    <dd class="col-sm-8"><img src="" id="member_foto" class="col-sm-12"></dd>
                </dl>
                <div class="row" id="tamu">
                    <div class="card col-sm-12">
                        <div class="card-header">
                            Data Pengunjung
                            <div class="card-actions">
                                <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                            </div>
                        </div>
                        <div class="card-body collapse show">
                            @include('member.viewpengunjung')
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>

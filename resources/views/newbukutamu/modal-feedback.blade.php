<!--isi feedback modal--->
<div class="modal fade" id="BeriFeebackModal" tabindex="-1" role="dialog" aria-labelledby="vcenter">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title" id="title">Feedback Layanan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal m-t-4" name="formBeriFeedback" id="formBeriFeedback" action="" method="POST">
                    <input type="hidden" name="edit_id" id="edit_id" value=""/>
                    <input type="hidden" name="edit_uid" id="edit_uid" value=""/>
                <dl class="row">
                    <dt class="col-sm-4">ID</dt>
                    <dd class="col-sm-8"><span id="kunjungan_id"></span></dd>
                    <dt class="col-sm-4">UID</dt>
                    <dd class="col-sm-8"><span id="kunjungan_uid"></span></dd>
                    <dt class="col-sm-4">Nama</dt>
                    <dd class="col-sm-8"><span id="pengunjung_nama"></span></dd>
                    <hr style="width: 100%; color: black; height: 1px;" />
                    <dt class="col-sm-4">Tanggal</dt>
                    <dd class="col-sm-8"><span id="kunjungan_tanggal"></span></dd>
                    <dt class="col-sm-4">Jenis</dt>
                    <dd class="col-sm-8"><span id="kunjungan_jenis"></span></dd>
                    <dt class="col-sm-4">Tujuan</dt>
                    <dd class="col-sm-8"><span id="kunjungan_tujuan"></span></dd>
                    <dt class="col-sm-4">Nomor Antrian</dt>
                    <dd class="col-sm-8"><span id="kunjungan_nomor_antrian"></span></dd>
                    <dt class="col-sm-4">Mulai Layanan</dt>
                    <dd class="col-sm-8"><span id="kunjungan_jam_datang"></span></dd>
                    <dt class="col-sm-4">Akhir Layanan</dt>
                    <dd class="col-sm-8"><span id="kunjungan_jam_pulang"></span></dd>
                    <dt class="col-sm-4">Petugas Layanan</dt>
                    <dd class="col-sm-8"><span id="kunjungan_petugas_nama"></span></dd>
                </dl>
                <hr style="width: 100%; color: black; height: 1px;" />
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label class="control-label">Nilai layanan kami</label>
                    </div>
                    <div class="col-sm-8">
                        <p class="stars">
                            <div class="starfeedback d-flex justify-content-center flex-row-reverse">
                                    <input type="radio" class="feedback_nilai" id="star6" name="feedback_nilai" value="6" required /><label for="star6" title="6 star"></label>
                                    <input type="radio" class="feedback_nilai" id="star5" name="feedback_nilai" value="5" /><label for="star5" title="5 star"></label>
                                    <input type="radio" class="feedback_nilai" id="star4" name="feedback_nilai" value="4" /><label for="star4" title="4 star"></label>
                                    <input type="radio" class="feedback_nilai" id="star3" name="feedback_nilai" value="3" /><label for="star3" title="3 star"></label>
                                    <input type="radio" class="feedback_nilai" id="star2" name="feedback_nilai" value="2" /><label for="star2" title="2 star"></label>
                                    <input type="radio" class="feedback_nilai" id="star1" name="feedback_nilai" value="1" /><label for="star1" title="1 star"></label>
                                </div>
                        </p>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label class="control-label">Saran/Kritik Anda <br /><i>(optional)</i></label>
                    </div>
                    <div class="col-sm-8">
                        <textarea class="form-control" style="border:1px solid black;" rows="4" id="feedback_komentar" name="feedback_komentar"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <span id="feedback_error" class="text-danger"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success waves-effect" id="simpanFeedback" data-dismiss="modal">SIMPAN DATA</button>
                <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </form>
        </div>
    </div>
</div>

<!--view feedback modal--->
<div class="modal fade" id="ViewFeedbackModal" tabindex="-1" role="dialog" aria-labelledby="vcenter">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title" id="title">View Feedback Layanan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <dl class="row">
                    <dt class="col-sm-4">ID</dt>
                    <dd class="col-sm-8"><span id="kunjungan_id"></span></dd>
                    <dt class="col-sm-4">UID</dt>
                    <dd class="col-sm-8"><span id="kunjungan_uid"></span></dd>
                    <dt class="col-sm-4">Nama</dt>
                    <dd class="col-sm-8"><span id="pengunjung_nama"></span></dd>
                    <hr style="width: 100%; color: black; height: 1px;" />
                    <dt class="col-sm-4">Tanggal</dt>
                    <dd class="col-sm-8"><span id="kunjungan_tanggal"></span></dd>
                    <dt class="col-sm-4">Jenis</dt>
                    <dd class="col-sm-8"><span id="kunjungan_jenis"></span></dd>
                    <dt class="col-sm-4">Tujuan</dt>
                    <dd class="col-sm-8"><span id="kunjungan_tujuan"></span></dd>
                    <dt class="col-sm-4">Nomor Antrian</dt>
                    <dd class="col-sm-8"><span id="kunjungan_nomor_antrian"></span></dd>
                    <dt class="col-sm-4">Mulai Layanan</dt>
                    <dd class="col-sm-8"><span id="kunjungan_jam_datang"></span></dd>
                    <dt class="col-sm-4">Akhir Layanan</dt>
                    <dd class="col-sm-8"><span id="kunjungan_jam_pulang"></span></dd>
                    <dt class="col-sm-4">Petugas Layanan</dt>
                    <dd class="col-sm-8"><span id="kunjungan_petugas_nama"></span></dd>
                    <hr style="width: 100%; color: black; height: 1px;" />
                    <dt class="col-sm-4">Flag Feedback</dt>
                    <dd class="col-sm-8"><span id="kunjungan_flag_feedback"></span></dd>
                    <dt class="col-sm-4">Nilai Feedback</dt>
                    <dd class="col-sm-8"><span id="kunjungan_nilai_feedback"></span></dd>
                    <dt class="col-sm-4">Komentar Feedback</dt>
                    <dd class="col-sm-8"><span id="kunjungan_komentar_feedback"></span></dd>
                </dl>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>

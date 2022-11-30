<!-- modal edit kunjungan kelompok -->
<div id="EditKunjunganModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-white">Edit Data Kunjungan Kelompok</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <!--isi modal-->
                <dl class="row">
                    <dt class="col-sm-4">ID Kunjungan</dt>
                    <dd class="col-sm-8"><span id="kunjungan_id_teks"></span></dd>
                    <dt class="col-sm-4">ID Tamu</dt>
                    <dd class="col-sm-8"><span id="tamu_id_teks"></span></dd>
                    <dt class="col-sm-4">Nama Pengunjung</dt>
                    <dd class="col-sm-8"><span id="tamu_nama"></span></dd>
                    <dt class="col-sm-4">Keperluan</dt>
                    <dd class="col-sm-8"><span id="tamu_keperluan"></span></dd>
                    <dt class="col-sm-2">Foto</dt>
                    <dd></dd>
                    <dt></dt>
                    <dd class="col-sm-12"><img src="" id="foto_kunjungan" class="col-sm-12"></dd>
                </dl>
                <form class="m-t-10" name="formEditKunjunganKelompok" id="formEditKunjunganKelompok" method="post" action="{{route("update.kunjungan")}}">
                 @csrf
                 <input type="hidden" name="kunjungan_id" id="kunjungan_id" value="" />
                 <input type="hidden" name="tamu_id" id="tamu_id" value="" />
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="jumlah_tamu">Jumlah Tamu</label>
                        <div class="controls">
                        <input type="number" class="form-control" id="jumlah_tamu" name="jumlah_tamu" placeholder="Jumlah Tamu" required>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="keg_r_jumlah">Laki-Laki</label>
                        <div class="controls">
                        <input type="number" class="form-control" id="tamu_laki" name="tamu_laki" placeholder="Tamu Laki-laki" required>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="keg_r_jumlah">Perempuan</label>
                        <div class="controls">
                        <input type="number" class="form-control" id="tamu_wanita" name="tamu_wanita" placeholder="Tamu Perempuan" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <span id="kunjungan_teks_error" class="text-danger"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="" class="btn btn-warning waves-effect" id="tamu_timeline">TIMELINE</a>
                <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">CLOSE</button>
                <button type="submit" id="kunjungan_update" class="btn btn-success waves-effect waves-light">UPDATE</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- /.kunjungan -->

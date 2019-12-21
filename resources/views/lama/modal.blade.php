<div class="modal fade" id="HapusDataModal" tabindex="-1" role="dialog" aria-labelledby="HapusDataModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title" id="HapusDataModal">Hapus data pengunjung</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal m-t-20" name="hapus_data" method="POST">
                 @csrf
                 <input type="hidden" name="tamu_id_lama" id="tamu_id_lama" value="" />
                 <input type="hidden" name="edit_tamu_lama" id="edit_tamu_lama" value="0" />
                Tanggal : <span id="hapus_tanggal"></span> <br />
                Nama : <span id="hapus_nama"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-danger waves-effect waves-light">Hapus</button>
            </div>
        </form>
        </div>
    </div>
</div>
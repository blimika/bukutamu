<div class="modal fade" id="TambahModal" tabindex="-1" role="dialog" aria-labelledby="TambahModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h4 class="modal-title" id="TambahModal">Tambah Bukutamu</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal m-t-20" action="{{route('simpan')}}" method="POST">
                     @csrf
                     <input type="hidden" name="tamu_id" id="tamu_id" value="" />
                     <input type="hidden" name="edit_tamu" id="edit_tamu" value="0" />
                       @include('form-tambah')
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success waves-effect waves-light">Simpan</button>
                    <button type="reset" class="btn btn-danger waves-effect waves-light">Reset</button>
                </div>
            </form>
            </div>
        </div>
</div>

<div class="modal fade" id="InputDataLamaModal" tabindex="-1" role="dialog" aria-labelledby="InputDataLamaModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title" id="InputDataLamaModal">Input Data Lama Bukutamu</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal m-t-20" name="data_lama" action="{{route('simpan.lama')}}" method="POST">
                 @csrf
                 <input type="hidden" name="tamu_id_lama" id="tamu_id_lama" value="" />
                 <input type="hidden" name="edit_tamu_lama" id="edit_tamu_lama" value="0" />
                   @include('form-datalama')
                
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success waves-effect waves-light">Simpan</button>
                <button type="reset" class="btn btn-danger waves-effect waves-light">Reset</button>
            </div>
        </form>
        </div>
    </div>
</div>
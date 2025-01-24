<div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-10">
        @if (ENV('APP_WEBCAM_MODE') == true)
            <div class="row">
                <div class="form-group col-md-12">
                    <video id="video" width="100%" height="auto" autoplay aria-hidden="false"></video>
                    <canvas id="canvas" width="100%" height="auto" aria-hidden="true"></canvas>
                    <br />
                    <button type="button" id="ambil_foto" class="btn btn-success"><i class="fas fa-camera"></i> Foto</button>
                    <button type="button" id="reset_foto" class="btn btn-danger" disabled><i class="fas fa-undo"></i> Ulang</button>
                    <input type="hidden" name="foto" id="foto" />
                    <button type="button" id="tanpa_webcam" class="btn btn-warning"><i class="fas fa-times-circle"></i> Close</button>
                    <button type="button" id="dengan_webcam" class="btn btn-success"><i class="fas fa-camera-retro"></i> Buka</button>
                </div>
            </div>
        @else
            <div class="row">
                <div class="form-group col-md-12">
                    <input type="hidden" name="foto" id="foto" />
                    <button type="button" id="tanpa_webcam" class="btn btn-danger">Klik ini Tanpa Kamera</button>
                </div>
            </div>
        @endif
    </div>
    <div class="col-lg-1"></div>
</div>

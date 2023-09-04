<dl class="row">
    <dt class="col-sm-4">ID</dt>
    <dd class="col-sm-8"><span id="tamu_id"></span></dd>
    @if (Auth::User())
        @if (Auth::user()->level>1)
            <dt class="col-sm-4">Identitas</dt>
            <dd class="col-sm-8"><span id="tamu_identitas"></span></dd>
            <dt class="col-sm-4">Kode</dt>
            <dd class="col-sm-8"><span id="tamu_kode"></span></dd>
        @endif
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
    <dd></dd>
    <dt></dt>
    <dd class="col-sm-12"><img src="" id="tamu_foto" class="col-sm-12"></dd>
    <dt class="col-sm-4">Kunjungan</dt>
    <dd>&nbsp;</dd>
    <dt></dt>
    <dd class="col-sm-12"><span id="kunjungan_terakhir"></span></dd>

</dl>
<a href="" class="btn btn-success waves-effect m-t-5" id="tamu_timeline">TIMELINE KUNJUNGAN</a>

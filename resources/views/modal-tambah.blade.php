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
                    <dt class="col-sm-4">Nama Lengkap</dt>
                    <dd class="col-sm-8"><span id="tamu_nama"></span></dd>
                    <dt class="col-sm-4">Identitas</dt>
                    <dd class="col-sm-8"><span id="tamu_identitas"></span></dd>
                    <dt class="col-sm-4">Jenis Kelamin</dt>
                    <dd class="col-sm-8"><span id="tamu_jk"></span></dd>
                    <dt class="col-sm-4">Tanggal Lahir</dt>
                    <dd class="col-sm-8"><span id="tamu_lahir"></span></dd>
                    <dt class="col-sm-4">Pekerjaan</dt>
                    <dd class="col-sm-8"><span id="tamu_kerja"></span> <br /><span id="kerja_detil"></span> <br /><span id="kat_kerja_nama"></span></dd>
                    <dt class="col-sm-4">Pendidikan</dt>
                    <dd class="col-sm-8"><span id="tamu_pendidikan"></span></dd>
                    <dt class="col-sm-4">Kewarganegaraan</dt>
                    <dd class="col-sm-8"><span id="tamu_warga"></span></dd>
                    <dt class="col-sm-4">E-mail</dt>
                    <dd class="col-sm-8"><span id="tamu_email"></span></dd>
                    <dt class="col-sm-4">Telepon</dt>
                    <dd class="col-sm-8"><span id="tamu_telepon"></span></dd>
                    <dt class="col-sm-4">Alamat</dt>
                    <dd class="col-sm-8"><span id="tamu_alamat"></span></dd>
                </dl>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </form>
        </div>
    </div>
</div>
<div class="modal fade" id="FeedbackModal" tabindex="-1" role="dialog" aria-labelledby="vcenter">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h4 class="modal-title" id="FeedbackModal">Feedback Kunjungan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <dl class="row">
                        <dt class="col-sm-4">Nama Lengkap</dt>
                        <dd class="col-sm-8"><span id="tamu_nama"></span></dd>
                        <dt class="col-sm-4">Identitas</dt>
                        <dd class="col-sm-8"><span id="tamu_identitas"></span></dd>
                        <dt class="col-sm-4">Jenis Kelamin</dt>
                        <dd class="col-sm-8"><span id="tamu_jk"></span></dd>
                        <dt class="col-sm-4">Tanggal Lahir</dt>
                        <dd class="col-sm-8"><span id="tamu_lahir"></span></dd>
                    </dl>
                    <form class="form-horizontal m-t-20" name="feedback" action="{{route('feedback.simpan')}}" method="POST">
                            @csrf
                            <input type="hidden" name="kunjungan_id" id="kunjungan_id" value="" />
                            <input type="hidden" name="tamu_id" id="tamu_id" value="" />
                            <div class="row comment-form-rating">
                                    <div class="form-group col-md-12" id="feedback_nilai">
                                        <label for="feedback_komentar">Penilaian Layanan Kami<span class="text-danger">*</span></label>
                                        <p class="stars">
                                            <div class="starrating risingstar d-flex justify-content-center flex-row-reverse">
                                                    <input type="radio" id="star6" name="feedback_nilai" value="6" required /><label for="star6" title="6 star"></label>
                                                    <input type="radio" id="star5" name="feedback_nilai" value="5" /><label for="star5" title="5 star"></label>
                                                    <input type="radio" id="star4" name="feedback_nilai" value="4" /><label for="star4" title="4 star"></label>
                                                    <input type="radio" id="star3" name="feedback_nilai" value="3" /><label for="star3" title="3 star"></label>
                                                    <input type="radio" id="star2" name="feedback_nilai" value="2" /><label for="star2" title="2 star"></label>
                                                    <input type="radio" id="star1" name="feedback_nilai" value="1" /><label for="star1" title="1 star"></label>
                                                </div>
                                        </p>
                                    </div>
                            </div>
                            <div class="row" style="border:1px solid black;">
                                <div class="form-group col-md-12" id="feedback_gratifikasi">
                                    <label for="feedback_gratifikasi">Menurut Bapak/Ibu, Apakah terdapat petugas yang menerima pemberian imbalan uang/barang/fasilitas <i>diluar ketentuan yang berlaku</i> ? </label>
                                    <div class="float-right">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="imbalan1" name="imbalan_nilai" value="1" class="custom-control-input" />
                                            <label for="imbalan1" title="Ya" class="custom-control-label">Ya</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="imbalan2" name="imbalan_nilai" value="2" required class="custom-control-input"/>
                                            <label for="imbalan2" title="Tidak" class="custom-control-label"><b>Tidak</b></label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row m-t-10" style="border:1px solid black;">
                                <div class="form-group col-md-12" id="feedback_gratifikasi">
                                    <label for="feedback_gratifikasi">Menurut Bapak/Ibu, Apakah terdapat petugas yang melakukan praktik pungutan liar (pungli)?</label>
                                    <div class="float-right">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="pungli1" name="pungli_nilai" value="1" class="custom-control-input" />
                                            <label for="pungli1" title="Ya" class="custom-control-label">Ya</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="pungli2" name="pungli_nilai" value="2" class="custom-control-input" required/>
                                            <label for="pungli2" title="Tidak" class="custom-control-label"><b>Tidak</b></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-t-20">
                                    <div class="form-group col-md-12" id="feedback_text">
                                            <label for="feedback_komentar">Saran/Kritik Anda</label>
                                            <textarea class="form-control" style="border:1px solid black;" rows="4" id="feedback_komentar" name="feedback_komentar"></textarea>
                                    </div>
                            </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">TUTUP</button>
                    <button type="submit" class="btn btn-success waves-effect">KIRIM</button>
                </div>
            </form>
            </div>
        </div>
    </div>

<script>
    function cekUmur(birthDateString) {
        var today = new Date();
        var birthDate = new Date(birthDateString);
        var age = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        return age;
    }
    //script cari identitas
    $('#cek_id').click(function(){

    var jenis = $("#jenis_identitas").val();
    var nomor = $('#nomor_identitas').val();
    if (jenis == "")
    {
        $('#jenis_identitas_error').removeClass("has-danger");
        $('#jenis_identitas_error').addClass("has-danger");
        Swal.fire({
            type: 'error',
            title: 'error',
            text: 'Silakan pilih jenis identitas'
            });
        return false;
    }
    else
    {
        $('#jenis_identitas_error').removeClass("has-danger");
        $('#jenis_identitas_error').addClass("has-success");
    }
    if (nomor == "")
    {
        $('#nomor_identitas_error').removeClass("has-danger");
        $('#nomor_identitas_error').addClass("has-danger");
        Swal.fire({
            type: 'error',
            title: 'error',
            text: 'Masukkan nomor identitas'
            });
        return false;
    }
    else
    {
        $('#nomor_identitas_error').removeClass("has-danger");
        $('#nomor_identitas_error').addClass("has-success");
    }
    $.ajax({
    url : '{{route('cekid',['',''])}}/'+jenis+'/'+nomor,
    method : 'get',
    cache: false,
    dataType: 'json',
    success: function(data){

        if (data.status==false) {
            //buka semua inputan
            $('#nama_lengkap').prop('readonly', false);
            $('#id_jk').prop('disabled', false);
            $('#tgl_lahir').prop('readonly', false);
            $('#id_kerja').prop('disabled', false);
            $('#kat_kerja').prop('disabled', false);
            $('#pekerjaan_detil').prop('readonly', false);
            $('#id_mdidik').prop('disabled', false);
            $('#mwarga').prop('disabled', false);
            $('#email').prop('readonly', false);
            $('#telepon').prop('readonly', false);
            $('#alamat').prop('readonly', false);
            $('#edit_id').prop('disabled', true);

            //kosongan isian
            $('#tamu_id').val("");
            $('#nama_lengkap').val("");
            $('#id_jk').val("");
            $('#tgl_lahir').val("");
            $('#id_kerja').val("");
            $('#kat_kerja').val("");
            $('#pekerjaan_detil').val("");
            $('#id_mdidik').val("");
            $('#mwarga').val("");
            $('#email').val("");
            $('#telepon').val("");
            $('#alamat').val("");
            $('#edit_tamu').val(0);
            $('#tamu_baru').prop('value','1');
        }
        else {
            //success / ada tamu_id
            //inputan dia set readonly dulu
            $('#nama_lengkap').prop('readonly', true);
            $('#id_jk').prop('disabled', true);
            $('#tgl_lahir').prop('readonly', true);
            $('#id_kerja').prop('disabled', true);
            $('#kat_kerja').prop('disabled', true);
            $('#pekerjaan_detil').prop('readonly', true);
            $('#id_mdidik').prop('disabled', true);
            $('#mwarga').prop('disabled', true);
            $('#email').prop('readonly', true);
            $('#telepon').prop('readonly', true);
            $('#alamat').prop('readonly', true);
            $('#edit_id').prop('disabled', false);

            //data di isikan di inputan
            $('#tamu_id').val(data.hasil.tamu_id);
            $('#nama_lengkap').val(data.hasil.nama_lengkap);
            $('#tgl_lahir').val(data.hasil.tgl_lahir);
            $('#id_kerja').val(data.hasil.id_kerja);
            $('#kat_kerja').val(data.hasil.kat_kerja);
            $('#pekerjaan_detil').val(data.hasil.pekerjaan_detil);
            $('#id_mdidik').val(data.hasil.id_mdidik);
            $('#mwarga').val(data.hasil.mwarga);
            $('#email').val(data.hasil.email);
            $('#telepon').val(data.hasil.telepon);
            $('#alamat').val(data.hasil.alamat);
            $('#id_jk').val(data.hasil.id_jk);
            $('#edit_tamu').val(0);
            $('#tamu_baru').prop('value','0');

        }
    },
    error: function(){
        alert("error");
    }

    });
    });
    //batas
    //edit data pengunjung
    $('#edit_id').click(function(){
               //buka semua inputan
                $('#nama_lengkap').prop('readonly', false);
                $('#id_jk').prop('disabled', false);
                $('#tgl_lahir').prop('readonly', false);
                $('#id_kerja').prop('disabled', false);
                $('#kat_kerja').prop('disabled', false);
                $('#pekerjaan_detil').prop('readonly', false);
                $('#id_mdidik').prop('disabled', false);
                $('#mwarga').prop('disabled', false);
                $('#email').prop('readonly', false);
                $('#telepon').prop('readonly', false);
                $('#alamat').prop('readonly', false);
                $('#edit_tamu').val(1);
                $('#tamu_baru').prop('value','1');
           });
    //batas edit
    //foto baru
    $('#reset_foto').click(function(){
        $('#canvas').hide();
        $('#video').toggle();
        $('#reset_foto').prop('disabled', true);
        $('#ambil_foto').prop('disabled', false);
        $('#tambah_data').prop('disabled', true);
    });
    //tanpa webcam
    $('#tanpa_webcam').click(function(){
        $('#canvas').hide();
        $('#video').hide();
        //$('#reset_foto').prop('disabled', true);
        //$('#ambil_foto').prop('disabled', true);
        //$('#tambah_data').prop('disabled', false);
        $('#reset_foto').hide();
        $('#ambil_foto').hide();
        $('#tambah_data').prop('disabled', false);
        $('#dengan_webcam').show();
        $('#tanpa_webcam').hide();
        $('#foto').prop('value',null);
    });
    //dengan webcam click

    $('#dengan_webcam').click(function(){
        $('#canvas').hide();
        $('#video').show();
        $('#reset_foto').show();
        $('#ambil_foto').show();
        $('#tanpa_webcam').show();
        $('#reset_foto').prop('disabled', true);
        $('#ambil_foto').prop('disabled', false);
        $('#tambah_data').prop('disabled', true);
        $('#dengan_webcam').hide();
    });
    //cek form sebelum submit untuk checkbox
    $('#tambah_data').on('click', function(e) {
        e.preventDefault();
        var jenis_identitas = $('#jenis_identitas').val();
        var nomor_identitas = $('#nomor_identitas').val();
        var tamu_baru = $('#tamu_baru').val();
        var keperluan = $('#keperluan').val();
        //cek isian bila ada tamu baru / tamu di edit
        if (tamu_baru == 1)
        {
            var nama_lengkap = $('#nama_lengkap').val();
            var id_jk = $('#id_jk').val();
            var tgl_lahir = $('#tgl_lahir').val();
            var id_mdidik = $('#id_mdidik').val();
            var id_kerja = $('#id_kerja').val();
            var telepon = $('#telepon').val();
            var kat_kerja = $('#kat_kerja').val();
            var pekerjaan_detil = $('#pekerjaan_detil').val();
            var mwarga = $('#mwarga').val();
            var alamat = $('#alamat').val();
            if (nama_lengkap == "")
            {
                Swal.fire({
                    type: 'error',
                    title: 'error',
                    text: 'Nama lengkap harus terisi'
                    });
                return false;
            }
            if (id_jk == "")
            {
                Swal.fire({
                    type: 'error',
                    title: 'error',
                    text: 'Pilih salah satu jenis kelamin'
                    });
                return false;
            }
            if (tgl_lahir == "")
            {
                Swal.fire({
                    type: 'error',
                    title: 'error',
                    text: 'Tanggal lahir harus terisi'
                    });
                return false;
            }
            if (cekUmur(tgl_lahir) <= 13)
            {
                Swal.fire({
                    type: 'error',
                    title: 'error',
                    text: 'umur minimal 14 tahun'
                    });
                return false;
            }

            if (id_mdidik == "")
            {
                Swal.fire({
                    type: 'error',
                    title: 'error',
                    text: 'Pilih salah satu pendidikan'
                    });
                return false;
            }
            if (id_kerja == "")
            {
                Swal.fire({
                    type: 'error',
                    title: 'error',
                    text: 'Pilih salah satu pekerjaan'
                    });
                return false;
            }
            if (telepon == "")
            {
                Swal.fire({
                    type: 'error',
                    title: 'error',
                    text: 'Silakan masukkan nomor telepon'
                    });
                return false;
            }

            if (telepon.match(/[^\d+]/))
            {
                Swal.fire({
                    type: 'error',
                    title: 'error',
                    text: 'Silakan masukkan nomor telepon hanya angka'
                    });
                return false;
            }
            if (kat_kerja == "")
            {
                Swal.fire({
                    type: 'error',
                    title: 'error',
                    text: 'Pilih salah satu kategori pekerjaan'
                    });
                return false;
            }
            if (pekerjaan_detil == "")
            {
                Swal.fire({
                    type: 'error',
                    title: 'error',
                    text: 'Silakan masukkan Sekolah/Univ/Instansi/Detil Pekerjaan'
                    });
                return false;
            }
            if (mwarga == "")
            {
                Swal.fire({
                    type: 'error',
                    title: 'error',
                    text: 'Silakan pilih salah satu kewarganegaraan'
                    });
                return false;
            }
            if (alamat == "")
            {
                Swal.fire({
                    type: 'error',
                    title: 'error',
                    text: 'Silakan masukkan alamat tempat tinggal'
                    });
                return false;
            }
        }
        //batasnya

        if (jenis_identitas == "")
        {
            Swal.fire({
                type: 'error',
                title: 'error',
                text: 'Pilih salah satu Jenis Identitas'
                });
            return false;
        }

        if (nomor_identitas == "")
        {
            Swal.fire({
                type: 'error',
                title: 'error',
                text: 'Nomor Identitas tidak boleh kosong'
                });
            return false;
        }

        if (keperluan == "")
        {
            $('#keperluan_error').removeClass("has-danger");
            $('#keperluan_error').addClass("has-danger");
            Swal.fire({
                type: 'error',
                title: 'error',
                text: 'Keperluan/Data yang dicari tidak boleh kosong'
                });
            return false;
        }
        else
        {
            $('#keperluan_error').removeClass("has-danger");
            $('#keperluan_error').addClass("has-success");

        }
        var jenis_kunjungan = $('input[name="jenis_kunjungan"]:checked').val();
        if (jenis_kunjungan == 2)
        {
            var jumlah_tamu = $('#jumlah_tamu').val();
            var tamu_laki = $('#tamu_laki').val();
            var tamu_wanita = $('#tamu_wanita').val();
            if (jumlah_tamu == "")
            {
                Swal.fire({
                type: 'error',
                title: 'error',
                text: 'Jumlah tamu harus terisi karena jenis kunjungan kelompok'
                });
                return false;
            }
            else if (jumlah_tamu < 2)
            {
                Swal.fire({
                type: 'error',
                title: 'error',
                text: 'Karena terpilih kelompok, jumlah tamu minimal 2 orang'
                });
                return false;
            }
            if (tamu_laki == "")
            {
                Swal.fire({
                type: 'error',
                title: 'error',
                text: 'Jumlah Tamu Laki-laki minimal terisi 0'
                });
                return false;
            }
            if (tamu_wanita == "")
            {
                Swal.fire({
                type: 'error',
                title: 'error',
                text: 'Jumlah Tamu Perempuan minimal terisi 0'
                });
                return false;
            }
            if (jumlah_tamu != (parseInt(tamu_laki)+parseInt(tamu_wanita)))
            {
                Swal.fire({
                type: 'error',
                title: 'error',
                text: 'Jumlah tamu total ('+jumlah_tamu+') tidak sama dengan jumlah tamu laki-laki ('+tamu_laki+') + jumlah tamu perempuan ('+tamu_wanita+')'
                });
                return false;
            }

        }
        var tujuan_kedatangan = $('input[name="tujuan_kedatangan"]:checked').val();
        if (tujuan_kedatangan == 1)
        {
            //check minimal 1 di chek untuk pst_layanan, pst_fasilitas
            var pst_manfaat = $('#id_manfaat').val();
            var layanan_utama = $('#layanan_id').val();
            var count_layanan = $('.pst_layanan:checked').length;
            var count_fasilitas = $('.pst_fasilitas:checked').length;
            if (pst_manfaat == "")
            {
                Swal.fire({
                    type: 'error',
                    title: 'error',
                    text: 'Pilih salah satu manfaat kunjungan'
                    });
                return false;
            }
            if (pst_manfaat == 5)
            {
                var manfaat_nama = $('#manfaat_nama').val();
                if (manfaat_nama == "")
                {
                    Swal.fire({
                    type: 'error',
                    title: 'error',
                    text: 'Karena terpilih Lainnya, manfaat kunjungan lainnya harus terisi'
                    });
                return false;
                }
            }
            if (layanan_utama == "")
            {
                Swal.fire({
                    type: 'error',
                    title: 'error',
                    text: 'Pilih salah satu layanan utama'
                    });
                return false;
            }
            if (count_layanan <= 0)
            {
                Swal.fire({
                type: 'error',
                title: 'error',
                text: 'Minimal pilih satu Layanan yang dipilih'
                });
                 return false;
            }
            else if (count_fasilitas <= 0)
            {
                Swal.fire({
                type: 'error',
                title: 'error',
                text: 'Minimal pilih satu Tujuan kedatangan yang dipilih'
                });
                 return false;
            }
            else if ($('#fasilitas_32').is(":checked"))
            {
                if ($('#fas_lainnya').val() == "")
                {
                    Swal.fire({
                    type: 'error',
                    title: 'error',
                    text: 'Karena terpilih Lainnya, fasilitas lainnya harus terisi'
                    });
                return false;
                }
                else
                {
                    $('#form_baru').submit();
                }
            }
            else
            {
                $('#form_baru').submit();
            }
        }
        else
        {
            $('#form_baru').submit();
        }
    });
    //script untuk pilih manfaat kunjungan lainnya
    $('#id_manfaat').on('click change', function(e) {
        var pilih_manfaat = e.target.value;
        if (pilih_manfaat == 5)
        {
            $('#manfaat_nama').val('');
            $('#manfaat_nama').show();
            $('.manfaat_nama').prop('required',true);
        }
        else
        {
            var manfaat_nama = $('#id_manfaat option:selected').text();
            $('#manfaat_nama').val(manfaat_nama);
            $('.manfaat_nama').prop('required',false);
            $('#manfaat_nama').hide();
        }
    });
    $('#fasilitas_32').on('change', function() {
        if ($(this).prop('checked'))
        {
            $('#fas_lainnya').val('');
            $('.fas_lainnya').prop('required',true);
            $('#fas_lainnya').show();

        }
        else
        {
            $('#fas_lainnya').val('');
            $('.fas_lainnya').prop('required',false);
            $('#fas_lainnya').hide();
        }
    });

    //batasnya
    //script merubah warna hijau dan merah
    $('#jenis_identitas').on('click change', function(e) {
        var jenis_nilai = e.target.value;
        if (jenis_nilai == 0)
        {
            $('#jenis_identitas_error').removeClass("has-danger");
            $('#jenis_identitas_error').addClass("has-danger");
        }
        else
        {
            $('#jenis_identitas_error').removeClass("has-danger");
            $('#jenis_identitas_error').addClass("has-success");
        }
    });

    $('#nomor_identitas').on('change paste keyup', function(e) {
        var nomor_nilai = e.target.value;
        if (nomor_nilai == "")
        {
            $('#nomor_identitas_error').removeClass("has-danger");
            $('#nomor_identitas_error').addClass("has-danger");
        }
        else if (nomor_nilai.length < 5)
        {
            $('#nomor_identitas_error').removeClass("has-danger");
            $('#nomor_identitas_error').addClass("has-danger");
        }
        else
        {
            $('#nomor_identitas_error').removeClass("has-danger");
            $('#nomor_identitas_error').addClass("has-success");
        }
    });

    $('#keperluan').on('change paste keyup', function(e) {
        var nomor_nilai = e.target.value;
        if (nomor_nilai == "")
        {
            $('#keperluan_error').removeClass("has-danger");
            $('#keperluan_error').addClass("has-danger");
        }
        else if (nomor_nilai.length < 6)
        {
            $('#keperluan_error').removeClass("has-danger");
            $('#keperluan_error').addClass("has-danger");
        }
        else
        {
            $('#keperluan_error').removeClass("has-danger");
            $('#keperluan_error').addClass("has-success");
        }
    });
    //batas

        // Put event listeners into place
    'use strict';
    window.addEventListener("DOMContentLoaded", function() {
                // Grab elements, create settings, etc.
                var canvas = document.getElementById('canvas');
                var context = canvas.getContext('2d');
                var video = document.getElementById('video');
                var mediaConfig =  { video: true };
                var errBack = function(e) {
                    console.log('An error has occurred!', e)
                };

                // Put video listeners into place
                if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                    navigator.mediaDevices.getUserMedia(mediaConfig).then(function(stream) {
                        //video.src = window.URL.createObjectURL(stream);
                        video.srcObject = stream;
                        video.play();
                    });
                }

                /* Legacy code below! */
                else if(navigator.getUserMedia) { // Standard
                    navigator.getUserMedia(mediaConfig, function(stream) {
                        video.src = stream;
                        video.play();
                    }, errBack);
                } else if(navigator.webkitGetUserMedia) { // WebKit-prefixed
                    navigator.webkitGetUserMedia(mediaConfig, function(stream){
                        video.src = window.webkitURL.createObjectURL(stream);
                        video.play();
                    }, errBack);
                } else if(navigator.mozGetUserMedia) { // Mozilla-prefixed
                    navigator.mozGetUserMedia(mediaConfig, function(stream){
                        video.src = window.URL.createObjectURL(stream);
                        video.play();
                    }, errBack);
                }

                // Trigger photo take
                document.getElementById('ambil_foto').addEventListener('click', function() {
                    var canvas = document.getElementById('canvas');
                    var w = video.videoWidth;
                    var h = video.videoHeight;
                    canvas.width = w;
                    canvas.height = h;
                    // context.drawImage(video,0,0,w,h);


                    $('#canvas').toggle();
                    $('#reset_foto').prop('disabled', false);
                    $('#ambil_foto').prop('disabled', true);
                    $('#tambah_data').prop('disabled', false);

                    context.drawImage(video, 0, 0, w,h);
                    //$('#video').hide();
                    var dataURL = canvas.toDataURL('image/png',1.0);
                    $('#foto').val(dataURL);

                    canvas.style.display='block';
                    canvas.style.width = '100%';
                    video.style.display='none';
                });
            }, false);
    </script>

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
    $('#jenis_identitas_label').removeClass("has-danger");
    $('#jenis_identitas_label').addClass("has-danger");
    Swal.fire({
        type: 'error',
        title: 'error',
        text: 'Silakan pilih jenis identitas'
        });
    return false;
}
else
{
    $('#jenis_identitas_label').removeClass("has-danger");
    $('#jenis_identitas_label').addClass("has-success");
}
if (nomor == "")
{
    $('#nomor_identitas_label').removeClass("has-danger");
    $('#nomor_identitas').removeClass("form-control-danger");
    $('#nomor_identitas_label').addClass("has-danger");
    $('#nomor_identitas').addClass("form-control-danger");
    Swal.fire({
        type: 'error',
        title: 'error',
        text: 'Masukkan nomor identitas'
        });
    return false;
}
else
{
    $('#nomor_identitas_label').removeClass("has-danger");
    $('#nomor_identitas').removeClass("form-control-danger");
    $('#nomor_identitas_label').addClass("has-success");
    $('#nomor_identitas').addClass("form-control-success");
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
        $('#keperluan_label_border').removeClass("has-danger");
        $('#keperluan_label_border').addClass("has-danger");
        Swal.fire({
            type: 'error',
            title: 'error',
            text: 'Keperluan/Data yang dicari tidak boleh kosong'
            });
        return false;
    }
    else
    {
        $('#keperluan_label_border').removeClass("has-danger");
        $('#keperluan_label_border').addClass("has-success");

    }


    var tujuan_kedatangan = $('input[name="tujuan_kedatangan"]:checked').val();;
    if (tujuan_kedatangan == 1)
    {
        //check minimal 1 di chek untuk pst_layanan, pst_manfaat
        var count_layanan = $('.pst_layanan:checked').length;
        var count_manfaat = $('.pst_manfaat:checked').length;
        if (count_layanan <= 0)
        {
            Swal.fire({
            type: 'error',
            title: 'error',
            text: 'Minimal pilih satu Layanan yang dipilih'
            });
             return false;
        }
        else if (count_manfaat <= 0)
        {
            Swal.fire({
            type: 'error',
            title: 'error',
            text: 'Minimal pilih satu Tujuan kedatangan yang dipilih'
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

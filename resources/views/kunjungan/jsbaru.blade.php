<script>
//script cari identitas
$('#cek_id').click(function(){

var jenis = $("#jenis_identitas").val();
var nomor = $('#nomor_identitas').val();
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
    $('#reset_foto').prop('disabled', true);
    $('#ambil_foto').prop('disabled', true);
    $('#tambah_data').prop('disabled', false);
});

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
                $('#canvas').toggle();
                $('#reset_foto').prop('disabled', false);
                $('#ambil_foto').prop('disabled', true);
                $('#tambah_data').prop('disabled', false);
                var canvas = document.getElementById('canvas');
				context.drawImage(video, 0, 0, 640, 480);
                $('#video').hide();
                var dataURL = canvas.toDataURL('image/png',0.90);
                $('#TambahModal .modal-body #foto').val(dataURL);
			});
		}, false);
</script>

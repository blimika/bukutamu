<script>
function GetUmur(birthDateString) {
        var today = new Date();
        var age = today.getFullYear() - birthDateString;
        return age;
}
function GetJamMenit(JamString) {
    var tgl = new Date(JamString);
    var hours = tgl.getHours();
    var minutes = tgl.getMinutes();
    if (hours < 10) {hours   = "0"+hours;}
    if (minutes < 10) {minutes = "0"+minutes;}
    var jam = hours+':'+minutes;
    return jam;
}
$('#BeriFeebackModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var uid = button.data('uid')
    //load dulu transaksinya
    $.ajax({
        url : '{{route("webapi")}}/',
        method : 'get',
        data: {
            model: 'kunjungan',
            uid: uid
        },
        cache: false,
        dataType: 'json',
        success: function(d){
            if (d.status == true)
            {
                //value
            $('#BeriFeebackModal .modal-body #edit_uid').val(d.data.kunjungan_uid)
            $('#BeriFeebackModal .modal-body #edit_id').val(d.data.kunjungan_id)
            $('#BeriFeebackModal .modal-body #kunjungan_id').text('#'+d.data.kunjungan_id)
            $('#BeriFeebackModal .modal-body #kunjungan_uid').text(d.data.kunjungan_uid)
            $('#BeriFeebackModal .modal-body #pengunjung_nama').text(d.data.pengunjung.pengunjung_nama)
            $('#BeriFeebackModal .modal-body #pengunjung_jk').text(d.data.pengunjung.jenis_kelamin.nama)
            $('#BeriFeebackModal .modal-body #kunjungan_tanggal').text(d.data.kunjungan_tanggal)

            $('#BeriFeebackModal .modal-body #kunjungan_nomor_antrian').text(d.data.kunjungan_teks_antrian)
            if (d.data.kunjungan_flag_antrian == 1)
            {
                var warna_flag_antrian = 'badge-danger';
            }
            else if (d.data.kunjungan_flag_antrian == 2)
            {
                var warna_flag_antrian = 'badge-warning';
            }
            else
            {
                var warna_flag_antrian = 'badge-success';
            }
            $('#BeriFeebackModal .modal-body #kunjungan_flag_antrian').html('<span class="badge '+warna_flag_antrian+' badge-pill">'+d.data.flag_antrian.nama+'</span>')
            if (d.data.kunjungan_jenis == 1)
            {
                //perorangan
                $('#BeriFeebackModal .modal-body #kunjungan_jenis').html('<span class="badge badge-info badge-pill">'+d.data.jenis_kunjungan.nama+'</span>')
            }
            else
            {
                $('#BeriFeebackModal .modal-body #kunjungan_jenis').html('<span class="badge badge-primary badge-pill">'+d.data.jenis_kunjungan.nama+' ('+d.data.kunjungan_jumlah_orang+' org)</span> <span class="badge badge-info badge-pill">L'+d.data.kunjungan_jumlah_pria+'</span> <span class="badge badge-danger badge-pill">P'+d.data.kunjungan_jumlah_wanita+'</span>')
            }

            if (d.data.kunjungan_tujuan == 1)
            {
                $('#BeriFeebackModal .modal-body #kunjungan_tujuan').html('<span class="badge badge-info badge-pill">'+d.data.tujuan.nama+'</span> <span class="badge badge-success badge-pill">'+d.data.layanan_kantor.nama+'</span>')
            }
            else if (d.data.kunjungan_tujuan == 2)
            {
                $('#BeriFeebackModal .modal-body #kunjungan_tujuan').html('<span class="badge badge-info badge-pill">'+d.data.tujuan.inisial+'</span> <span class="badge badge-success badge-pill">'+d.data.layanan_utama.nama+'</span>')
            }
            else
            {
                $('#BeriFeebackModal .modal-body #kunjungan_tujuan').html('<span class="badge badge-danger badge-pill">'+d.data.tujuan.nama+'</span>')
            }
            $('#BeriFeebackModal .modal-body #kunjungan_jam_datang').text(GetJamMenit(d.data.kunjungan_jam_datang))
            $('#BeriFeebackModal .modal-body #kunjungan_jam_pulang').text(GetJamMenit(d.data.kunjungan_jam_pulang))
            $('#BeriFeebackModal .modal-body #kunjungan_petugas_nama').text(d.data.petugas.name)
            }
            else
            {
                alert(d.message);
            }
        },
        error: function(){
            alert("error load page");
        }

    });
});
//feedback di simpan
$('#BeriFeebackModal .modal-footer #simpanFeedback').on('click', function(e) {
    e.preventDefault();
    var kunjungan_id = $('#BeriFeebackModal .modal-body #edit_id').val();
    var kunjungan_uid = $('#BeriFeebackModal .modal-body #edit_uid').val();
    var feedback_nilai = $('#BeriFeebackModal .modal-body input[type="radio"][name="feedback_nilai"]:checked').val();
    var feedback_komentar = $('#BeriFeebackModal .modal-body #feedback_komentar').val();
    if (feedback_nilai == "")
    {
        $('#BeriFeebackModal .modal-body #feedback_error').text('Berikan nilai untuk layanan kami');
        return false;
    }
    else
    {
        //ajax responsen
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url : '{{route("feedbacksave")}}',
            method : 'post',
            data: {
                kunjungan_id: kunjungan_id,
                kunjungan_uid: kunjungan_uid,
                feedback_nilai: feedback_nilai,
                feedback_komentar: feedback_komentar
            },
            cache: false,
            dataType: 'json',
            success: function(data){
                if (data.status == true)
                {
                    Swal.fire(
                        'Berhasil!',
                        ''+data.message+'',
                        'success'
                    ).then(function() {
                        $('#dTabel').DataTable().ajax.reload(null,false);
                    });
                }
                else
                {
                    Swal.fire(
                        'Error!',
                        ''+data.message+'',
                        'error'
                    );
                }

            },
            error: function(){
                Swal.fire(
                    'Error',
                    'Koneksi Error',
                    'error'
                );
            }

        });
        //batas
    }

});
//batas feedback simpan

//view feedback
$('#ViewFeedbackModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var uid = button.data('uid')
    //load dulu transaksinya
    $.ajax({
        url : '{{route("webapi")}}/',
        method : 'get',
        data: {
            model: 'kunjungan',
            uid: uid
        },
        cache: false,
        dataType: 'json',
        success: function(d){
            if (d.status == true)
            {
                //value
            $('#ViewFeedbackModal .modal-body #edit_uid').val(d.data.kunjungan_uid)
            $('#ViewFeedbackModal .modal-body #edit_id').val(d.data.kunjungan_id)
            $('#ViewFeedbackModal .modal-body #kunjungan_id').text('#'+d.data.kunjungan_id)
            $('#ViewFeedbackModal .modal-body #kunjungan_uid').text(d.data.kunjungan_uid)
            $('#ViewFeedbackModal .modal-body #pengunjung_nama').text(d.data.pengunjung.pengunjung_nama)
            $('#ViewFeedbackModal .modal-body #pengunjung_jk').text(d.data.pengunjung.jenis_kelamin.nama)
            $('#ViewFeedbackModal .modal-body #kunjungan_tanggal').text(d.data.kunjungan_tanggal)

            $('#ViewFeedbackModal .modal-body #kunjungan_nomor_antrian').text(d.data.kunjungan_teks_antrian)
            if (d.data.kunjungan_flag_antrian == 1)
            {
                var warna_flag_antrian = 'badge-danger';
            }
            else if (d.data.kunjungan_flag_antrian == 2)
            {
                var warna_flag_antrian = 'badge-warning';
            }
            else
            {
                var warna_flag_antrian = 'badge-success';
            }
            $('#ViewFeedbackModal .modal-body #kunjungan_flag_antrian').html('<span class="badge '+warna_flag_antrian+' badge-pill">'+d.data.flag_antrian.nama+'</span>')
            if (d.data.kunjungan_jenis == 1)
            {
                //perorangan
                $('#ViewFeedbackModal .modal-body #kunjungan_jenis').html('<span class="badge badge-info badge-pill">'+d.data.jenis_kunjungan.nama+'</span>')
            }
            else
            {
                $('#ViewFeedbackModal .modal-body #kunjungan_jenis').html('<span class="badge badge-primary badge-pill">'+d.data.jenis_kunjungan.nama+' ('+d.data.kunjungan_jumlah_orang+' org)</span> <span class="badge badge-info badge-pill">L'+d.data.kunjungan_jumlah_pria+'</span> <span class="badge badge-danger badge-pill">P'+d.data.kunjungan_jumlah_wanita+'</span>')
            }

            if (d.data.kunjungan_tujuan == 1)
            {
                $('#ViewFeedbackModal .modal-body #kunjungan_tujuan').html('<span class="badge badge-info badge-pill">'+d.data.tujuan.nama+'</span> <span class="badge badge-success badge-pill">'+d.data.layanan_kantor.nama+'</span>')
            }
            else if (d.data.kunjungan_tujuan == 2)
            {
                $('#ViewFeedbackModal .modal-body #kunjungan_tujuan').html('<span class="badge badge-info badge-pill">'+d.data.tujuan.inisial+'</span> <span class="badge badge-success badge-pill">'+d.data.layanan_utama.nama+'</span>')
            }
            else
            {
                $('#ViewFeedbackModal .modal-body #kunjungan_tujuan').html('<span class="badge badge-danger badge-pill">'+d.data.tujuan.nama+'</span>')
            }
            $('#ViewFeedbackModal .modal-body #kunjungan_jam_datang').text(GetJamMenit(d.data.kunjungan_jam_datang))
            $('#ViewFeedbackModal .modal-body #kunjungan_jam_pulang').text(GetJamMenit(d.data.kunjungan_jam_pulang))
            $('#ViewFeedbackModal .modal-body #kunjungan_petugas_nama').text(d.data.petugas.name)
            if (d.data.kunjungan_flag_feedback == 1)
            {
                var warna_flag_feedback = 'badge-danger';
                var teks_flag_feedback = 'belum';
            }
            else
            {
                var warna_flag_feedback = 'badge-success';
                var teks_flag_feedback = 'sudah';
            }
            $('#ViewFeedbackModal .modal-body #kunjungan_flag_feedback').html('<span class="badge '+warna_flag_feedback+' badge-pill">'+teks_flag_feedback+'</span>')
            //feedback nilai
            var nilai_feedback = d.data.kunjungan_nilai_feedback;
            var teks = "";
            for (i = 1; i < 7; i++) {
                if (i <= nilai_feedback)
                {
                    teks += '<span class="fa fa-star text-warning"></span>';
                }
                else
                {
                    teks +='<span class="fa fa-star"></span>';
                }
            }
            if (d.data.kunjungan_tanggal_feedback == null)
            {
                var tanggal_feedback = "<i>---tidak tersedia----</i>";
            }
            else
            {
                //var tanggal_feedback = moment(d.data.kunjungan_tanggal_feedback);
                var tanggal_feedback = moment(d.data.kunjungan_tanggal_feedback).locale('id').format('LLLL');
            }
            if (d.data.kunjungan_ip_feedback == null)
            {
                var ip_feedback = "<i>---tidak tersedia----</i>";
            }
            else
            {
                var ip_feedback = d.data.kunjungan_ip_feedback;
            }
            $('#ViewFeedbackModal .modal-body #kunjungan_nilai_feedback').html(teks)
            $('#ViewFeedbackModal .modal-body #kunjungan_komentar_feedback').html(d.data.kunjungan_komentar_feedback)
            $('#ViewFeedbackModal .modal-body #kunjungan_tanggal_feedback').html(tanggal_feedback)
            $('#ViewFeedbackModal .modal-body #kunjungan_ip_feedback').html(ip_feedback)
            }
            else
            {
                alert(d.message);
            }
        },
        error: function(){
            alert("error load page");
        }

    });
});
//batas view feedback
</script>

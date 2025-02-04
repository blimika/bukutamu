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
$('#ViewKunjunganModal').on('show.bs.modal', function (event) {
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
            $('#ViewKunjunganModal .modal-body #kunjungan_id').text('#'+d.data.kunjungan_id)
            $('#ViewKunjunganModal .modal-body #kunjungan_uid').text(d.data.kunjungan_uid)
            $('#ViewKunjunganModal .modal-body #pengunjung_nama').text(d.data.pengunjung.pengunjung_nama)
            $('#ViewKunjunganModal .modal-body #pengunjung_jk').text(d.data.pengunjung.jenis_kelamin.nama)
            $('#ViewKunjunganModal .modal-body #pengunjung_tahun_lahir').text(d.data.pengunjung.pengunjung_tahun_lahir+' ('+ GetUmur(d.data.pengunjung.pengunjung_tahun_lahir) + ' tahun)')
            $('#ViewKunjunganModal .modal-body #pengunjung_pekerjaan').text(d.data.pengunjung.pengunjung_pekerjaan)
            $('#ViewKunjunganModal .modal-body #pengunjung_pendidikan').text(d.data.pengunjung.pendidikan.nama)
            $('#ViewKunjunganModal .modal-body #pengunjung_email').text(d.data.pengunjung.pengunjung_email)
            $('#ViewKunjunganModal .modal-body #pengunjung_nomor_hp').text(d.data.pengunjung.pengunjung_nomor_hp)
            if (d.data.pengunjung.pengunjung_nomor_hp != null)
            {
                var pengunjung_nomor_hp = d.data.pengunjung.pengunjung_nomor_hp.substr(1);
                var pengunjung_wa = "http://wa.me/62"+pengunjung_nomor_hp;
            }
            else
            {
                var pengunjung_wa = "#";
            }
            $('#ViewKunjunganModal .modal-body #pengunjung_wa').attr("href",pengunjung_wa)
            $('#ViewKunjunganModal .modal-body #pengunjung_alamat').text(d.data.pengunjung.pengunjung_alamat)
            $('#ViewKunjunganModal .modal-footer #pengunjung_timeline').attr("href","{{route('timeline','')}}/"+d.data.pengunjung.pengunjung_uid)
            $('#ViewKunjunganModal .modal-body #kunjungan_tanggal').text(d.data.kunjungan_tanggal)
            if (d.data.kunjungan_foto != null)
                {
                    $('#ViewKunjunganModal .modal-body #kunjungan_foto').attr("src",'{{asset("storage")}}'+d.data.kunjungan_foto)
                }
                else
                {
                    $('#ViewKunjunganModal .modal-body #kunjungan_foto').attr("src","https://placehold.co/480x360/0000FF/FFFFFF/?text=belum+ada+photo")
                }
            $('#ViewKunjunganModal .modal-body #kunjungan_nomor_antrian').text(d.data.kunjungan_teks_antrian)
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
            $('#ViewKunjunganModal .modal-body #kunjungan_flag_antrian').html('<span class="badge '+warna_flag_antrian+' badge-pill">'+d.data.flag_antrian.nama+'</span>')
            if (d.data.kunjungan_jenis == 1)
            {
                //perorangan
                $('#ViewKunjunganModal .modal-body #kunjungan_jenis').html('<span class="badge badge-info badge-pill">'+d.data.jenis_kunjungan.nama+'</span>')
            }
            else
            {
                $('#ViewKunjunganModal .modal-body #kunjungan_jenis').html('<span class="badge badge-primary badge-pill">'+d.data.jenis_kunjungan.nama+' ('+d.data.kunjungan_jumlah_orang+' org)</span> <span class="badge badge-info badge-pill">L'+d.data.kunjungan_jumlah_pria+'</span> <span class="badge badge-danger badge-pill">P'+d.data.kunjungan_jumlah_wanita+'</span>')
            }

            if (d.data.kunjungan_tujuan == 2)
            {
                $('#ViewKunjunganModal .modal-body #kunjungan_tujuan').html('<span class="badge badge-info badge-pill">'+d.data.tujuan.inisial+'</span> <span class="badge badge-success badge-pill">'+d.data.layanan_utama.nama+'</span>')
            }
            else
            {
                $('#ViewKunjunganModal .modal-body #kunjungan_tujuan').html('<span class="badge badge-danger badge-pill">'+d.data.tujuan.nama+'</span>')
            }
            $('#ViewKunjunganModal .modal-body #kunjungan_jam_datang').text(GetJamMenit(d.data.kunjungan_jam_datang))
            $('#ViewKunjunganModal .modal-body #kunjungan_jam_pulang').text(GetJamMenit(d.data.kunjungan_jam_pulang))
            $('#ViewKunjunganModal .modal-body #kunjungan_keperluan').html(d.data.kunjungan_keperluan)
            $('#ViewKunjunganModal .modal-body #kunjungan_tindak_lanjut').html(d.data.kunjungan_tindak_lanjut)
            }
            else
            {
                alert(d.message);
            }
        },
        error: function(){
            alert("error load transaksi");
        }

    });
});

$('#EditFlagAntrianModal').on('show.bs.modal', function (event) {
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
            $('#EditFlagAntrianModal .modal-body #edit_flag_antrian').val(d.data.kunjungan_flag_antrian)
            $('#EditFlagAntrianModal .modal-body #edit_uid').val(d.data.kunjungan_uid)
            $('#EditFlagAntrianModal .modal-body #edit_id').val(d.data.kunjungan_id)
            $('#EditFlagAntrianModal .modal-body #kunjungan_id').text('#'+d.data.kunjungan_id)
            $('#EditFlagAntrianModal .modal-body #kunjungan_uid').text(d.data.kunjungan_uid)
            $('#EditFlagAntrianModal .modal-body #pengunjung_nama').text(d.data.pengunjung.pengunjung_nama)
            $('#EditFlagAntrianModal .modal-body #pengunjung_jk').text(d.data.pengunjung.jenis_kelamin.nama)
            $('#EditFlagAntrianModal .modal-footer #pengunjung_timeline').attr("href","{{route('timeline','')}}/"+d.data.pengunjung.pengunjung_uid)
            $('#EditFlagAntrianModal .modal-body #kunjungan_tanggal').text(d.data.kunjungan_tanggal)

            $('#EditFlagAntrianModal .modal-body #kunjungan_nomor_antrian').text(d.data.kunjungan_teks_antrian)
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
            $('#EditFlagAntrianModal .modal-body #kunjungan_flag_antrian').html('<span class="badge '+warna_flag_antrian+' badge-pill">'+d.data.flag_antrian.nama+'</span>')
            if (d.data.kunjungan_jenis == 1)
            {
                //perorangan
                $('#EditFlagAntrianModal .modal-body #kunjungan_jenis').html('<span class="badge badge-info badge-pill">'+d.data.jenis_kunjungan.nama+'</span>')
            }
            else
            {
                $('#EditFlagAntrianModal .modal-body #kunjungan_jenis').html('<span class="badge badge-primary badge-pill">'+d.data.jenis_kunjungan.nama+' ('+d.data.kunjungan_jumlah_orang+' org)</span> <span class="badge badge-info badge-pill">L'+d.data.kunjungan_jumlah_pria+'</span> <span class="badge badge-danger badge-pill">P'+d.data.kunjungan_jumlah_wanita+'</span>')
            }

            if (d.data.kunjungan_tujuan == 2)
            {
                $('#EditFlagAntrianModal .modal-body #kunjungan_tujuan').html('<span class="badge badge-info badge-pill">'+d.data.tujuan.inisial+'</span> <span class="badge badge-success badge-pill">'+d.data.layanan_utama.nama+'</span>')
            }
            else
            {
                $('#EditFlagAntrianModal .modal-body #kunjungan_tujuan').html('<span class="badge badge-danger badge-pill">'+d.data.tujuan.nama+'</span>')
            }
            $('#EditFlagAntrianModal .modal-body #kunjungan_jam_datang').text(GetJamMenit(d.data.kunjungan_jam_datang))
            $('#EditFlagAntrianModal .modal-body #kunjungan_jam_pulang').text(GetJamMenit(d.data.kunjungan_jam_pulang))

            }
            else
            {
                alert(d.message);
            }
        },
        error: function(){
            alert("error load transaksi");
        }

    });
});

$('#EditFlagAntrianModal .modal-footer #updateFlagAntrian').on('click', function(e) {
    e.preventDefault();
    var kunjungan_id = $('#EditFlagAntrianModal .modal-body #edit_id').val();
    var kunjungan_uid = $('#EditFlagAntrianModal .modal-body #edit_uid').val();
    var kunjungan_flag_antrian = $('#EditFlagAntrianModal .modal-body #edit_flag_antrian').val();

    if (kunjungan_flag_antrian == "")
    {
        $('#EditFlagAntrianModal .modal-body #edit_kunjungan_error').text('Pilih salah satu flag antrian');
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
            url : '{{route('flagantrian.update')}}',
            method : 'post',
            data: {
                kunjungan_id: kunjungan_id,
                kunjungan_uid: kunjungan_uid,
                kunjungan_flag_antrian: kunjungan_flag_antrian,
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
//tindak lanjut
$('#EditTindakLanjutModal').on('show.bs.modal', function (event) {
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
            $('#EditTindakLanjutModal .modal-body #edit_flag_antrian').val(d.data.kunjungan_flag_antrian)
            $('#EditTindakLanjutModal .modal-body #edit_uid').val(d.data.kunjungan_uid)
            $('#EditTindakLanjutModal .modal-body #edit_id').val(d.data.kunjungan_id)
            $('#EditTindakLanjutModal .modal-body #kunjungan_id').text('#'+d.data.kunjungan_id)
            $('#EditTindakLanjutModal .modal-body #kunjungan_uid').text(d.data.kunjungan_uid)
            $('#EditTindakLanjutModal .modal-body #pengunjung_nama').text(d.data.pengunjung.pengunjung_nama)
            $('#EditTindakLanjutModal .modal-body #pengunjung_jk').text(d.data.pengunjung.jenis_kelamin.nama)
            $('#EditTindakLanjutModal .modal-body #kunjungan_tanggal').text(d.data.kunjungan_tanggal)
            $('#EditTindakLanjutModal .modal-body #kunjungan_nomor_antrian').text(d.data.kunjungan_teks_antrian)
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
            $('#EditTindakLanjutModal .modal-body #kunjungan_flag_antrian').html('<span class="badge '+warna_flag_antrian+' badge-pill">'+d.data.flag_antrian.nama+'</span>')
            if (d.data.kunjungan_jenis == 1)
            {
                //perorangan
                $('#EditTindakLanjutModal .modal-body #kunjungan_jenis').html('<span class="badge badge-info badge-pill">'+d.data.jenis_kunjungan.nama+'</span>')
            }
            else
            {
                $('#EditTindakLanjutModal .modal-body #kunjungan_jenis').html('<span class="badge badge-primary badge-pill">'+d.data.jenis_kunjungan.nama+' ('+d.data.kunjungan_jumlah_orang+' org)</span> <span class="badge badge-info badge-pill">L'+d.data.kunjungan_jumlah_pria+'</span> <span class="badge badge-danger badge-pill">P'+d.data.kunjungan_jumlah_wanita+'</span>')
            }

            if (d.data.kunjungan_tujuan == 2)
            {
                $('#EditTindakLanjutModal .modal-body #kunjungan_tujuan').html('<span class="badge badge-info badge-pill">'+d.data.tujuan.inisial+'</span> <span class="badge badge-success badge-pill">'+d.data.layanan_utama.nama+'</span>')
            }
            else
            {
                $('#EditTindakLanjutModal .modal-body #kunjungan_tujuan').html('<span class="badge badge-danger badge-pill">'+d.data.tujuan.nama+'</span>')
            }
            $('#EditTindakLanjutModal .modal-body #kunjungan_jam_datang').text(GetJamMenit(d.data.kunjungan_jam_datang))
            $('#EditTindakLanjutModal .modal-body #kunjungan_jam_pulang').text(GetJamMenit(d.data.kunjungan_jam_pulang))
            $('#EditTindakLanjutModal .modal-body #kunjungan_petugas_nama').text(d.data.petugas.name)
            $('#EditTindakLanjutModal .modal-body #kunjungan_keperluan').html(d.data.kunjungan_keperluan)
            $('#EditTindakLanjutModal .modal-body #kunjungan_tindak_lanjut').val(d.data.kunjungan_tindak_lanjut)
            }
            else
            {
                alert(d.message);
            }
        },
        error: function(){
            alert("error load transaksi");
        }

    });
});

//simpan tindak lanjut

$('#EditTindakLanjutModal .modal-footer #simpanTindakLanjut').on('click', function(e) {
    e.preventDefault();
    var kunjungan_id = $('#EditTindakLanjutModal .modal-body #edit_id').val();
    var kunjungan_uid = $('#EditTindakLanjutModal .modal-body #edit_uid').val();
    var tindak_lanjut = $('#EditTindakLanjutModal .modal-body #kunjungan_tindak_lanjut').val();

    if (tindak_lanjut == "")
    {
        $('#EditTindakLanjutModal .modal-body #tindak_lanjut_error').text('tindak lanjut tidak boleh kosong');
        return false;
    }
    else if (tindak_lanjut.length < 10)
    {
        $('#EditTindakLanjutModal .modal-body #tindak_lanjut_error').text('isian tindak lanjut tidak boleh kurang dari 10 karakter');
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
            url : '{{route("tindaklanjut.save")}}',
            method : 'post',
            data: {
                kunjungan_id: kunjungan_id,
                kunjungan_uid: kunjungan_uid,
                kunjungan_tindak_lanjut: tindak_lanjut
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
//batas tindak lanjut
//ubah tujuan
$('#EditTujuanModal').on('show.bs.modal', function (event) {
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
            $('#EditTujuanModal .modal-body #edit_flag_antrian').val(d.data.kunjungan_flag_antrian)
            $('#EditTujuanModal .modal-body #edit_uid').val(d.data.kunjungan_uid)
            $('#EditTujuanModal .modal-body #edit_id').val(d.data.kunjungan_id)
            $('#EditTujuanModal .modal-body #kunjungan_id').text('#'+d.data.kunjungan_id)
            $('#EditTujuanModal .modal-body #kunjungan_uid').text(d.data.kunjungan_uid)
            $('#EditTujuanModal .modal-body #pengunjung_nama').text(d.data.pengunjung.pengunjung_nama)
            $('#EditTujuanModal .modal-body #pengunjung_jk').text(d.data.pengunjung.jenis_kelamin.nama)
            $('#EditTujuanModal .modal-body #kunjungan_tanggal').text(d.data.kunjungan_tanggal)
            $('#EditTujuanModal .modal-body #kunjungan_nomor_antrian').text(d.data.kunjungan_teks_antrian)
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
            $('#EditTujuanModal .modal-body #kunjungan_flag_antrian').html('<span class="badge '+warna_flag_antrian+' badge-pill">'+d.data.flag_antrian.nama+'</span>')
            if (d.data.kunjungan_jenis == 1)
            {
                //perorangan
                $('#EditTujuanModal .modal-body #kunjungan_jenis').html('<span class="badge badge-info badge-pill">'+d.data.jenis_kunjungan.nama+'</span>')
            }
            else
            {
                $('#EditTujuanModal .modal-body #kunjungan_jenis').html('<span class="badge badge-primary badge-pill">'+d.data.jenis_kunjungan.nama+' ('+d.data.kunjungan_jumlah_orang+' org)</span> <span class="badge badge-info badge-pill">L'+d.data.kunjungan_jumlah_pria+'</span> <span class="badge badge-danger badge-pill">P'+d.data.kunjungan_jumlah_wanita+'</span>')
            }

            if (d.data.kunjungan_tujuan == 2)
            {
                $('#EditTujuanModal .modal-body #kunjungan_tujuan').html('<span class="badge badge-info badge-pill">'+d.data.tujuan.inisial+'</span> <span class="badge badge-success badge-pill">'+d.data.layanan_utama.nama+'</span>')
            }
            else
            {
                $('#EditTujuanModal .modal-body #kunjungan_tujuan').html('<span class="badge badge-danger badge-pill">'+d.data.tujuan.nama+'</span>')
            }
            $('#EditTujuanModal .modal-body #kunjungan_jam_datang').text(GetJamMenit(d.data.kunjungan_jam_datang))
            $('#EditTujuanModal .modal-body #kunjungan_jam_pulang').text(GetJamMenit(d.data.kunjungan_jam_pulang))
            $('#EditTujuanModal .modal-body #kunjungan_petugas_nama').text(d.data.petugas.name)
            $('#EditTujuanModal .modal-body #kunjungan_keperluan').text(d.data.kunjungan_keperluan)
            $('#EditTujuanModal .modal-body #kunjungan_tujuan_baru').val(d.data.kunjungan_tujuan)
            $('#EditTujuanModal .modal-body #layananpst_kode_baru').val(d.data.layanan_utama.kode)
                if (d.data.kunjungan_tujuan == 2)
                {
                    $('#EditTujuanModal .modal-body #row_layananpst').show();
                }
                else
                {
                    $('#EditTujuanModal .modal-body #row_layananpst').hide();
                }
            }
            else
            {
                alert(d.message);
            }
        },
        error: function(){
            alert("error load transaksi");
        }

    });
    $('#EditTujuanModal .modal-body #kunjungan_tujuan_baru').change(function(){
    var kunjungan_tujuan = $('#EditTujuanModal .modal-body #kunjungan_tujuan_baru').val();
    if (kunjungan_tujuan == 2)
    {
        $('#EditTujuanModal .modal-body #row_layananpst').show();
    }
    else
    {
        $('#EditTujuanModal .modal-body #row_layananpst').hide();
    }

});
});

$('#EditTujuanModal .modal-footer #simpanTujuanBaru').on('click', function(e) {
    e.preventDefault();
    var kunjungan_id = $('#EditTujuanModal .modal-body #edit_id').val();
    var kunjungan_uid = $('#EditTujuanModal .modal-body #edit_uid').val();
    var tujuan_baru = $('#EditTujuanModal .modal-body #kunjungan_tujuan_baru').val();
    var layanan_pst_baru = $('#EditTujuanModal .modal-body #layananpst_kode_baru').val();
    if (tujuan_baru == "")
    {
        $('#EditTujuanModal .modal-body #tujuan_baru_error').text('Pilih salah satu tujuan');
        return false;
    }
    else if (tujuan_baru == 2 && layanan_pst_baru < 1 )
    {
        $('#EditTujuanModal .modal-body #tujuan_baru_error').text('Tujuan PST, layanan pst harus terpilih selain lainnya');
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
            url : '{{route("tujuanbaru.save")}}',
            method : 'post',
            data: {
                kunjungan_id: kunjungan_id,
                kunjungan_uid: kunjungan_uid,
                kunjungan_tujuan_baru: tujuan_baru,
                kunjungan_layanan_pst_baru: layanan_pst_baru
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
//batas ubah tujuan
//jenis kunjungan
$('#EditJenisKunjunganModal').on('show.bs.modal', function (event) {
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
            $('#EditJenisKunjunganModal .modal-body #edit_flag_antrian').val(d.data.kunjungan_flag_antrian)
            $('#EditJenisKunjunganModal .modal-body #edit_uid').val(d.data.kunjungan_uid)
            $('#EditJenisKunjunganModal .modal-body #edit_id').val(d.data.kunjungan_id)
            $('#EditJenisKunjunganModal .modal-body #kunjungan_id').text('#'+d.data.kunjungan_id)
            $('#EditJenisKunjunganModal .modal-body #kunjungan_uid').text(d.data.kunjungan_uid)
            $('#EditJenisKunjunganModal .modal-body #pengunjung_nama').text(d.data.pengunjung.pengunjung_nama)
            $('#EditJenisKunjunganModal .modal-body #pengunjung_jk').text(d.data.pengunjung.jenis_kelamin.nama)
            $('#EditJenisKunjunganModal .modal-body #kunjungan_tanggal').text(d.data.kunjungan_tanggal)
            $('#EditJenisKunjunganModal .modal-body #kunjungan_nomor_antrian').text(d.data.kunjungan_teks_antrian)
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
            $('#EditJenisKunjunganModal .modal-body #kunjungan_flag_antrian').html('<span class="badge '+warna_flag_antrian+' badge-pill">'+d.data.flag_antrian.nama+'</span>')
            if (d.data.kunjungan_jenis == 1)
            {
                //perorangan
                $('#EditJenisKunjunganModal .modal-body #kunjungan_jenis').html('<span class="badge badge-info badge-pill">'+d.data.jenis_kunjungan.nama+'</span>')
            }
            else
            {
                $('#EditJenisKunjunganModal .modal-body #kunjungan_jenis').html('<span class="badge badge-primary badge-pill">'+d.data.jenis_kunjungan.nama+' ('+d.data.kunjungan_jumlah_orang+' org)</span> <span class="badge badge-info badge-pill">L'+d.data.kunjungan_jumlah_pria+'</span> <span class="badge badge-danger badge-pill">P'+d.data.kunjungan_jumlah_wanita+'</span>')
            }

            if (d.data.kunjungan_tujuan == 2)
            {
                $('#EditJenisKunjunganModal .modal-body #kunjungan_tujuan').html('<span class="badge badge-info badge-pill">'+d.data.tujuan.inisial+'</span> <span class="badge badge-success badge-pill">'+d.data.layanan_utama.nama+'</span>')
            }
            else
            {
                $('#EditJenisKunjunganModal .modal-body #kunjungan_tujuan').html('<span class="badge badge-danger badge-pill">'+d.data.tujuan.nama+'</span>')
            }
            $('#EditJenisKunjunganModal .modal-body #kunjungan_jam_datang').text(GetJamMenit(d.data.kunjungan_jam_datang))
            $('#EditJenisKunjunganModal .modal-body #kunjungan_jam_pulang').text(GetJamMenit(d.data.kunjungan_jam_pulang))
            $('#EditJenisKunjunganModal .modal-body #kunjungan_petugas_nama').text(d.data.petugas.name)
            $('#EditJenisKunjunganModal .modal-body #kunjungan_keperluan').text(d.data.kunjungan_keperluan)
            $('#EditJenisKunjunganModal .modal-body #kunjungan_jenis_baru').val(d.data.kunjungan_jenis)
                if (d.data.kunjungan_jenis == 2)
                {
                    $('#EditJenisKunjunganModal .modal-body #row_kelompok').show();
                }
                else
                {
                    $('#EditJenisKunjunganModal .modal-body #row_kelompok').hide();
                }
             $('#EditJenisKunjunganModal .modal-body #jumlah_orang').val(d.data.kunjungan_jumlah_orang)
             $('#EditJenisKunjunganModal .modal-body #jumlah_pria').val(d.data.kunjungan_jumlah_pria)
             $('#EditJenisKunjunganModal .modal-body #jumlah_wanita').val(d.data.kunjungan_jumlah_wanita)
             if (d.data.kunjungan_foto != null)
                {
                    $('#EditJenisKunjunganModal .modal-body #kunjungan_foto').attr("src",'{{asset("storage")}}'+d.data.kunjungan_foto)
                }
                else
                {
                    $('#EditJenisKunjunganModal .modal-body #tamu_foto').attr("src","https://placehold.co/480x360/0000FF/FFFFFF/?text=belum+ada+photo")
                }
            }
            else
            {
                alert(d.message);
            }
        },
        error: function(){
            alert("error load transaksi");
        }

    });
    $('#EditJenisKunjunganModal .modal-body #kunjungan_jenis_baru').change(function(){
    var kunjungan_jenis = $('#EditJenisKunjunganModal .modal-body #kunjungan_jenis_baru').val();
    if (kunjungan_jenis == 2)
    {
        $('#EditJenisKunjunganModal .modal-body #row_kelompok').show();
    }
    else
    {
        $('#EditJenisKunjunganModal .modal-body #row_kelompok').hide();
    }

    });
});

$('#EditJenisKunjunganModal .modal-footer #simpanJenisKunjungan').on('click', function(e) {
    e.preventDefault();
    var kunjungan_id = $('#EditJenisKunjunganModal .modal-body #edit_id').val();
    var kunjungan_uid = $('#EditJenisKunjunganModal .modal-body #edit_uid').val();
    var kunjungan_jenis = $('#EditJenisKunjunganModal .modal-body #kunjungan_jenis_baru').val();
    var jumlah_orang = $('#EditJenisKunjunganModal .modal-body #jumlah_orang').val();
    var jumlah_pria = $('#EditJenisKunjunganModal .modal-body #jumlah_pria').val();
    var jumlah_wanita = $('#EditJenisKunjunganModal .modal-body #jumlah_wanita').val();
    if (kunjungan_jenis == "")
    {
        $('#EditJenisKunjunganModal .modal-body #kunjungan_jenis_error').text('Pilih salah satu jenis kunjungan');
        return false;
    }
    else if (kunjungan_jenis == 2)
    {
        if (jumlah_orang == "")
        {
            $('#EditJenisKunjunganModal .modal-body #kunjungan_jenis_error').text('karena terpilih kelompok, jumlah pengunjung tidak boleh kosong');
            return false;
        }
        else if (jumlah_orang < 2)
        {
            $('#EditJenisKunjunganModal .modal-body #kunjungan_jenis_error').text('karena terpilih kelompok, jumlah pengunjung minimal 2 orang');
            return false;
        }
        else if (jumlah_pria == "")
        {
            $('#EditJenisKunjunganModal .modal-body #kunjungan_jenis_error').text('karena terpilih kelompok, jumlah pengunjung laki-laki minimal 0');
            return false;
        }
        else if (jumlah_wanita == "")
        {
            $('#EditJenisKunjunganModal .modal-body #kunjungan_jenis_error').text('karena terpilih kelompok, jumlah pengunjung perempuan minimal 0');
            return false;
        }
        else if (jumlah_orang != (parseInt(jumlah_pria)+parseInt(jumlah_wanita)))
        {
            $('#EditJenisKunjunganModal .modal-body #kunjungan_jenis_error').text('Jumlah pengunjung total ('+jumlah_orang+') tidak sama dengan jumlah pengunjung laki-laki ('+jumlah_pria+') + jumlah pengunjung perempuan ('+jumlah_wanita+')');
            return false;
        }
        else
        {
            var isian_clear = true;
        }
    }
    else
    {
        var isian_clear = true;
    }

    if (isian_clear)
    {
        //ajax responsen
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url : '{{route("jeniskunjungan.save")}}',
            method : 'post',
            data: {
                kunjungan_id: kunjungan_id,
                kunjungan_uid: kunjungan_uid,
                kunjungan_jenis : kunjungan_jenis,
                jumlah_orang: jumlah_orang,
                jumlah_pria: jumlah_pria,
                jumlah_wanita: jumlah_wanita
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
//batas jenis
</script>

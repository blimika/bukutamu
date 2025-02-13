<script type="text/javascript">

$('#EditPetugasModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var uid = button.data('uid')
    // For select 2
    $(".select2").select2();
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
            $('#EditPetugasModal .modal-body #edit_flag_antrian').val(d.data.kunjungan_flag_antrian)
            $('#EditPetugasModal .modal-body #edit_uid').val(d.data.kunjungan_uid)
            $('#EditPetugasModal .modal-body #edit_id').val(d.data.kunjungan_id)
            $('#EditPetugasModal .modal-body #kunjungan_id').text('#'+d.data.kunjungan_id)
            $('#EditPetugasModal .modal-body #kunjungan_uid').text(d.data.kunjungan_uid)
            $('#EditPetugasModal .modal-body #pengunjung_nama').text(d.data.pengunjung.pengunjung_nama)
            $('#EditPetugasModal .modal-body #pengunjung_jk').text(d.data.pengunjung.jenis_kelamin.nama)
            $('#EditPetugasModal .modal-body #kunjungan_tanggal').text(d.data.kunjungan_tanggal)
            $('#EditPetugasModal .modal-body #kunjungan_nomor_antrian').text(d.data.kunjungan_teks_antrian)
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
            $('#EditPetugasModal .modal-body #kunjungan_flag_antrian').html('<span class="badge '+warna_flag_antrian+' badge-pill">'+d.data.flag_antrian.nama+'</span>')
            if (d.data.kunjungan_jenis == 1)
            {
                //perorangan
                $('#EditPetugasModal .modal-body #kunjungan_jenis').html('<span class="badge badge-info badge-pill">'+d.data.jenis_kunjungan.nama+'</span>')
            }
            else
            {
                $('#EditPetugasModal .modal-body #kunjungan_jenis').html('<span class="badge badge-primary badge-pill">'+d.data.jenis_kunjungan.nama+' ('+d.data.kunjungan_jumlah_orang+' org)</span> <span class="badge badge-info badge-pill">L'+d.data.kunjungan_jumlah_pria+'</span> <span class="badge badge-danger badge-pill">P'+d.data.kunjungan_jumlah_wanita+'</span>')
            }

            if (d.data.kunjungan_tujuan == 2)
            {
                $('#EditPetugasModal .modal-body #kunjungan_tujuan').html('<span class="badge badge-info badge-pill">'+d.data.tujuan.inisial+'</span> <span class="badge badge-success badge-pill">'+d.data.layanan_utama.nama+'</span>')
            }
            else
            {
                $('#EditPetugasModal .modal-body #kunjungan_tujuan').html('<span class="badge badge-danger badge-pill">'+d.data.tujuan.nama+'</span>')
            }
            $('#EditPetugasModal .modal-body #kunjungan_jam_datang').text(GetJamMenit(d.data.kunjungan_jam_datang))
            $('#EditPetugasModal .modal-body #kunjungan_jam_pulang').text(GetJamMenit(d.data.kunjungan_jam_pulang))
            $('#EditPetugasModal .modal-body #kunjungan_petugas_nama').text(d.data.petugas.name)
            $('#EditPetugasModal .modal-body #kunjungan_keperluan').html(d.data.kunjungan_keperluan)
            $('#EditPetugasModal .modal-body #kunjungan_petugas_baru').val(d.data.kunjungan_petugas_id).trigger('change')
            }
            else
            {
                Swal.fire(
                    'Error',
                    ''+d.message+'',
                    'error'
                );


            }
        },
        error: function(){
            alert("error load transaksi");
        }

    });
});

$('#EditPetugasModal .modal-footer #simpanPetugas').on('click', function(e) {
    e.preventDefault();
    var kunjungan_id = $('#EditPetugasModal .modal-body #edit_id').val();
    var kunjungan_uid = $('#EditPetugasModal .modal-body #edit_uid').val();
    var kunjungan_petugas_baru = $('#EditPetugasModal .modal-body #kunjungan_petugas_baru').val();

    if (kunjungan_petugas_baru == "")
    {
        $('#EditPetugasModal .modal-body #edit_petugas_error').text('pilih salah satu petugas');
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
            url : '{{route("petugas.save")}}',
            method : 'post',
            data: {
                kunjungan_id: kunjungan_id,
                kunjungan_uid: kunjungan_uid,
                petugas_id: kunjungan_petugas_baru
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
</script>

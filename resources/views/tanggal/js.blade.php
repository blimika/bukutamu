<script>
    //cek tahun dulu
    $('#GenerateTanggal .modal-footer #GenData').on('click', function(e) {
        e.preventDefault();
        var gentahun = $('#GenerateTanggal .modal-body #gentahun').val();
        if (gentahun == "") {
            $('#GenerateTanggal .modal-body #gen_error').text('Silakan pilih tahun');
            return false;
        } else {
            $('#pesanerror').hide();
            $('#preloading').toggle();
            $('.tabeltanggal').toggle();
            //ajax update
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ route('master.gentanggal') }}',
                method: 'post',
                data: {
                    gentahun: gentahun,
                },
                cache: false,
                dataType: 'json',
                success: function(data) {
                    if (data.status == true) {
                        $('#preloading').toggle();
                        $('.tabeltanggal').toggle();
                        Swal.fire(
                            'Berhasil!',
                            '' + data.hasil + '',
                            'success'
                        ).then(function() {
                            //sudah sukses
                            $('#pesanerror').toggle();
                            $('#pesanerror #tekserror').text(data.pesan_error);
                            $('#dTabel').DataTable().ajax.reload(null, false);
                        });
                    } else {
                        Swal.fire(
                            'Error!',
                            '' + data.hasil + '',
                            'error'
                        );
                        $('#preloading').toggle();
                        $('.tabeltanggal').toggle();
                        $('#pesanerror').toggle();
                        $('#pesanerror #tekserror').text(data.pesan_error);
                    }

                },
                error: function() {
                    Swal.fire(
                        'Error',
                        'Koneksi Error',
                        'error'
                    );
                }

            });
        }
    });
    //batas cek
    //edit tanggal
    $('#EditTanggal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id')
        var tanggal = button.data('tanggal')
        $.ajax({
            url: '{{ route('cari.tanggal', '') }}/' + id,
            method: 'get',
            cache: false,
            dataType: 'json',
            success: function(data) {
                if (data.status == true) {
                    $('#EditTanggal .modal-body #edit_id').text("#" + id);
                    $('#EditTanggal .modal-body #id_tanggal').val(id);
                    $('#EditTanggal .modal-body #edit_hari').text(data.hasil.hari);
                    $('#EditTanggal .modal-body #edit_tanggal').text(data.hasil.tanggal)
                    $('#EditTanggal .modal-body #edit_jenis').text(data.hasil.jtgl_nama)
                    $('#EditTanggal .modal-body #edit_deskripsi').val(data.hasil.deskripsi)
                    $('#EditTanggal .modal-body #edit_jtanggal').val(data.hasil.jtgl)
                    $('#EditTanggal .modal-body #hari_num').val(data.hasil.hari_num)
                } else {
                    alert(data.hasil);
                }
            },
            error: function() {
                alert("error load transaksi");
            }
        });
    });
    //batas tanggal
    //simpan edit tanggal
    $('#EditTanggal .modal-footer #updatetgl').on('click', function(e) {
        e.preventDefault();
        var id = $('#EditTanggal .modal-body #id_tanggal').val();
        var jtgl = $('#EditTanggal .modal-body #edit_jtanggal').val();
        var hari_num = $('#EditTanggal .modal-body #hari_num').val()
        var deskripsi = $('#EditTanggal .modal-body #edit_deskripsi').val()
        if (jtgl == "") {
            $('#EditTanggal .modal-body #tanggal_error').text('pilih salah satu jenis tanggal');
            return false;
        } else if (jtgl > 2 && deskripsi == "") {
            $('#EditTanggal .modal-body #tanggal_error').text('Deskripsi tidak boleh kosong');
            return false;
        } else if ((hari_num == 0 || hari_num == 6) && jtgl < 2) {
            $('#EditTanggal .modal-body #tanggal_error').text(
                'Hari Sabtu/Minggu tidak bisa jenis tanggal kerja');
            return false;
        } else if ((hari_num > 1 || hari_num < 6) && jtgl == 2) {
            $('#EditTanggal .modal-body #tanggal_error').text(
                'Hari senin-jumat tidak bisa jenis tanggal sabtu/minggu');
            return false;
        } else {
            //ajax ganti passwd
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ route('master.updatetgl') }}',
                method: 'post',
                data: {
                    id: id,
                    jtgl: jtgl,
                    deskripsi: deskripsi,
                    hari_num: hari_num,
                },
                cache: false,
                dataType: 'json',
                success: function(data) {
                    if (data.status == true) {
                        Swal.fire(
                            'Berhasil!',
                            '' + data.hasil + '',
                            'success'
                        ).then(function() {
                            $('#dTabel').DataTable().ajax.reload(null, false);
                        });
                    } else {
                        Swal.fire(
                            'Error!',
                            '' + data.hasil + '',
                            'error'
                        );
                    }

                },
                error: function() {
                    Swal.fire(
                        'Error',
                        'Koneksi Error',
                        'error'
                    );
                }

            });
            //batas ajax
        }
    });
    //batas
    //edit Jadwal Petugas
    $('#EditJadwal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id')
        var tanggal = button.data('tanggal')
        $.ajax({
            url: '{{ route('cari.tanggal', '') }}/' + id,
            method: 'get',
            cache: false,
            dataType: 'json',
            success: function(data) {
                if (data.status == true) {
                    $('#EditJadwal .modal-body #edit_id').text("#" + id);
                    $('#EditJadwal .modal-body #id_jadwal').val(id);
                    $('#EditJadwal .modal-body #edit_hari').text(data.hasil.hari);
                    $('#EditJadwal .modal-body #edit_tanggal').text(data.hasil.tanggal)
                    $('#EditJadwal .modal-body #edit_jenis').text(data.hasil.jtgl_nama)
                    $('#EditJadwal .modal-body #petugas1_id').val(data.hasil.petugas1_id)
                    $('#EditJadwal .modal-body #petugas2_id').val(data.hasil.petugas2_id)
                } else {
                    alert(data.hasil);
                }
            },
            error: function() {
                alert("error load ajax");
            }
        });
    });
    //batas edit petugas
    //simpan edit jadwal
    $('#EditJadwal .modal-footer #updatejadwal').on('click', function(e) {
        e.preventDefault();
        var id = $('#EditJadwal .modal-body #id_jadwal').val();
        var petugas_1 = $('#EditJadwal .modal-body #petugas1_id').val();
        var petugas_2 = $('#EditJadwal .modal-body #petugas2_id').val()

        if (petugas_1 == 0) {
            $('#EditJadwal .modal-body #jadwal_error').text('pilih salah satu petugas 1');
            return false;
        } else if (petugas_2 == 0) {
            $('#EditJadwal .modal-body #jadwal_error').text('pilih salah satu petugas 2');
            return false;
        } else if (petugas_1 == petugas_2) {
            $('#EditJadwal .modal-body #jadwal_error').text('Petugas 1 dan Petugas 2 tidak boleh sama');
            return false;
        } else {
            //ajax edit jadwal
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ route('master.updatejadwal') }}',
                method: 'post',
                data: {
                    id: id,
                    petugas1_id: petugas_1,
                    petugas2_id: petugas_2,
                },
                cache: false,
                dataType: 'json',
                success: function(data) {
                    if (data.status == true) {
                        Swal.fire(
                            'Berhasil!',
                            '' + data.hasil + '',
                            'success'
                        ).then(function() {
                            $('#dTabel').DataTable().ajax.reload(null, false);
                        });
                    } else {
                        Swal.fire(
                            'Error!',
                            '' + data.hasil + '',
                            'error'
                        );
                    }

                },
                error: function() {
                    Swal.fire(
                        'Error',
                        'Koneksi Error',
                        'error'
                    );
                }

            });
            //batas ajax
        }
    });
    //batas simpan jadwal
    //import excel jadwal petugas
    $('#ImportJadwalModal .modal-footer #ImportJadwal').on('click', function(e) {
        e.preventDefault();
        //var file_import_jadwal = $('#ImportJadwalModal .modal-body #file_import_jadwal')[0].files[0];

        var file_import = new FormData();
        file_import.append('file', $('#ImportJadwalModal .modal-body #file_import_jadwal')[0].files[0]);
        //ajax upload file
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{ route('master.importjadwal') }}',
            method: 'post',
            data: file_import,
            cache: false,
            contentType: false,
            success: function(data) {
                if (data.status == true) {
                    Swal.fire(
                        'Berhasil!',
                        '' + data.hasil + '',
                        'success'
                    ).then(function() {
                        $('#dTabel').DataTable().ajax.reload(null, false);
                    });
                } else {
                    Swal.fire(
                        'Error!',
                        '' + data.hasil + '',
                        'error'
                    );
                }

            },
            error: function() {
                Swal.fire(
                    'Error',
                    'Koneksi Error',
                    'error'
                );
            }

        });
        //batas ajax
    });
    //batas
</script>

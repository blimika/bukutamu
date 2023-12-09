<script>
//cek tahun dulu
$('#GenerateTanggal .modal-footer #GenData').on('click', function(e) {
    e.preventDefault();
    var gentahun = $('#GenerateTanggal .modal-body #gentahun').val();
    if (gentahun == "")
    {
        $('#GenerateTanggal .modal-body #gen_error').text('Silakan pilih tahun');
        return false;
    }
    else
    {
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
            url : '{{route("master.gentanggal")}}',
            method : 'post',
            data: {
                gentahun: gentahun,
            },
            cache: false,
            dataType: 'json',
            success: function(data){
                if (data.status == true)
                {
                    $('#preloading').toggle();
                    $('.tabeltanggal').toggle();
                    Swal.fire(
                        'Berhasil!',
                        ''+data.hasil+'',
                        'success'
                    ).then(function() {
                        //sudah sukses
                        $('#pesanerror').toggle();
                        $('#pesanerror #tekserror').text(data.pesan_error);
                        $('#dTabel').DataTable().ajax.reload(null,false);
                    });
                }
                else
                {
                    Swal.fire(
                        'Error!',
                        ''+data.hasil+'',
                        'error'
                    );
                    $('#preloading').toggle();
                    $('.tabeltanggal').toggle();
                    $('#pesanerror').toggle();
                    $('#pesanerror #tekserror').text(data.pesan_error);
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
    }
});
//batas cek
//edit tanggal
$('#EditTanggal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('id')
    var tanggal = button.data('tanggal')
    $.ajax({
        url : '{{route("cari.tanggal","")}}/'+id,
        method : 'get',
        cache: false,
        dataType: 'json',
        success: function(data){
            if (data.status == true)
            {
                $('#EditTanggal .modal-body #edit_id').text("#"+id);
                $('#EditTanggal .modal-body #id_tanggal').val(id);
                $('#EditTanggal .modal-body #edit_hari').text(data.hasil.hari);
                $('#EditTanggal .modal-body #edit_tanggal').text(data.hasil.tanggal)
                $('#EditTanggal .modal-body #edit_jenis').text(data.hasil.jtgl_nama)
                $('#EditTanggal .modal-body #edit_deskripsi').val(data.hasil.deskripsi)
                $('#EditTanggal .modal-body #edit_jtanggal').val(data.hasil.jtgl)
                $('#EditTanggal .modal-body #hari_num').val(data.hasil.hari_num)
            }
            else
            {
                alert(data.hasil);
            }
        },
        error: function(){
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
        if (jtgl == "")
        {
            $('#EditTanggal .modal-body #tanggal_error').text('pilih salah satu jenis tanggal');
            return false;
        }
        else if (jtgl > 2 && deskripsi == "")
        {
            $('#EditTanggal .modal-body #tanggal_error').text('Deskripsi tidak boleh kosong');
            return false;
        }
        else if ((hari_num == 0 || hari_num == 6) && jtgl < 2)
        {
            $('#EditTanggal .modal-body #tanggal_error').text('Hari Sabtu/Minggu tidak bisa jenis tanggal kerja');
            return false;
        }
        else if ((hari_num > 1 || hari_num < 6) && jtgl == 2)
        {
            $('#EditTanggal .modal-body #tanggal_error').text('Hari senin-jumat tidak bisa jenis tanggal sabtu/minggu');
            return false;
        }
        else
        {
            //ajax ganti passwd
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url : '{{route('master.updatetgl')}}',
                method : 'post',
                data: {
                    id: id,
                    jtgl: jtgl,
                    deskripsi: deskripsi,
                    hari_num: hari_num,
                },
                cache: false,
                dataType: 'json',
                success: function(data){
                    if (data.status == true)
                    {
                        Swal.fire(
                            'Berhasil!',
                            ''+data.hasil+'',
                            'success'
                        ).then(function() {
                            $('#dTabel').DataTable().ajax.reload(null,false);
                        });
                    }
                    else
                    {
                        Swal.fire(
                            'Error!',
                            ''+data.hasil+'',
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
            //batas ajax
    }
});
    //batas
</script>

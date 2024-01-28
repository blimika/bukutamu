<script>
//Sinkronisasi
$('#syncLayananUtama .modal-footer #sinkron_antrian').on('click', function(e) {
    e.preventDefault();
    var tahun_kunjungan = $('#syncLayananUtama .modal-body #tahun_kunjungan').val();
    if (tahun_kunjungan == "")
    {
        $('#syncLayananUtama .modal-body #tahun_error').text('Silakan pilih tahun');
        return false;
    }
    else
    {
        $('#pesanerror').hide();
        $('#preloading').toggle();
        $('.tabeldata').toggle();
        //ajax update
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $.ajax({
            url : '{{route("tamu.synclayananutama")}}',
            method : 'post',
            data: {
                tahun_kunjungan: tahun_kunjungan,
            },
            cache: false,
            dataType: 'json',
            success: function(data){
                if (data.status == true)
                {
                    $('#preloading').toggle();
                    $('.tabeldata').toggle();
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
                    $('.tabeldata').toggle();
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

</script>

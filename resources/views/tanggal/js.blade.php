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
</script>

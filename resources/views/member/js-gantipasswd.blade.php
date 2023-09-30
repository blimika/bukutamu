<script>
$('#GantiPasswdModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var gp_id = button.data('id')
    var gp_username = button.data('username')
    var gp_nama = button.data('nama')
    $('#GantiPasswdModal .modal-body #gp_nama').text(gp_nama);
    $('#GantiPasswdModal .modal-body #gp_username').text(gp_username);
    $('#GantiPasswdModal .modal-body #gp_id').val(gp_id);
    $('#GantiPasswdModal .modal-body #gp_id_teks').text('#'+gp_id);
});

$('#GantiPasswdModal .modal-footer #GantiPasswdMember').on('click', function(e) {
    e.preventDefault();
    var gp_passwd = $('#GantiPasswdModal .modal-body #gp_passwd').val();
    var gp_ulangi_passwd = $('#GantiPasswdModal .modal-body #gp_ulangi_passwd').val();
    var gp_id = $('#GantiPasswdModal .modal-body #gp_id').val();
    if (gp_passwd == "")
    {
        $('#GantiPasswdModal .modal-body #gantipasswd_error').text('Password Baru tidak boleh kosong');
        return false;
    }
    else if (gp_ulangi_passwd == "")
    {
        $('#GantiPasswdModal .modal-body #gantipasswd_error').text('Ulangi Password Baru tidak boleh kosong');
        return false;
    }
    else if (gp_passwd != gp_ulangi_passwd)
    {
        $('#GantiPasswdModal .modal-body #gantipasswd_error').text('Password baru dengan Ulangi Password Baru tidak sama');
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
            url : '{{route('member.admgantipasswd')}}',
            method : 'post',
            data: {
                id: gp_id,
                passwd_baru: gp_passwd,
                ulangi_passwd_baru: gp_ulangi_passwd,
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
</script>
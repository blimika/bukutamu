<script>
    $('#EditMemberModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('id')

    $.ajax({
        url : '{{route("member.cari","")}}/'+id,
        method : 'get',
        cache: false,
        dataType: 'json',
        success: function(data){
            if (data.status == true)
            {
                $('#EditMemberModal .modal-body #edit_member_id').val(id);
                $('#EditMemberModal .modal-body #edit_level').val(data.hasil.level);
                $('#EditMemberModal .modal-body #edit_name').val(data.hasil.name)
                $('#EditMemberModal .modal-body #edit_username').val(data.hasil.username)
                $('#EditMemberModal .modal-body #edit_email').val(data.hasil.email)
                $('#EditMemberModal .modal-body #edit_telepon').val(data.hasil.telepon)
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
    //simpan edit member
    $('#EditMemberModal .modal-footer #UpdateMemberData').on('click', function(e) {
        e.preventDefault();
        var id = $('#EditMemberModal .modal-body #edit_member_id').val();
        var level = $('#EditMemberModal .modal-body #edit_level').val();
        var name = $('#EditMemberModal .modal-body #edit_name').val()
        var username = $('#EditMemberModal .modal-body #edit_username').val()
        var email = $('#EditMemberModal .modal-body #edit_email').val()
        var telepon = $('#EditMemberModal .modal-body #edit_telepon').val()
        if (level == "")
        {
            $('#EditMemberModal .modal-body #edit_member_error').text('Pilih salah satu level member');
            return false;
        }
        else if (name == "")
        {
            $('#EditMemberModal .modal-body #edit_member_error').text('Nama lengkap tidak boleh kosong');
            return false;
        }
        else if (username == "")
        {
            $('#EditMemberModal .modal-body #edit_member_error').text('Username tidak boleh kosong');
            return false;
        }
        else if (email == "")
        {
            $('#EditMemberModal .modal-body #edit_member_error').text('E-mail tidak boleh kosong');
            $('#EditMemberModal .modal-body #edit_email').focus();
            return false;
        }
        else if (telepon == "")
        {
            $('#EditMemberModal .modal-body #edit_member_error').text('Telepon tidak boleh kosong');
            return false;
        }
        else
        {
            if (email != "")
            {
                var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                if(!email.match(mailformat))
                {
                    $('#EditMemberModal .modal-body #edit_member_error').text('Format e-mail tidak sesuai');
                    $('#EditMemberModal .modal-body #edit_email').focus();
                    return false;
                }
            }
            //ajax ganti passwd
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url : '{{route('member.updatedata')}}',
                method : 'post',
                data: {
                    id: id,
                    level: level,
                    name: name,
                    username: username,
                    email: email,
                    telepon: telepon,
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

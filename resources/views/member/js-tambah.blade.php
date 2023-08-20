<script>
    $('#TambahMember').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal

        //kosongan isian
        $('#TambahMember .modal-footer #ResetFormMember').on('click', function(e) {
            e.preventDefault();
            $('#TambahMember .modal-body #level').val("");
            $('#TambahMember .modal-body #name').val("");
            $('#TambahMember .modal-body #username').val("");
            $('#TambahMember .modal-body #email').val("");
            $('#TambahMember .modal-body #telepon').val("");
            $('#TambahMember .modal-body #passwd').val("");
            $('#TambahMember .modal-body #passwd_ulangi').val("");
            $('#TambahMember .modal-body #member_error').text("");
        });

    });
    $('#TambahMember .modal-footer #SimpanMember').on('click', function(e) {
    e.preventDefault();
    var level = $('#TambahMember .modal-body #level').val();
    var name = $('#TambahMember .modal-body #name').val();
    var username = $('#TambahMember .modal-body #username').val();
    var email = $('#TambahMember .modal-body #email').val();
    var telepon = $('#TambahMember .modal-body #telepon').val();
    var passwd = $('#TambahMember .modal-body #passwd').val();
    var passwd_ulangi = $('#TambahMember .modal-body #passwd_ulangi').val();
    if (level == "")
    {
        $('#TambahMember .modal-body #member_error').text('Pilih level user');
        return false;
    }
    else if (name == "")
    {
        $('#TambahMember .modal-body #member_error').text('Nama harus terisi');
        return false;
    }
    else if (username == "")
    {
        $('#TambahMember .modal-body #member_error').text('Username harus terisi');
        return false;
    }
    else if (email == "")
    {
        $('#TambahMember .modal-body #member_error').text('Email harus terisi');
        return false;
    }
    else if (telepon == "")
    {
        $('#TambahMember .modal-body #member_error').text('Telepon/WA harus terisi');
        return false;
    }
    else if (passwd == "")
    {
        $('#TambahMember .modal-body #member_error').text('Password harus terisi');
        return false;
    }
    else if (passwd_ulangi == "")
    {
        $('#TambahMember .modal-body #member_error').text('Ulangi password harus terisi');
        return false;
    }
    else if (passwd != passwd_ulangi)
    {
        $('#TambahMember .modal-body #member_error').text('Password dan ulangi password tidak sama');
        return false;
    }
    else
    {
        if (email != "")
        {
            var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            if(!email.match(mailformat))
            {
                $('#TambahMember .modal-body #member_error').text('Format email tidak sesuai');
                return false;
            }
        }

        //check username, email, nomor hp dulu sudah ada belum

        //$('#TambahMember .modal-body #formEditMasterPengunjung').submit();
        //ajax responsen
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url : '{{route('member.simpan')}}',
            method : 'post',
            data: {
                level: level,
                name: name,
                username: username,
                email: email,
                telepon: telepon,
                passwd: passwd,
                passwd_ulangi: passwd_ulangi,
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
        //batas
    }

});
</script>

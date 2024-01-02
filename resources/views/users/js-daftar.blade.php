<script>
$('#daftar').on('click', function(e) {
    e.preventDefault();
    var nama_lengkap = $('#nama_lengkap').val();
    var username = $('#username').val();
    var email = $('#email').val();
    var telepon = $('#telepon').val();
    var passwd = $('#passwd').val();
    var ulangi_passwd = $('#ulangi_passwd').val();
    if (nama_lengkap == "")
    {
        $('#member_error').text('Nama harus terisi');
        $('#nama_lengkap').focus();
        return false;
    }
    else if (username == "")
    {
        $('#member_error').text('Username harus terisi');
        $('#username').focus();
        return false;
    }
    else if (telepon == "")
    {
        $('#member_error').text('Telepon/WA harus terisi');
        $('#telepon').focus();
        return false;
    }
    else if (telepon.match(/[^\d+]/))
    {
        $('#member_error').text('Telepon/WA hanya berisi angka saja');
        $('#telepon').focus();
        return false;
    }
    else if (email == "")
    {
        $('#member_error').text('Email harus terisi');
        $('#email').focus();
        return false;
    }
    else if (passwd == "")
    {
        $('#member_error').text('Password harus terisi');
        $('#passwd').focus();
        return false;
    }
    else if (ulangi_passwd == "")
    {
        $('#member_error').text('Ulangi password harus terisi');
        $('#ulangi_passwd').focus();
        return false;
    }
    else if (passwd != ulangi_passwd)
    {
        $('#member_error').text('Password dan ulangi password tidak sama');
        $('#ulangi_passwd').focus();
        return false;
    }
    else
    {
        if (email != "")
        {
            var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            if(!email.match(mailformat))
            {
                $('#member_error').text('Format email tidak sesuai');
                $('#email').focus();
                return false;
            }
        }

        //check username, email, nomor hp dulu sudah ada belum

        //$('#TambahMember .modal-body #formEditMasterPengunjung').submit();
        //ajax responsen
        //sembunyikan 
        $('#preloading').toggle();
        $('#BoxDaftarMember').toggle();
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url : '{{route('member.daftar')}}',
            method : 'post',
            data: {
                name: nama_lengkap,
                username: username,
                email: email,
                telepon: telepon,
                passwd: passwd,
                passwd_ulangi: ulangi_passwd,
            },
            cache: false,
            dataType: 'json',
            success: function(data){
                $('#preloading').toggle();
                if (data.status == true)
                {
                    Swal.fire(
                        'Berhasil!',
                        ''+data.hasil+'',
                        'success'
                    ).then(function() {
                        //location.reload();
                        $('#pesanerror').toggle();
                        $('#pesanerror #tekserror').text(data.hasil);
                    });
                }
                else
                {
                    $('#BoxDaftarMember').toggle();
                    Swal.fire(
                        'Error!',
                        ''+data.hasil+'',
                        'error'
                    );
                    $('#pesanerror').toggle();
                    $('#pesanerror #tekserror').text(data.hasil);
                }

            },
            error: function(){
                $('#preloading').toggle();
                $('#BoxDaftarMember').toggle();
                Swal.fire(
                    'Error',
                    'Koneksi Error',
                    'error'
                );
                $('#pesanerror').toggle();
                $('#pesanerror #tekserror').text(data.hasil);
            }

        });
        //batas
    }

});
</script>

<script>
    $('#ResetPasswd').on('click', function(e) {
    e.preventDefault();
    var lupa_email = $('#lupa_email').val();
    if (lupa_email == "")
    {
        $('#lupa_error').text('Email harus terisi');
        $('#lupa_email').focus();
        return false;
    }
    else
    {
        if (lupa_email != "")
        {
            var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            if(!lupa_email.match(mailformat))
            {
                $('#lupa_error').text('Format email tidak sesuai');
                $('#lupa_email').focus();
                return false;
            }
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url : '{{route('member.lupapasswd')}}',
            method : 'post',
            data: {
                email: lupa_email,
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
                        location.reload();
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

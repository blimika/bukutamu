<script>
$('#GantiPasswdTombol').on('click', function(e) {
    e.preventDefault();
    $('#GantiPassword').toggle();
    $('#EditProfil').hide();
});
$('#EditProfilTombol').on('click', function(e) {
    e.preventDefault();
    $('#EditProfil').toggle();
    $('#GantiPassword').hide();
});
$('#UpdateProfil').on('click', function(e) {
    e.preventDefault();
    var name = $('#name').val();
    var username = $('#username').val();
    var email = $('#email').val();
    var telepon = $('#telepon').val();
    if (name == "")
    {
        $('#formEditProfil #member_error').text('Nama harus terisi');
        return false;
    }
    else if (username == "")
    {
        $('#formEditProfil #member_error').text('Username harus terisi');
        return false;
    }
    else if (email == "")
    {
        $('#formEditProfil #member_error').text('Email harus terisi');
        return false;
    }
    else if (telepon == "")
    {
        $('#formEditProfil #member_error').text('Telepon/WA harus terisi');
        return false;
    }
    else
    {
        if (email != "")
        {
            var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            if(!email.match(mailformat))
            {
                $('#formEditProfil #member_error').text('Format email tidak sesuai');
                return false;
            }
            //ajax update
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url : '{{route('member.updateprofil')}}',
                method : 'post',
                data: {
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
                            //sudah sukses
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
            //batas update
        }
    }
});
//kodeqr button click
$('#KaitkanModal .modal-body #cek_kodeqr').on('click', function(e) {
    e.preventDefault();
    var kodeqr = $('#KaitkanModal .modal-body #kodeqr').val();
    var user_id = $('#KaitkanModal .modal-body #user_id').val();
    if (kodeqr == "")
    {
        $('#KaitkanModal .modal-body #kaitkan_error').text('Kode QR harus terisi');
        $('#KaitkanModal .modal-footer #KaitkanPengunjung').prop('disabled', true);
        return false;
    }
    else
    {
        //load ajax get
        $.ajax({
        url : '{{route("pengunjung.cari","")}}/'+kodeqr,
        method : 'get',
        cache: false,
        dataType: 'json',
        success: function(data){
            if (data.status == true)
            {
                //cek dulu apakah sudah dikaitkan?
                if (data.hasil.member.status == true)
                {
                    $('#KaitkanModal .modal-body #kaitkan_error').text('Kode QR sudah dikaitkan dengan member lain, nama '+data.hasil.member.hasil.name);
                    $('#KaitkanModal .modal-body #kaitkan_error').addClass('text-danger').removeClass('text-success');
                    $('#KaitkanModal .modal-footer #KaitkanPengunjung').prop('disabled', true);
                    return false;
                }
                else
                {
                    $('#KaitkanModal .modal-body #kaitkan_error').text('Kode QR ditemukan, nama '+data.hasil.nama_lengkap);
                    $('#KaitkanModal .modal-body #kaitkan_error').addClass('text-success').removeClass('text-danger');
                    $('#KaitkanModal .modal-footer #KaitkanPengunjung').prop('disabled', false);
                    return false;
                }

            }
            else
            {
                $('#KaitkanModal .modal-body #kaitkan_error').text('Kode QR ('+kodeqr+') tidak ditemukan');
                $('#KaitkanModal .modal-body #kaitkan_error').addClass('text-danger').removeClass('text-success');
                $('#KaitkanModal .modal-footer #KaitkanPengunjung').prop('disabled', true);
                return false;
            }
        },
        error: function(){
            alert("error load modal");
        }

        });
        //batas load ajax
    }
});
//batas
//jenis_identitas button click
$('#KaitkanModal .modal-body #cek_identitas').on('click', function(e) {
    e.preventDefault();
    var jenis = $("#KaitkanModal .modal-body #jenis_identitas").val();
    var nomor = $('#KaitkanModal .modal-body #nomor_identitas').val();
    var user_id = $('#KaitkanModal .modal-body #user_id').val();
    if (jenis == "")
    {
        $('#KaitkanModal .modal-body #kaitkan_error').text('Pilih Salah Satu Jenis Identitas');
        $('#KaitkanModal .modal-body #kaitkan_error').addClass('text-danger').removeClass('text-success');
        $('#KaitkanModal .modal-footer #KaitkanPengunjung').prop('disabled', true);
        return false;
    }
    else if (nomor == "")
    {
        $('#KaitkanModal .modal-body #kaitkan_error').text('Nomor identitas tidak boleh kosong');
        $('#KaitkanModal .modal-body #kaitkan_error').addClass('text-danger').removeClass('text-success');
        $('#KaitkanModal .modal-footer #KaitkanPengunjung').prop('disabled', true);
        return false;
    }
    else
    {
        //load ajax get
        $.ajax({
    url : '{{route('cekid',['',''])}}/'+jenis+'/'+nomor,
    method : 'get',
    cache: false,
    dataType: 'json',
    success: function(data){

        if (data.status == true) {
            //identitas true
            //cek dulu apakah sudah dikaitkan?
            if (data.hasil.member.status == true)
            {
                $('#KaitkanModal .modal-body #kaitkan_error').text('Identitas sudah dikaitkan dengan member lain, nama '+data.hasil.member.hasil.name);
                $('#KaitkanModal .modal-body #kaitkan_error').addClass('text-danger').removeClass('text-success');
                $('#KaitkanModal .modal-footer #KaitkanPengunjung').prop('disabled', true);
                return false;
            }
            else
            {
                $('#KaitkanModal .modal-body #kaitkan_error').text('Identitas berhasil ditemukan, nama '+data.hasil.nama_lengkap);
                $('#KaitkanModal .modal-body #kodeqr').val(data.hasil.kode_qr)
                $('#KaitkanModal .modal-body #kaitkan_error').addClass('text-success').removeClass('text-danger');
                $('#KaitkanModal .modal-footer #KaitkanPengunjung').prop('disabled', false);
                return false;
            }

        }
        else {
            $('#KaitkanModal .modal-body #kaitkan_error').text('Identitas tidak ditemukan, silakan perbaiki isian');
            $('#KaitkanModal .modal-body #kaitkan_error').addClass('text-danger').removeClass('text-success');
            $('#KaitkanModal .modal-footer #KaitkanPengunjung').prop('disabled', true);
            return false;

        }
    },
    error: function(){
        alert("error");
    }

    });

        //batas load ajax
    }
});
//batas
$('#KaitkanModal .modal-footer #KaitkanPengunjung').on('click', function(e) {
    e.preventDefault();
    var kodeqr = $('#KaitkanModal .modal-body #kodeqr').val();
    var user_id = $('#KaitkanModal .modal-body #user_id').val();
    var check_gantiphoto = $('#KaitkanModal .modal-body #gantiphoto').is(':checked');
    if (check_gantiphoto == true)
    {
        var gantiphoto = 1;
    }
    else
    {
        var gantiphoto = 0;
    }
    if (kodeqr == "")
    {
        $('#KaitkanModal .modal-body #kaitkan_error').text('Kode QR harus terisi');
        $('#KaitkanModal .modal-footer #KaitkanPengunjung').prop('disabled', true);
        return false;
    }
    else
    {
        //ajax update
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $.ajax({
            url : '{{route("member.kaitkan")}}',
            method : 'post',
            data: {
                user_id: user_id,
                kodeqr: kodeqr,
                gantiphoto: gantiphoto
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
                        //sudah sukses
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
    }
});
//verifikasi email
$(".mailverifikasi").click(function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var nama = $(this).data('nama');
    Swal.fire({
                title: 'Email verifikasi?',
                text: "Kirim email verifikasi?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Kirim'
            }).then((result) => {
                if (result.value) {
                    //response ajax disini
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url : '{{route('member.mailverifikasi')}}',
                        method : 'post',
                        data: {
                            id: id,
                            nama: nama,
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

                }
            })

});
//batas verifikasi
//putuskan koneksi ke tamu
$(".putuskan").click(function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var nama = $(this).data('nama');
    var kodeqr = $(this).data('kodeqr');
    Swal.fire({
                title: 'Putuskan koneksi?',
                text: "Data pengunjung "+nama+" akan putuskan kaitan",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Putuskan'
            }).then((result) => {
                if (result.value) {
                    //response ajax disini
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url : '{{route('member.putuskan')}}',
                        method : 'post',
                        data: {
                            id: id,
                            nama: nama,
                            kodeqr: kodeqr
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

                }
            })
});
//batas koneksi
//ganti passwd profil
$('#UpdatePasswd').on('click', function(e) {
    e.preventDefault();
    var passwd_lama = $('#edit_passwd_lama').val();
    var passwd_baru = $('#edit_passwd_baru').val();
    var ulangi_passwd_baru = $('#edit_ulangi_passwdbaru').val();
    if (passwd_lama == "")
    {
        $('#formGantiPasswd #gantipasswd_error').text('Password lama harus terisi');
        return false;
    }
    else if (passwd_baru == "")
    {
        $('#formGantiPasswd #gantipasswd_error').text('Password baru harus terisi');
        return false;
    }
    else if (ulangi_passwd_baru == "")
    {
        $('#formGantiPasswd #gantipasswd_error').text('Ulangi Password baru harus terisi');
        return false;
    }
    else if (passwd_baru != ulangi_passwd_baru)
    {
        $('#formGantiPasswd #gantipasswd_error').text('Password baru dengan Ulangi Password baru tidak sama');
        return false;
    }
    else
    {
       //ajax
        //ajax update
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url : '{{route('member.gantipasswd')}}',
            method : 'post',
            data: {
                passwd_lama: passwd_lama,
                passwd_baru: passwd_baru,
                ulangi_passwd_baru: ulangi_passwd_baru,
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
                        location.replace('{{route('logout')}}');
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
///batas
</script>

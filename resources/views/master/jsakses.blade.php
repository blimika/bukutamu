<script>
function checkIfValidIP(str) {
  // Regular expression to check if string is a IP address
  //const regexExp = /^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/gi;
  const regexExp = /(?:^(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)(?:\.(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)){3}$)|(?:^(?:(?:[a-fA-F\d]{1,4}:){7}(?:[a-fA-F\d]{1,4}|:)|(?:[a-fA-F\d]{1,4}:){6}(?:(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)(?:\\.(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)){3}|:[a-fA-F\d]{1,4}|:)|(?:[a-fA-F\d]{1,4}:){5}(?::(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)(?:\\.(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)){3}|(?::[a-fA-F\d]{1,4}){1,2}|:)|(?:[a-fA-F\d]{1,4}:){4}(?:(?::[a-fA-F\d]{1,4}){0,1}:(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)(?:\\.(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)){3}|(?::[a-fA-F\d]{1,4}){1,3}|:)|(?:[a-fA-F\d]{1,4}:){3}(?:(?::[a-fA-F\d]{1,4}){0,2}:(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)(?:\\.(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)){3}|(?::[a-fA-F\d]{1,4}){1,4}|:)|(?:[a-fA-F\d]{1,4}:){2}(?:(?::[a-fA-F\d]{1,4}){0,3}:(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)(?:\\.(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)){3}|(?::[a-fA-F\d]{1,4}){1,5}|:)|(?:[a-fA-F\d]{1,4}:){1}(?:(?::[a-fA-F\d]{1,4}){0,4}:(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)(?:\\.(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)){3}|(?::[a-fA-F\d]{1,4}){1,6}|:)|(?::(?:(?::[a-fA-F\d]{1,4}){0,5}:(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)(?:\\.(?:25[0-5]|2[0-4]\d|1\d\d|[1-9]\d|\d)){3}|(?::[a-fA-F\d]{1,4}){1,7}|:)))(?:%[0-9a-zA-Z]{1,})?$)/gm;

  return regexExp.test(str);
}
    $('#simpanakses').on('click', function(e) {
        e.preventDefault();
        var ipakses = $('#ipaddress').val();
        if (ipakses == "")
            {
                Swal.fire({
                    type: 'error',
                    title: 'error',
                    text: 'IP Address harus terisi'
                    });
                return false;
            }
        else if (checkIfValidIP(ipakses) == false)
        {
            {
                Swal.fire({
                    type: 'error',
                    title: 'error',
                    text: 'format penulisan IP Address tidak valid'
                    });
                return false;
            }
        }
        else
        {
            //valid format
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //ajax simpan ip address
            $.ajax({
            url : '{{route('layanan.simpanakses')}}',
            method : 'post',
            data: {
                ipaddress: ipakses,
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

//edit modal view
$('#EditAksesModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('id')
    var ip = button.data('ip')
    $('#EditAksesModal .modal-body #id_teks').text(id);
    $('#EditAksesModal .modal-body #id').val(id);
    $('#EditAksesModal .modal-body #ipaddress').val(ip);
});
//batas
//cek sblm submit
$('#EditAksesModal .modal-footer #updateDataAkses').on('click', function(e) {
    e.preventDefault();
    var id = $('#EditAksesModal .modal-body #id').val();
    var ipaddress = $('#EditAksesModal .modal-body #ipaddress').val();
    if (ipaddress == "")
    {
        $('#EditAksesModal .modal-body #edit_akses_error').text('IP Address tidak boleh kosong');
        return false;
    }
    else
    {
        if (checkIfValidIP(ipaddress) == false)
        {
            $('#EditAksesModal .modal-body #edit_akses_error').text('Format IP Address tidak valid');
            return false;
        }
        else
        {
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                url : '{{route('layanan.updateakses')}}',
                method : 'post',
                data: {
                    id: id,
                    ipaddress: ipaddress,
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
        }
    }
});
//batas
</script>

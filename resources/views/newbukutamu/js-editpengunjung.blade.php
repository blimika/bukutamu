<script type="text/javascript">
function GetUmur(birthDateString) {
    var today = new Date();
    var age = today.getFullYear() - birthDateString;
    return age;
}
$('#EditPengunjungModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var uid = button.data('uid')
    //load dulu transaksinya
    $.ajax({
        url : '{{route("webapi")}}/',
        method : 'get',
        data: {
            model: 'pengunjung',
            uid: uid
        },
        cache: false,
        dataType: 'json',
        success: function(d){
            if (d.status == true)
            {
                //value
            $('#EditPengunjungModal .modal-body #pengunjung_id').val(d.data.pengunjung_id)
            $('#EditPengunjungModal .modal-body #pengunjung_uid').val(d.data.pengunjung_uid)
            $('#EditPengunjungModal .modal-body #teks_pengunjung_id').text('#'+d.data.pengunjung_id)
            $('#EditPengunjungModal .modal-body #teks_pengunjung_uid').text(d.data.pengunjung_uid)
            $('#EditPengunjungModal .modal-body #pengunjung_nomor_hp').val(d.data.pengunjung_nomor_hp)
            $('#EditPengunjungModal .modal-body #pengunjung_nama').val(d.data.pengunjung_nama)
            $('#EditPengunjungModal .modal-body #pengunjung_jk').val(d.data.pengunjung_jk)
            $('#EditPengunjungModal .modal-body #pengunjung_tahun_lahir').val(d.data.pengunjung_tahun_lahir)
            $('#EditPengunjungModal .modal-body #pengunjung_pekerjaan').val(d.data.pengunjung_pekerjaan)
            $('#EditPengunjungModal .modal-body #pengunjung_pendidikan').val(d.data.pengunjung_pendidikan)
            $('#EditPengunjungModal .modal-footer #pengunjung_timeline').attr("href","{{route('timeline','')}}/"+d.data.pengunjung_uid)
            $('#EditPengunjungModal .modal-body #pengunjung_email').val(d.data.pengunjung_email)

            $('#EditPengunjungModal .modal-body #pengunjung_alamat').val(d.data.pengunjung_alamat)
            }
            else
            {
                Swal.fire(
                    'Error!',
                    '' + data.message + '',
                    'error'
                );
            }
        },
        error: function(){
            Swal.fire(
                    'Error!',
                    'koneksi error',
                    'error'
                );
        }

    });
});

$('#EditPengunjungModal .modal-footer #updatePengunjung').on('click', function(e) {
    e.preventDefault();
    var pengunjung_id = $('#EditPengunjungModal .modal-body #pengunjung_id').val();
    var pengunjung_uid = $('#EditPengunjungModal .modal-body #pengunjung_uid').val();
    var pengunjung_nomor_hp = $('#EditPengunjungModal .modal-body #pengunjung_nomor_hp').val();
    var pengunjung_nama = $('#EditPengunjungModal .modal-body #pengunjung_nama').val();
    var pengunjung_jk = $('#EditPengunjungModal .modal-body #pengunjung_jk').val();
    var pengunjung_tahun_lahir = $('#EditPengunjungModal .modal-body #pengunjung_tahun_lahir').val();
    var pengunjung_pekerjaan = $('#EditPengunjungModal .modal-body #pengunjung_pekerjaan').val();
    var pengunjung_pendidikan = $('#EditPengunjungModal .modal-body #pengunjung_pendidikan').val();
    var pengunjung_email = $('#EditPengunjungModal .modal-body #pengunjung_email').val();
    var pengunjung_alamat = $('#EditPengunjungModal .modal-body #pengunjung_alamat').val();

    if (pengunjung_nomor_hp == "")
    {
        $('#EditPengunjungModal .modal-body #edit_pengunjung_error').text('Nomor HP tidak boleh kosong');
        return false;
    }
    else if (pengunjung_nomor_hp.match(/[^\d+]/))
    {
        $('#EditPengunjungModal .modal-body #edit_pengunjung_error').text('Silakan masukkan nomor handphone hanya angka');
        return false;
    }
    else if (pengunjung_nama == "")
    {
        $('#EditPengunjungModal .modal-body #edit_pengunjung_error').text('isian nama tidak boleh kosong');
        return false;
    }
    else if (pengunjung_jk == "")
    {
        $('#EditPengunjungModal .modal-body #edit_pengunjung_error').text('Pilih salah satu Jenis Kelamin');
        return false;
    }
    else if (pengunjung_tahun_lahir == "")
    {
        $('#EditPengunjungModal .modal-body #edit_pengunjung_error').text('tahun lahir tidak boleh kosong');
        return false;
    }
    else if (GetUmur(pengunjung_tahun_lahir) <= 13)
    {
        $('#EditPengunjungModal .modal-body #edit_pengunjung_error').text('umur minimal 14 tahun');
        return false;
    }
    else if (pengunjung_pekerjaan == "")
    {
        $('#EditPengunjungModal .modal-body #edit_pengunjung_error').text('isian pekerjaan tidak boleh kosong');
        return false;
    }
    else if (pengunjung_pendidikan == "")
    {
        $('#EditPengunjungModal .modal-body #edit_pengunjung_error').text('pilih salah satu pendidikan');
        return false;
    }
    else if (pengunjung_email == "")
    {
        $('#EditPengunjungModal .modal-body #edit_pengunjung_error').text('isian email harus terisi');
        return false;
    }
    else if (pengunjung_alamat == "")
    {
        $('#EditPengunjungModal .modal-body #edit_pengunjung_error').text('isian alamat harus terisi');
        return false;
    }
    else
    {
        var isian_clear = true;
    }

    if (isian_clear)
    {
        //ajax responsen
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url : '{{route("pengunjung.save")}}',
            method : 'post',
            data: {
                pengunjung_id: pengunjung_id,
                pengunjung_uid: pengunjung_uid,
                pengunjung_nomor_hp : pengunjung_nomor_hp,
                pengunjung_nama: pengunjung_nama,
                pengunjung_jk: pengunjung_jk,
                pengunjung_tahun_lahir: pengunjung_tahun_lahir,
                pengunjung_pekerjaan: pengunjung_pekerjaan,
                pengunjung_pendidikan: pengunjung_pendidikan,
                pengunjung_email: pengunjung_email,
                pengunjung_alamat: pengunjung_alamat
            },
            cache: false,
            dataType: 'json',
            success: function(data){
                if (data.status == true)
                {
                    Swal.fire(
                        'Berhasil!',
                        ''+data.message+'',
                        'success'
                    ).then(function() {
                        $('#dTabel').DataTable().ajax.reload(null,false);
                    });
                }
                else
                {
                    Swal.fire(
                        'Error!',
                        ''+data.message+'',
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

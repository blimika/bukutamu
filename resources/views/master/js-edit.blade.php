<script>
function cekUmur(birthDateString) {
    var today = new Date();
    var birthDate = new Date(birthDateString);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
}
$('#EditMasterModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var tamuid = button.data('id')
    //load dulu transaksinya
    $.ajax({
        url : '{{route("pengunjung.cari","")}}/'+tamuid,
        method : 'get',
        cache: false,
        dataType: 'json',
        success: function(data){
            if (data.status == true)
            {
                $('#EditMasterModal .modal-body #tamu_id_teks').text(tamuid);
                $('#EditMasterModal .modal-body #tamu_id').val(tamuid);
                $('#EditMasterModal .modal-footer #tamu_timeline').attr("href","{{route('tamu.detil','')}}/"+tamuid);
                $('#EditMasterModal .modal-body #jenis_identitas').val(data.hasil.id_identitas)
                $('#EditMasterModal .modal-body #nomor_identitas').val(data.hasil.nomor_identitas)
                $('#EditMasterModal .modal-body #nama_lengkap').val(data.hasil.nama_lengkap)
                $('#EditMasterModal .modal-body #tgl_lahir').val(data.hasil.tgl_lahir)
                $('#EditMasterModal .modal-body #id_jk').val(data.hasil.id_jk)
                $('#EditMasterModal .modal-body #email').val(data.hasil.email)
                $('#EditMasterModal .modal-body #telepon').val(data.hasil.telepon)
                $('#EditMasterModal .modal-body #mwarga').val(data.hasil.id_mwarga)
                $('#EditMasterModal .modal-body #alamat').val(data.hasil.alamat)
                $('#EditMasterModal .modal-body #id_mdidik').val(data.hasil.id_mdidik)
                $('#EditMasterModal .modal-body #id_kerja').val(data.hasil.id_kerja)
                $('#EditMasterModal .modal-body #kat_kerja').val(data.hasil.kat_kerja)
                $('#EditMasterModal .modal-body #pekerjaan_detil').val(data.hasil.kerja_detil)
                if (data.hasil.url_foto != null)
                {
                    $('#EditMasterModal .modal-body #foto_kunjungan').attr("src",'{{asset("storage")}}'+data.hasil.url_foto)
                }
                else
                {
                    $('#EditMasterModal .modal-body #foto_kunjungan').attr("src","https://via.placeholder.com/480x360/0000FF/FFFFFF/?text=belum+ada+photo")
                }
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
//cek sebelum submit form
$('#EditMasterModal .modal-footer #updateDataPengunjung').on('click', function(e) {
    e.preventDefault();
    var tamu_id = $('#EditMasterModal .modal-body #tamu_id').val();
    var jenis_identitas = $('#EditMasterModal .modal-body #jenis_identitas').val();
    var nomor_identitas = $('#EditMasterModal .modal-body #nomor_identitas').val();
    var nama_lengkap = $('#EditMasterModal .modal-body #nama_lengkap').val();
    var id_jk = $('#EditMasterModal .modal-body #id_jk').val();
    var tgl_lahir = $('#EditMasterModal .modal-body #tgl_lahir').val();
    var id_mdidik = $('#EditMasterModal .modal-body #id_mdidik').val();
    var id_kerja = $('#EditMasterModal .modal-body #id_kerja').val();
    var telepon = $('#EditMasterModal .modal-body #telepon').val();
    var kat_kerja = $('#EditMasterModal .modal-body #kat_kerja').val();
    var pekerjaan_detil = $('#EditMasterModal .modal-body #pekerjaan_detil').val();
    var mwarga = $('#EditMasterModal .modal-body #mwarga').val();
    var alamat = $('#EditMasterModal .modal-body #alamat').val();
    var email = $('#EditMasterModal .modal-body #email').val();
    if (jenis_identitas == "")
    {
        $('#EditMasterModal .modal-body #edit_pengunjung_error').text('Pilih jenis identitas');
        return false;
    }
    else if (nomor_identitas == "")
    {
        $('#EditMasterModal .modal-body #edit_pengunjung_error').text('Nomor identitas harus terisi');
        return false;
    }    
    else if (nama_lengkap == "")
    {
        $('#EditMasterModal .modal-body #edit_pengunjung_error').text('Nama Lengkap harus terisi');
        return false;
    } 
    else if (id_jk == "")
    {
        $('#EditMasterModal .modal-body #edit_pengunjung_error').text('Pilih jenis kelamin');
        return false;
    } 
    else if (tgl_lahir == "")
    {
        $('#EditMasterModal .modal-body #edit_pengunjung_error').text('Tanggal lahir harus terisi');
        return false;
    } 
    else if (cekUmur(tgl_lahir) <= 13)
    {
        $('#EditMasterModal .modal-body #edit_pengunjung_error').text('Umur minimal 14 tahun');
        return false;
    } 
    else if (telepon == "")
    {
        $('#EditMasterModal .modal-body #edit_pengunjung_error').text('Nomor telepon/HP harus terisi');
        return false;
    }
    else if (mwarga == "")
    {
        $('#EditMasterModal .modal-body #edit_pengunjung_error').text('Pilih kewarganegaraan');
        return false;
    } 
    else if (alamat == "")
    {
        $('#EditMasterModal .modal-body #edit_pengunjung_error').text('Alamat harus terisi');
        return false;
    } 
    else if (id_mdidik == "")
    {
        $('#EditMasterModal .modal-body #edit_pengunjung_error').text('Pilih pendidikan');
        return false;
    } 
    else if (id_kerja == "")
    {
        $('#EditMasterModal .modal-body #edit_pengunjung_error').text('Pilih pekerjaan');
        return false;
    }
    else if (kat_kerja == "")
    {
        $('#EditMasterModal .modal-body #edit_pengunjung_error').text('Pilih kategori pekerjaan');
        return false;
    } 
    else if (pekerjaan_detil == "")
    {
        $('#EditMasterModal .modal-body #edit_pengunjung_error').text('Detil pekerjaan harus terisi');
        return false;
    }
    else
    {
        if (email != "")
        {
            var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            if(!email.match(mailformat))
            {
                $('#EditMasterModal .modal-body #edit_pengunjung_error').text('Format email tidak sesuai');
                return false;
            }
        }
        //$('#EditMasterModal .modal-body #formEditMasterPengunjung').submit();
        //ajax responsen
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url : '{{route('pengunjung.simpan')}}',
            method : 'post',
            data: {
                tamu_id: tamu_id,
                jenis_identitas: jenis_identitas,
                nomor_identitas: nomor_identitas,
                nama_lengkap: nama_lengkap,
                id_jk: id_jk,
                tgl_lahir: tgl_lahir,
                id_mdidik: id_mdidik,
                id_kerja: id_kerja,
                telepon: telepon,
                kat_kerja: kat_kerja,
                pekerjaan_detil: pekerjaan_detil,
                mwarga: mwarga,
                alamat: alamat,
                email: email,
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
                        'danger'
                    );
                }

            },
            error: function(){
                Swal.fire(
                    'Error',
                    'Koneksi Error',
                    'danger'
                );
            }

        });
        //batas
    }

});
</script>
<script type="text/javascript">
function GetUmur(birthDateString) {
    var today = new Date();
    var age = today.getFullYear() - birthDateString;
    return age;
}
//cek nomor hp
$('#cek_hp').click(function(){

var nomor = $("#nomor_hp").val();
if (nomor == "")
{
    $('#nomor_hp_error').removeClass("has-danger");
    $('#nomor_hp_error').addClass("has-danger");
    Swal.fire({
        type: 'error',
        title: 'error',
        text: 'Silakan isi nomor hp pengunjung'
        });
    return false;
}
else if (nomor.match(/[^\d+]/))
    {
        Swal.fire({
            type: 'error',
            title: 'error',
            text: 'Silakan masukkan nomor handphone hanya angka'
            });
        return false;
    }
else
{
    $('#nomor_hp_error').removeClass("has-danger");
    $('#nomor_hp_error').addClass("has-success");
}
$.ajax({
url : '{{route("webapi")}}/',
method : 'get',
data: {
    model: 'hp',
    nomor: nomor
},
cache: false,
dataType: 'json',
success: function(d){

    if (d.status==false) {
        //buka semua inputan
        $('#pengunjung_nama').prop('readonly', false);
        $('#pengunjung_jk').prop('disabled', false);
        $('#pengunjung_tahun_lahir').prop('readonly', false);
        $('#pengunjung_pekerjaan').prop('readonly', false);
        $('#pengunjung_pendidikan').prop('disabled', false);
        $('#pengunjung_email').prop('readonly', false);
        $('#pengunjung_alamat').prop('readonly', false);
        $('#edit_hp').prop('disabled', true);

        //kosongan isian
        $('#pengunjung_uid').val("");
        $('#pengunjung_nama').val("");
        $('#pengunjung_jk').val("");
        $('#pengunjung_tahun_lahir').val("");
        $('#pengunjung_pekerjaan').val("");
        $('#pengunjung_pendidikan').val("");
        $('#pengunjung_email').val("");
        $('#pengunjung_alamat').val("");
        $('#edit_pengunjung').val(0);
        $('#pengunjung_baru').prop('value','1');
    }
    else {
        //success / ada pengunjung
        //inputan dia set readonly dulu
        $('#pengunjung_nama').prop('readonly', true);
        $('#pengunjung_jk').prop('disabled', true);
        $('#pengunjung_tahun_lahir').prop('readonly', true);
        $('#pengunjung_pekerjaan').prop('readonly', true);
        $('#pengunjung_pendidikan').prop('disabled', true);
        $('#pengunjung_email').prop('readonly', true);
        $('#pengunjung_alamat').prop('readonly', true);
        $('#edit_hp').prop('disabled', false);

        //data di isikan di inputan
        $('#pengunjung_id').val(d.data.pengunjung_id);
        $('#pengunjung_uid').val(d.data.pengunjung_uid);
        $('#pengunjung_nama').val(d.data.pengunjung_nama);
        $('#pengunjung_jk').val(d.data.pengunjung_jk);
        $('#pengunjung_tahun_lahir').val(d.data.pengunjung_tahun_lahir);
        $('#pengunjung_pekerjaan').val(d.data.pengunjung_pekerjaan);
        $('#pengunjung_pendidikan').val(d.data.pengunjung_pendidikan);
        $('#pengunjung_email').val(d.data.pengunjung_email);
        $('#pengunjung_alamat').val(d.data.pengunjung_alamat);
        $('#edit_pengunjung').val(0);
        $('#pengunjung_baru').prop('value','0');

    }
},
error: function(){
    alert("error koneksi");
}

});
});
//batas
//edit data pengunjung
$('#edit_hp').click(function(){
    //buka semua inputan
    $('#pengunjung_nama').prop('readonly', false);
    $('#pengunjung_jk').prop('disabled', false);
    $('#pengunjung_tahun_lahir').prop('readonly', false);
    $('#pengunjung_pekerjaan').prop('readonly', false);
    $('#pengunjung_pendidikan').prop('disabled', false);
    $('#pengunjung_email').prop('readonly', false);
    $('#pengunjung_alamat').prop('readonly', false);
    $('#edit_hp').prop('disabled', true);
    $('#edit_pengunjung').prop('value','1');
});

//cek form sebelum submit untuk checkbox
$('#newPermintaanSave').on('click', function(e) {
    e.preventDefault();
    var pengunjung_baru = $('#pengunjung_baru').val();
    //cek isian bila ada tamu baru / tamu di edit
    if (pengunjung_baru == 1)
    {
        var pengunjung_nama = $('#pengunjung_nama').val();
        var pengunjung_jk = $('#pengunjung_jk').val();
        var pengunjung_tahun_lahir = $('#pengunjung_tahun_lahir').val();
        var pengunjung_pekerjaan = $('#pengunjung_pekerjaan').val();
        var pengunjung_pendidikan = $('#pengunjung_pendidikan').val();
        var penunjung_alamat = $('#penunjung_alamat').val();
        var nomor_hp = $('#nomor_hp').val();
        if (pengunjung_nama == "")
        {
            Swal.fire({
                type: 'error',
                title: 'error',
                text: 'Nama pengunjung harus terisi'
                });
            return false;
        }
        if (pengunjung_jk == "")
        {
            Swal.fire({
                type: 'error',
                title: 'error',
                text: 'Pilih salah satu jenis kelamin'
                });
            return false;
        }
        if (pengunjung_tahun_lahir == "")
        {
            Swal.fire({
                type: 'error',
                title: 'error',
                text: 'Tahun lahir harus terisi'
                });
            return false;
        }
        if (GetUmur(pengunjung_tahun_lahir) <= 13)
        {
            Swal.fire({
                type: 'error',
                title: 'error',
                text: 'umur minimal 14 tahun'
                });
            return false;
        }

        if (pengunjung_pendidikan == "")
        {
            Swal.fire({
                type: 'error',
                title: 'error',
                text: 'Pilih salah satu pendidikan'
                });
            return false;
        }
        if (pengunjung_pekerjaan == "")
        {
            Swal.fire({
                type: 'error',
                title: 'error',
                text: 'isian pekerjaan harus terisi'
                });
            return false;
        }
        if (pengunjung_alamat == "")
        {
            Swal.fire({
                type: 'error',
                title: 'error',
                text: 'Silakan masukkan alamat tempat tinggal'
                });
            return false;
        }
    }
    //batasnya
    var kunjungan_tujuan = $('#kunjungan_tujuan').val();
    if (kunjungan_tujuan == "")
    {
        Swal.fire({
                type: 'error',
                title: 'error',
                text: 'Pilih salah satu tujuan kunjungan'
                });
            return false;
    }
    else if (kunjungan_tujuan == 2)
    {
        var layanan_pst = $('#layananpst_kode').val();
        if (layanan_pst < 1)
        {
            Swal.fire({
                type: 'error',
                title: 'error',
                text: 'Karena tujuan PST maka Pilih salah satu layanan yang digunakan selain lainnya'
                });
            return false;
        }
    }
    //cek keperluan sebelum submit
    var kunjungan_keperluan = $('#kunjungan_keperluan').val();
    if (kunjungan_keperluan == "")
    {
        $('#kunjungan_keperluan_error').removeClass("has-danger");
        $('#kunjungan_keperluan_error').addClass("has-danger");
        Swal.fire({
            type: 'error',
            title: 'error',
            text: 'Keperluan/Data yang dicari tidak boleh kosong'
            });
        return false;
    }
    else
    {
        $('#kunjungan_keperluan_error').removeClass("has-danger");
        $('#kunjungan_keperluan_error').addClass("has-success");

        Swal.fire({
            title: 'Anda yakin?',
            text: "Data permintaan akan disimpan",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'YA, SIMPAN',
            cancelBUttonText: 'BATAL'
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                    'Berhasil!',
                    'Data permintaan sudah disimpan',
                    'success'
                ).then(function(submit) {
                    $('#formNewPermintaan').submit();
                });
            }
        })
    }

});
//script merubah warna hijau dan merah
$('#pengunjung_keperluan').on('change paste keyup', function(e) {
var keperluan = e.target.value;
if (keperluan == "")
{
    $('#pengunjung_keperluan_error').removeClass("has-danger");
    $('#pengunjung_keperluan_error').addClass("has-danger");
}
else if (keperluan.length < 6)
{
    $('#pengunjung_keperluan_error').removeClass("has-danger");
    $('#pengunjung_keperluan_error').addClass("has-danger");
}
else
{
    $('#pengunjung_keperluan_error').removeClass("has-danger");
    $('#pengunjung_keperluan_error').addClass("has-success");
}
});
//batas
</script>

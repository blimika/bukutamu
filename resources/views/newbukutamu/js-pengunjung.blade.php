<script type="text/javascript">
function GetUmur(birthDateString) {
    var today = new Date();
    var age = today.getFullYear() - birthDateString;
    return age;
}
//view
$('#ViewPengunjungModal').on('show.bs.modal', function (event) {
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
            $('#ViewPengunjungModal .modal-body #pengunjung_id').text('#'+d.data.pengunjung_id)
            $('#ViewPengunjungModal .modal-body #pengunjung_uid').text(d.data.pengunjung_uid)
            $('#ViewPengunjungModal .modal-body #pengunjung_nama').text(d.data.pengunjung_nama)
            $('#ViewPengunjungModal .modal-body #pengunjung_jk').text(d.data.jenis_kelamin.nama)
            $('#ViewPengunjungModal .modal-body #pengunjung_tahun_lahir').text(d.data.pengunjung_tahun_lahir+' ('+ GetUmur(d.data.pengunjung_tahun_lahir) + ' tahun)')
            $('#ViewPengunjungModal .modal-body #pengunjung_pekerjaan').text(d.data.pengunjung_pekerjaan)
            $('#ViewPengunjungModal .modal-body #pengunjung_pendidikan').text(d.data.pendidikan.nama)
            $('#ViewPengunjungModal .modal-body #pengunjung_email').text(d.data.pengunjung_email)
            $('#ViewPengunjungModal .modal-body #pengunjung_nomor_hp').text(d.data.pengunjung_nomor_hp)
            if (d.data.pengunjung_nomor_hp != null)
            {
                var pengunjung_nomor_hp = d.data.pengunjung_nomor_hp.substr(1);
                var pengunjung_wa = "http://wa.me/62"+pengunjung_nomor_hp;
            }
            else
            {
                var pengunjung_wa = "#";
            }
            $('#ViewPengunjungModal .modal-body #pengunjung_wa').attr("href",pengunjung_wa)
            $('#ViewPengunjungModal .modal-body #pengunjung_alamat').text(d.data.pengunjung_alamat)
            $('#ViewPengunjungModal .modal-footer #pengunjung_timeline').attr("href","{{route('timeline','')}}/"+d.data.pengunjung_uid)
            $('#ViewPengunjungModal .modal-body #kunjungan_tanggal').text(d.data.kunjungan_tanggal)
            if (d.data.pengunjung_foto_profil != null)
            {
                $('#ViewPengunjungModal .modal-body #pengunjung_foto').attr("src",'{{asset("storage")}}'+d.data.pengunjung_foto_profil)
            }
            else
            {
                $('#ViewPengunjungModal .modal-body #pengunjung_foto').attr("src","https://placehold.co/480x360/0000FF/FFFFFF/?text=belum+ada+photo")
            }
                if (d.data.kunjungan.length > 0)
                {
                    var teks = "";
                    //var tmax = d.data.kunjungan.length;
                    if (d.data.kunjungan.length > 10)
                    {
                        //mulai dari 0 , max list 10 record jadi tmax 9
                        var tmax = 10;
                    }
                    else
                    {
                        var tmax = d.data.kunjungan.length;
                    }
                    var i;
                    var kunjungan = d.data.kunjungan;
                    for (i = 0; i < tmax; i++) {
                        teks +=  "🟢 <strong>" + kunjungan[i].kunjungan_tanggal + "</strong> ("+ kunjungan[i].kunjungan_keperluan +")<br />";
                    }
                    $('#ViewPengunjungModal .modal-body #kunjungan_terakhir').html(teks)
                }
                else
                {
                    $('#ViewPengunjungModal .modal-body #kunjungan_terakhir').text('tidak ada kunjungan');
                }
            }
            else
            {
                Swal.fire(
                    'Error',
                    ''+d.message+'',
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
});
//batas view
</script>

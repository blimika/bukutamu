<script>
$('#ViewMemberModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var userid = button.data('id')
    //load dulu transaksinya
    $.ajax({
        url : '{{route("member.cari","")}}/'+userid,
        method : 'get',
        cache: false,
        dataType: 'json',
        success: function(data){
            if (data.status == true)
            {
                $('#ViewMemberModal .modal-body #member_nama').text(data.hasil.name)
                $('#ViewMemberModal .modal-body #member_username').text(data.hasil.username)
                $('#ViewMemberModal .modal-body #member_telepon').text(data.hasil.telepon)
                if (data.hasil.telepon != null)
                {
                    var member_telepon = data.hasil.telepon.substr(1);
                    var member_wa = "http://wa.me/62"+member_telepon;
                }
                else
                {
                    var member_wa = "#";
                }
                $('#ViewMemberModal .modal-body #member_wa').attr("href",member_wa)
                $('#ViewMemberModal .modal-body #member_level').text(data.hasil.level_nama)
                //lastlogin di cek dan lastip
                if (data.hasil.lastlogin != null)
                {
                    $('#ViewMemberModal .modal-body #member_lastlogin').text(data.hasil.lastlogin_nama)
                    $('#ViewMemberModal .modal-body #member_lastip').text(data.hasil.lastip)
                    $('#ViewMemberModal .modal-body #member_lastlogin').addClass('normal')
                    $('#ViewMemberModal .modal-body #member_lastip').addClass('normal')
                    $('#ViewMemberModal .modal-body #member_lastlogin').removeClass('miring')
                    $('#ViewMemberModal .modal-body #member_lastip').removeClass('miring')
                }
                else
                {
                    $('#ViewMemberModal .modal-body #member_lastlogin').text("belum pernah login")
                    $('#ViewMemberModal .modal-body #member_lastip').text("belum pernah login")
                    $('#ViewMemberModal .modal-body #member_lastlogin').addClass('miring')
                    $('#ViewMemberModal .modal-body #member_lastip').addClass('miring')
                    $('#ViewMemberModal .modal-body #member_lastlogin').removeClass('normal')
                    $('#ViewMemberModal .modal-body #member_lastip').removeClass('normal')
                }
                $('#ViewMemberModal .modal-body #member_flag').text(data.hasil.flag_nama)
                $('#ViewMemberModal .modal-body #member_created').text(data.hasil.created_at_nama)
                $('#ViewMemberModal .modal-body #member_updated').text(data.hasil.updated_at_nama)
                if (data.hasil.tamu_id == 0)
                {
                    $('#ViewMemberModal .modal-body #tamu').toggle(false);
                    $('#ViewMemberModal .modal-body #tamu_id').text("belum terkoneksi")
                    $('#ViewMemberModal .modal-body #tamu_id').addClass('miring')
                    $('#ViewMemberModal .modal-body #tamu_id').removeClass('normal')
                }
                else
                {
                    $('#ViewMemberModal .modal-body #tamu').toggle(true);
                    $('#ViewMemberModal .modal-body #tamu_id').text(data.hasil.tamu_id)
                    $('#ViewMemberModal .modal-body #tamu_id').addClass('normal')
                    $('#ViewMemberModal .modal-body #tamu_id').removeClass('miring')
                    //sudah terkoneksi pengunjung
                    $('#ViewMemberModal .modal-body #tamu_nama').text(data.hasil.pengunjung.hasil.nama_lengkap)
                    @if (Auth::user())
                    $('#ViewMemberModal .modal-body #tamu_kode').text(data.hasil.pengunjung.hasil.kode_qr)
                    $('#ViewMemberModal .modal-body #tamu_identitas').text(data.hasil.pengunjung.hasil.nomor_identitas+' ('+ data.hasil.pengunjung.hasil.id_identitas_nama +')')
                    @endif
                    $('#ViewMemberModal .modal-body #tamu_jk').text(data.hasil.pengunjung.hasil.nama_jk)
                    $('#ViewMemberModal .modal-body #tamu_lahir').text(data.hasil.pengunjung.hasil.tgl_lahir_nama+' ('+ data.hasil.pengunjung.hasil.umur + ' tahun)')
                    $('#ViewMemberModal .modal-body #tamu_kerja').text(data.hasil.pengunjung.hasil.nama_kerja)
                    $('#ViewMemberModal .modal-body #kerja_detil').text(data.hasil.pengunjung.hasil.kerja_detil)
                    $('#ViewMemberModal .modal-body #kat_kerja_nama').text(data.hasil.pengunjung.hasil.kat_kerja_nama)
                    $('#ViewMemberModal .modal-body #tamu_pendidikan').text(data.hasil.pengunjung.hasil.nama_mdidik)
                    //$('#ViewMemberModal .modal-body #tamu_warga').text(data.hasil.nama_mwarga)
                    $('#ViewMemberModal .modal-body #tamu_email').text(data.hasil.pengunjung.hasil.email)
                    $('#ViewMemberModal .modal-body #tamu_telepon').text(data.hasil.pengunjung.hasil.telepon)
                    if (data.hasil.pengunjung.hasil.telepon != null)
                    {
                        var tamu_telpon = data.hasil.pengunjung.hasil.telepon.substr(1);
                        var tamu_wa = "http://wa.me/62"+tamu_telpon;
                    }
                    else
                    {
                        var tamu_wa = "#";
                    }
                    $('#ViewMemberModal .modal-body #tamu_wa').attr("href",tamu_wa)
                    $('#ViewMemberModal .modal-body #tamu_alamat').text(data.hasil.pengunjung.hasil.alamat)
                    if (data.hasil.pengunjung.hasil.url_foto != null)
                    {
                        $('#ViewMemberModal .modal-body #tamu_foto').attr("src",'{{asset("storage")}}'+data.hasil.pengunjung.hasil.url_foto)
                    }
                    else
                    {
                        $('#ViewMemberModal .modal-body #tamu_foto').attr("src","https://via.placeholder.com/480x360/0000FF/FFFFFF/?text=belum+ada+photo")
                    }
                    if (data.hasil.pengunjung.hasil.kunjungan.status == true)
                    {
                        var teks = "";
                        var tmax = data.hasil.pengunjung.hasil.kunjungan.jumlah;
                        if (tmax > 10)
                        {
                            var tmax = 10;
                        }
                        var i;
                        var kunjungan = data.hasil.pengunjung.hasil.kunjungan.hasil;
                        for (i = 0; i < tmax; i++) {
                            teks +=  "🟢 <strong>" + kunjungan[i].tanggal_nama + "</strong> ("+ kunjungan[i].keperluan +")<br />";
                        }
                        $('#ViewMemberModal .modal-body #kunjungan_terakhir').html(teks)
                    }
                    else
                    {
                        $('#ViewMemberModal .modal-body #kunjungan_terakhir').text(data.hasil.pengunjung.hasil.kunjungan.hasil);
                    }
                    $('#ViewMemberModal .modal-body #tamu_timeline').attr("href","{{route('tamu.detil','')}}/"+data.hasil.pengunjung.hasil.kode_qr)
                    //batasan sudah terkoneksi
                }
            }
            else
            {
                alert(data.hasil);
            }
        },
        error: function(){
            alert("error load view");
        }

    });
});
</script>

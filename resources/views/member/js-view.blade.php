<script>
$('#ViewMemberModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var userid = button.data('id')
    //load dulu transaksinya
    $.ajax({
        url : '{{route("webapi")}}',
        method : 'get',
        data: {
            model:'member',
            id: userid
        },
        cache: false,
        dataType: 'json',
        success: function(d){
            if (d.status == true)
            {
                $('#ViewMemberModal .modal-body #member_nama').text(d.data.name)
                $('#ViewMemberModal .modal-body #member_username').text(d.data.username)
                $('#ViewMemberModal .modal-body #member_telepon').text(d.data.telepon)
                if (d.data.telepon != null)
                {
                    var member_telepon = d.data.telepon.substr(1);
                    var member_wa = "http://wa.me/62"+member_telepon;
                }
                else
                {
                    var member_wa = "#";
                }
                $('#ViewMemberModal .modal-body #member_wa').attr("href",member_wa)
                $('#ViewMemberModal .modal-body #member_level').text(d.data.m_level.nama)
                //lastlogin di cek dan lastip
                if (d.data.lastlogin != null)
                {
                    $('#ViewMemberModal .modal-body #member_lastlogin').text(d.data.lastlogin)
                    $('#ViewMemberModal .modal-body #member_lastip').text(d.data.lastip)
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
                $('#ViewMemberModal .modal-body #member_flag').text(d.data.flag)
                $('#ViewMemberModal .modal-body #member_created').text(d.data.created_at)
                $('#ViewMemberModal .modal-body #member_updated').text(d.data.updated_at)
                if (d.data.user_foto != null)
                    {
                        $('#ViewMemberModal .modal-body #member_foto').attr("src",'{{asset("storage")}}'+d.data.user_foto)
                    }
                    else
                    {
                        $('#ViewMemberModal .modal-body #member_foto').attr("src","https://placehold.co/480x360/0000FF/FFFFFF/?text=belum+ada+photo")
                    }
                if (d.data.tamu_id == 0)
                {
                    $('#ViewMemberModal .modal-body #tamu').toggle(false);
                    $('#ViewMemberModal .modal-body #tamu_id').text("belum terkoneksi")
                    $('#ViewMemberModal .modal-body #tamu_id').addClass('miring')
                    $('#ViewMemberModal .modal-body #tamu_id').removeClass('normal')
                }
                else
                {
                    $('#ViewMemberModal .modal-body #tamu').toggle(true);
                    $('#ViewMemberModal .modal-body #tamu_id').text('#'+d.data.tamu_id)
                    $('#ViewMemberModal .modal-body #pengunjung_id').text('#'+d.data.tamu_id)
                    $('#ViewMemberModal .modal-body #tamu_id').addClass('normal')
                    $('#ViewMemberModal .modal-body #tamu_id').removeClass('miring')
                    //sudah terkoneksi pengunjung
                    $('#ViewMemberModal .modal-body #pengunjung_nama').text(d.data.pengunjung.pengunjung_nama)
                    $('#ViewMemberModal .modal-body #pengunjung_uid').text(d.data.pengunjung.pengunjung_uid)
                    $('#ViewMemberModal .modal-body #pengunjung_jk').text(d.data.pengunjung.jenis_kelamin.nama)
                    $('#ViewMemberModal .modal-body #pengunjung_tahun_lahir').text(d.data.pengunjung.pengunjung_tahun_lahir)
                    $('#ViewMemberModal .modal-body #pengunjung_pekerjaan').text(d.data.pengunjung.pengunjung_pekerjaan)
                    $('#ViewMemberModal .modal-body #pengunjung_pendidikan').text(d.data.pengunjung.pendidikan.nama)
                    $('#ViewMemberModal .modal-body #pengunjung_email').text(d.data.pengunjung.pengunjung_email)
                    $('#ViewMemberModal .modal-body #pengunjung_nomor_hp').text(d.data.pengunjung.pengunjung_nomor_hp)
                    if (d.data.pengunjung.pengunjung_nomor_hp != null)
                    {
                        var tamu_telpon = d.data.pengunjung.pengunjung_nomor_hp.substr(1);
                        var tamu_wa = "http://wa.me/62"+tamu_telpon;
                    }
                    else
                    {
                        var tamu_wa = "#";
                    }
                    $('#ViewMemberModal .modal-body #pengunjung_wa').attr("href",tamu_wa)
                    $('#ViewMemberModal .modal-body #pengunjung_alamat').text(d.data.pengunjung.pengunjung_alamat)
                    if (d.data.pengunjung.pengunjung_foto_profil != null)
                    {
                        $('#ViewMemberModal .modal-body #pengunjung_foto').attr("src",'{{asset("storage")}}'+d.data.pengunjung.pengunjung_foto_profil)
                    }
                    else
                    {
                        $('#ViewMemberModal .modal-body #pengunjung_foto').attr("src","https://placehold.co/480x360/0000FF/FFFFFF/?text=belum+ada+photo")
                    }
                    if (d.data.pengunjung.kunjungan.length > 0)
                    {
                        var teks = "";
                        //var tmax = d.data.kunjungan.length;
                        if (d.data.pengunjung.kunjungan.length > 10)
                        {
                            //mulai dari 0 , max list 10 record jadi tmax 9
                            var tmax = 10;
                        }
                        else
                        {
                            var tmax = d.data.pengunjung.kunjungan.length;
                        }
                        var i;
                        var kunjungan = d.data.pengunjung.kunjungan;
                        for (i = 0; i < tmax; i++) {
                            teks +=  "🟢 <strong>" + kunjungan[i].kunjungan_tanggal + "</strong> ("+ kunjungan[i].kunjungan_keperluan +")<br />";
                        }
                        $('#ViewMemberModal .modal-body #kunjungan_terakhir').html(teks)
                    }
                    else
                    {
                        $('#ViewMemberModal .modal-body #kunjungan_terakhir').text('tidak ada kunjungan');
                    }
                    $('#ViewMemberModal .modal-body #pengunjung_timeline').attr("href","{{route('timeline','')}}/"+d.data.pengunjung.pengunjung_uid)
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

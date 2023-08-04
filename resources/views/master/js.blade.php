<script>
    //hapus tamu
$(".hapuspengunjungmaster").click(function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var nama = $(this).data('nama');
    Swal.fire({
                title: 'Akan dihapus?',
                text: "Data pengunjung "+nama+" akan dihapus permanen",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.value) {
                    //response ajax disini
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url : '{{route('pengunjung.hapus')}}',
                        method : 'post',
                        data: {
                            id: id
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

                }
            })
});
//batas hapus

$('#ViewModalMaster').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var tamuid = button.data('tamuidmaster')
    var kodeqr = button.data('kodeqrmaster')
    //load dulu transaksinya
    $.ajax({
        url : '{{route("pengunjung.cari","")}}/'+tamuid,
        method : 'get',
        cache: false,
        dataType: 'json',
        success: function(data){
            if (data.status == true)
            {
                $('#ViewModalMaster .modal-body #tamu_id').text(tamuid)
                $('#ViewModalMaster .modal-body #tamu_nama').text(data.hasil.nama_lengkap)
                $('#ViewModalMaster .modal-body #tamu_identitas').text(data.hasil.nomor_identitas+' ('+ data.hasil.id_identitas_nama +')')
                $('#ViewModalMaster .modal-body #tamu_jk').text(data.hasil.nama_jk)
                $('#ViewModalMaster .modal-body #tamu_lahir').text(data.hasil.tgl_lahir_nama)
                $('#ViewModalMaster .modal-body #tamu_kerja').text(data.hasil.nama_kerja)
                $('#ViewModalMaster .modal-body #kerja_detil').text(data.hasil.kerja_detil)
                $('#ViewModalMaster .modal-body #kat_kerja_nama').text(data.hasil.kat_kerja_nama)
                $('#ViewModalMaster .modal-body #tamu_pendidikan').text(data.hasil.nama_mdidik)
                $('#ViewModalMaster .modal-body #tamu_warga').text(data.hasil.nama_mwarga)
                $('#ViewModalMaster .modal-body #tamu_email').text(data.hasil.email)
                $('#ViewModalMaster .modal-body #tamu_telepon').text(data.hasil.telepon)
                $('#ViewModalMaster .modal-body #tamu_alamat').text(data.hasil.alamat)
                $('#ViewModalMaster .modal-body #kodeqr').attr("src",'{{asset("storage")}}/img/qrcode/'+data.hasil.kode_qr+'-'+tamuid+'.png')
                if (data.hasil.url_foto != null)
                {
                    $('#ViewModalMaster .modal-body #tamu_foto').attr("src",'{{asset("storage")}}'+data.hasil.url_foto)
                }
                else
                {
                    $('#ViewModalMaster .modal-body #tamu_foto').attr("src","https://via.placeholder.com/480x360/0000FF/FFFFFF/?text=belum+ada+photo")
                }
                if (data.hasil.kunjungan.status == true)
                {
                    var teks = "";
                    var tmax = data.hasil.kunjungan.jumlah;
                    var i;
                    var kunjungan = data.hasil.kunjungan.hasil;
                    for (i = 0; i < tmax; i++) {
                        teks +=  "🟢 <strong>" + kunjungan[i].tanggal_nama + "</strong> ("+ kunjungan[i].keperluan +")<br />";
                    }
                    $('#ViewModalMaster .modal-body #kunjungan_terakhir').html(teks)
                }
                else
                {
                    $('#ViewModalMaster .modal-body #kunjungan_terakhir').text(data.hasil.kunjungan.hasil)
                }
            }
            else
            {
                alert(data.hasil);
            }
        },
        error: function(){
            alert("error load modal");
        }

    });
});
$('#ViewModal').on('show.bs.modal', function (event) {
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
            $('#ViewModal .modal-body #tamu_id').text(tamuid)
            $('#ViewModal .modal-body #tamu_nama').text(data.hasil.nama_lengkap)
            $('#ViewModal .modal-body #tamu_kode').text(data.hasil.kode_qr)
            $('#ViewModal .modal-body #tamu_identitas').text(data.hasil.nomor_identitas+' ('+ data.hasil.id_identitas_nama +')')
            $('#ViewModal .modal-body #tamu_jk').text(data.hasil.nama_jk)
            $('#ViewModal .modal-body #tamu_lahir').text(data.hasil.tgl_lahir_nama)
            $('#ViewModal .modal-body #tamu_kerja').text(data.hasil.nama_kerja)
            $('#ViewModal .modal-body #kerja_detil').text(data.hasil.kerja_detil)
            $('#ViewModal .modal-body #kat_kerja_nama').text(data.hasil.kat_kerja_nama)
            $('#ViewModal .modal-body #tamu_pendidikan').text(data.hasil.nama_mdidik)
            $('#ViewModal .modal-body #tamu_warga').text(data.hasil.nama_mwarga)
            $('#ViewModal .modal-body #tamu_email').text(data.hasil.email)
            $('#ViewModal .modal-body #tamu_telepon').text(data.hasil.telepon)
            if (data.hasil.telepon != null)
            {
                var tamu_telpon = data.hasil.telepon.substr(1);
                var tamu_wa = "http://wa.me/62"+tamu_telpon;
            }
            else
            {
                var tamu_wa = "#";
            }
            $('#ViewModal .modal-body #tamu_wa').attr("href",tamu_wa)
            $('#ViewModal .modal-body #tamu_alamat').text(data.hasil.alamat)
            $('#ViewModal .modal-footer #tamu_timeline').attr("href","{{route('tamu.detil','')}}/"+tamuid)
            //$('#ViewModal .modal-body #kodeqr').attr("src",'{{asset("storage")}}/img/qrcode/'+data.hasil.kode_qr+'-'+tamuid+'.png')
                if (data.hasil.url_foto != null)
                {
                    $('#ViewModal .modal-body #tamu_foto').attr("src",'{{asset("storage")}}'+data.hasil.url_foto)
                }
                else
                {
                    $('#ViewModal .modal-body #tamu_foto').attr("src","https://via.placeholder.com/480x360/0000FF/FFFFFF/?text=belum+ada+photo")
                }
                if (data.hasil.kunjungan.status == true)
                {
                    var teks = "";
                    var tmax = data.hasil.kunjungan.jumlah;
                    var i;
                    var kunjungan = data.hasil.kunjungan.hasil;
                    for (i = 0; i < tmax; i++) {
                        teks +=  "🟢 <strong>" + kunjungan[i].tanggal_nama + "</strong> ("+ kunjungan[i].keperluan +")<br />";
                    }
                    $('#ViewModal .modal-body #kunjungan_terakhir').html(teks)
                }
                else
                {
                    $('#ViewModal .modal-body #kunjungan_terakhir').text(data.hasil.kunjungan.hasil);
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
</script>

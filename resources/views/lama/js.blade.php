<script>
//edit data kunjungan
$('#EditKunjunganModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var kunjunganid = button.data('id')
    //load dulu transaksinya
    $.ajax({
        url : '{{route("getdatakunjungan","")}}/'+kunjunganid,
        method : 'get',
        cache: false,
        dataType: 'json',
        success: function(data){
            if (data.status == true)
            {
            $('#EditKunjunganModal .modal-body #kunjungan_id_teks').text(kunjunganid)
            $('#EditKunjunganModal .modal-body #tamu_id_teks').text(data.hasil.tamu_id)
            $('#EditKunjunganModal .modal-body #kunjungan_id').val(kunjunganid)
            $('#EditKunjunganModal .modal-body #tamu_id').val(data.hasil.tamu_id)
            $('#EditKunjunganModal .modal-body #tamu_nama').text(data.hasil.tamu.nama_lengkap)
            $('#EditKunjunganModal .modal-body #tamu_keperluan').text(data.hasil.keperluan)
            $('#EditKunjunganModal .modal-body #jumlah_tamu').val(data.hasil.jumlah_tamu)
            $('#EditKunjunganModal .modal-body #tamu_laki').val(data.hasil.tamu_m)
            $('#EditKunjunganModal .modal-body #tamu_wanita').val(data.hasil.tamu_f)
            $('#EditKunjunganModal .modal-body #flag_edit_tamu').val(data.hasil.flag_edit_tamu)
            //$('#EditKunjunganModal .modal-body #kat_kerja_nama').text(data.hasil.kat_kerja_nama)
            //$('#EditKunjunganModal .modal-body #tamu_pendidikan').text(data.hasil.nama_mdidik)
            //$('#EditKunjunganModal .modal-body #tamu_warga').text(data.hasil.nama_mwarga)
            //$('#EditKunjunganModal .modal-body #tamu_email').text(data.hasil.email)
            //$('#EditKunjunganModal .modal-body #tamu_telepon').text(data.hasil.telepon)
            //$('#ViewModal .modal-body #tamu_alamat').text(data.hasil.alamat)
            $('#EditKunjunganModal .modal-footer #tamu_timeline').attr("href","{{route('tamu.detil','')}}/"+data.hasil.tamu_id)
            //$('#ViewModal .modal-body #kodeqr').attr("src",'{{asset("storage")}}/img/qrcode/'+data.hasil.kode_qr+'-'+tamuid+'.png')
                if (data.hasil.file_foto != null)
                {
                    $('#EditKunjunganModal .modal-body #foto_kunjungan').attr("src",'{{asset("storage")}}'+data.hasil.file_foto)
                }
                else
                {
                    $('#EditKunjunganModal .modal-body #foto_kunjungan').attr("src","https://via.placeholder.com/480x360/0000FF/FFFFFF/?text=belum+ada+photo")
                }
            }
            else
            {
                alert(data.hasil);
            }
        },
        error: function(){
            alert("error load data kunjungan");
        }

    });
});
//cek sebelum submit form
$('#kunjungan_update').on('click', function(e) {
    e.preventDefault();
    var jumlah_tamu = $('#EditKunjunganModal .modal-body #jumlah_tamu').val();
    var tamu_laki = $('#EditKunjunganModal .modal-body #tamu_laki').val();
    var tamu_wanita = $('#EditKunjunganModal .modal-body #tamu_wanita').val();
    if (jumlah_tamu == "")
    {
        $('#EditKunjunganModal .modal-body #kunjungan_teks_error').text('Jumlah tamu tidak boleh kosong');
        return false;
    }
    if (tamu_laki == "")
    {
        $('#EditKunjunganModal .modal-body #kunjungan_teks_error').text('Jumlah tamu laki-laki tidak boleh kosong');
        return false;
    }
    if (tamu_wanita == "")
    {
        $('#EditKunjunganModal .modal-body #kunjungan_teks_error').text('Jumlah tamu perempuan tidak boleh kosong');
        return false;
    }
    if (parseInt(jumlah_tamu) != (parseInt(tamu_laki)+parseInt(tamu_wanita)))
    {
        $('#EditKunjunganModal .modal-body #kunjungan_teks_error').text('Jumlah tamu total ('+jumlah_tamu+') tidak sama dengan jumlah tamu laki-laki ('+tamu_laki+') + jumlah tamu perempuan ('+tamu_wanita+')');
        return false;
    }
    else
    {
        $('#EditKunjunganModal .modal-body #formEditKunjunganKelompok').submit();
    }

});
//ubah jenis kunjungan
//ubah kunjungan depan
$(".ubahjeniskunjungan").click(function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var nama = $(this).data('nama');
    var jnskunjungan = $(this).data('jnskunjungan');
    var fotokunjungan = $(this).data('fotokunjungan');
    var jnskunjungan_nama;
    var jnskunjungan_after;
    var jnskunjungan_before;
    if (jnskunjungan == 1)
    {
        //akan diubah ke
        jnskunjungan_nama = "Kelompok";
        jnskunjungan_after = 2;
        jnskunjungan_before = jnskunjungan;
    }
    else
    {
        jnskunjungan_nama = "Perorangan";
        jnskunjungan_after = 1;
        jnskunjungan_before = jnskunjungan;
    }
    Swal.fire({
                title: 'Akan diubah?',
                text: "Jenis kunjungan "+nama+" akan diubah ke "+jnskunjungan_nama,
                imageUrl: fotokunjungan,
                imageWidth: 640,
                imageAlt: "Photo Kunjungan",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ubah'
            }).then((result) => {
                if (result.value) {
                    //response ajax disini
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url : '{{route('ubah.jeniskunjungan')}}',
                        method : 'post',
                        data: {
                            id: id,
                            jnskunjungan_before: jnskunjungan_before,
                            jnskunjungan_after: jnskunjungan_after
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
                                'Koneksi Error '+data.hasil+'',
                                'danger'
                            );
                        }

                    });

                }
            })
});
//batas hapus
</script>

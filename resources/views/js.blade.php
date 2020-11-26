<script>
    $('#cek_id').click(function(){

        var jenis = $("#jenis_identitas").val();
        var nomor = $('#nomor_identitas').val();
        $.ajax({
        url : '{{route('cekid',['',''])}}/'+jenis+'/'+nomor,
        method : 'get',
        cache: false,
        dataType: 'json',
        success: function(data){

            if (data.status==false) {
                //buka semua inputan
                $('#nama_lengkap').prop('readonly', false);
                $('#id_jk').prop('disabled', false);
                $('#tgl_lahir').prop('readonly', false);
                $('#id_kerja').prop('disabled', false);
                $('#kat_kerja').prop('disabled', false);
                $('#pekerjaan_detil').prop('readonly', false);
                $('#id_mdidik').prop('disabled', false);
                $('#mwarga').prop('disabled', false);
                $('#email').prop('readonly', false);
                $('#telepon').prop('readonly', false);
                $('#alamat').prop('readonly', false);
                $('#edit_id').prop('disabled', true);

                //kosongan isian
                $('#tamu_id').val("");
                $('#nama_lengkap').val("");
                $('#id_jk').val("");
                $('#tgl_lahir').val("");
                $('#id_kerja').val("");
                $('#kat_kerja').val("");
                $('#pekerjaan_detil').val("");
                $('#id_mdidik').val("");
                $('#mwarga').val("");
                $('#email').val("");
                $('#telepon').val("");
                $('#alamat').val("");
                $('#edit_tamu').val(0);
            }
            else {
                //success / ada tamu_id
                //inputan dia set readonly dulu
                $('#nama_lengkap').prop('readonly', true);
                $('#id_jk').prop('disabled', true);
                $('#tgl_lahir').prop('readonly', true);
                $('#id_kerja').prop('disabled', true);
                $('#kat_kerja').prop('disabled', true);
                $('#pekerjaan_detil').prop('readonly', true);
                $('#id_mdidik').prop('disabled', true);
                $('#mwarga').prop('disabled', true);
                $('#email').prop('readonly', true);
                $('#telepon').prop('readonly', true);
                $('#alamat').prop('readonly', true);
                $('#edit_id').prop('disabled', false);

                //data di isikan di inputan
                $('#tamu_id').val(data.hasil.tamu_id);
                $('#nama_lengkap').val(data.hasil.nama_lengkap);
                $('#tgl_lahir').val(data.hasil.tgl_lahir);
                $('#id_kerja').val(data.hasil.id_kerja);
                $('#kat_kerja').val(data.hasil.kat_kerja);
                $('#pekerjaan_detil').val(data.hasil.pekerjaan_detil);
                $('#id_mdidik').val(data.hasil.id_mdidik);
                $('#mwarga').val(data.hasil.mwarga);
                $('#email').val(data.hasil.email);
                $('#telepon').val(data.hasil.telepon);
                $('#alamat').val(data.hasil.alamat);
                $('#id_jk').val(data.hasil.id_jk);
                $('#edit_tamu').val(0);

            }
        },
        error: function(){
            alert("error");
        }

    });
        });

    //input data lama
    $('#cekid_lama').click(function(){

       var jenis = $("#jenis_identitas_lama").val();
       var nomor = $('#nomor_identitas_lama').val();
       $.ajax({
       url : '{{route('cekid',['',''])}}/'+jenis+'/'+nomor,
       method : 'get',
       cache: false,
       dataType: 'json',
       success: function(data){

           if (data.status==false) {
               //buka semua inputan
               $('#nama_lengkap_lama').prop('readonly', false);
               $('#id_jk_lama').prop('disabled', false);
               $('#tgl_lahir_lama').prop('readonly', false);
               $('#id_kerja_lama').prop('disabled', false);
               $('#kat_kerja_lama').prop('disabled', false);
               $('#pekerjaan_detil_lama').prop('readonly', false);
               $('#id_mdidik_lama').prop('disabled', false);
               $('#mwarga_lama').prop('disabled', false);
               $('#email_lama').prop('readonly', false);
               $('#telepon_lama').prop('readonly', false);
               $('#alamat_lama').prop('readonly', false);
               $('#editid_lama').prop('disabled', true);

               //kosongan isian
               $('#tamu_id_lama').val("");
               $('#nama_lengkap_lama').val("");
               $('#id_jk_lama').val("");
               $('#tgl_lahir_lama').val("");
               $('#id_kerja_lama').val("");
               $('#kat_kerja_lama').val("");
               $('#pekerjaan_detil_lama').val("");
               $('#id_mdidik_lama').val("");
               $('#mwarga_lama').val("");
               $('#email_lama').val("");
               $('#telepon_lama').val("");
               $('#alamat_lama').val("");
               $('#edit_tamu_lama').val(0);
           }
           else {
               //success / ada tamu_id
               //inputan dia set readonly dulu
               $('#nama_lengkap_lama').prop('readonly', true);
               $('#id_jk_lama').prop('disabled', true);
               $('#tgl_lahir_lama').prop('readonly', true);
               $('#id_kerja_lama').prop('disabled', true);
               $('#kat_kerja_lama').prop('disabled', true);
               $('#pekerjaan_detil_lama').prop('readonly', true);
               $('#id_mdidik_lama').prop('disabled', true);
               $('#mwarga_lama').prop('disabled', true);
               $('#email_lama').prop('readonly', true);
               $('#telepon_lama').prop('readonly', true);
               $('#alamat_lama').prop('readonly', true);
               $('#editid_lama').prop('disabled', false);

               //data di isikan di inputan
               $('#tamu_id_lama').val(data.hasil.tamu_id);
               $('#nama_lengkap_lama').val(data.hasil.nama_lengkap);
               $('#tgl_lahir_lama').val(data.hasil.tgl_lahir);
               $('#id_kerja_lama').val(data.hasil.id_kerja);
               $('#kat_kerja_lama').val(data.hasil.kat_kerja);
               $('#pekerjaan_detil_lama').val(data.hasil.pekerjaan_detil);
               $('#id_mdidik_lama').val(data.hasil.id_mdidik);
               $('#mwarga_lama').val(data.hasil.mwarga);
               $('#email_lama').val(data.hasil.email);
               $('#telepon_lama').val(data.hasil.telepon);
               $('#alamat_lama').val(data.hasil.alamat);
               $('#id_jk_lama').val(data.hasil.id_jk);
               $('#edit_tamu_lama').val(0);

           }
       },
       error: function(){
           alert("error");
       }

   });
       });
       $('#edit_id').click(function(){
           //buka semua inputan
            $('#nama_lengkap').prop('readonly', false);
            $('#id_jk').prop('disabled', false);
            $('#tgl_lahir').prop('readonly', false);
            $('#id_kerja').prop('disabled', false);
            $('#kat_kerja').prop('disabled', false);
            $('#pekerjaan_detil').prop('readonly', false);
            $('#id_mdidik').prop('disabled', false);
            $('#mwarga').prop('disabled', false);
            $('#email').prop('readonly', false);
            $('#telepon').prop('readonly', false);
            $('#alamat').prop('readonly', false);
            $('#edit_tamu').val(1);
       });
       $('#editid_lama').click(function(){
           //buka semua inputan
            $('#nama_lengkap_lama').prop('readonly', false);
            $('#id_jk_lama').prop('disabled', false);
            $('#tgl_lahir_lama').prop('readonly', false);
            $('#id_kerja_lama').prop('disabled', false);
            $('#kat_kerja_lama').prop('disabled', false);
            $('#pekerjaan_detil_lama').prop('readonly', false);
            $('#id_mdidik_lama').prop('disabled', false);
            $('#mwarga_lama').prop('disabled', false);
            $('#email_lama').prop('readonly', false);
            $('#telepon_lama').prop('readonly', false);
            $('#alamat_lama').prop('readonly', false);
            $('#edit_tamu_lama').val(1);
       });
//hapus kunjungan depan
$(".hapuskunjungan").click(function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var nama = $(this).data('nama');
    Swal.fire({
                title: 'Akan dihapus?',
                text: "Data kunjungan "+nama+" akan dihapus permanen",
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
                        url : '{{route('hapus.kunjungan')}}',
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
            $('#ViewModal .modal-body #tamu_alamat').text(data.hasil.alamat)
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

$('#FeedbackModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var tamuid = button.data('tamuid')
    var kunjunganid = button.data('kunjunganid')
    //load dulu transaksinya
    $.ajax({
        url : '{{route("pengunjung.cari","")}}/'+tamuid,
        method : 'get',
        cache: false,
        dataType: 'json',
        success: function(data){
            if (data.status == true)
            {
            $('#FeedbackModal .modal-body #tamu_id').val(tamuid)
            $('#FeedbackModal .modal-body #kunjungan_id').val(kunjunganid)
            $('#FeedbackModal .modal-body #tamu_nama').text(data.hasil.nama_lengkap)
            $('#FeedbackModal .modal-body #tamu_identitas').text(data.hasil.nomor_identitas+' ('+ data.hasil.id_identitas_nama +')')
            $('#FeedbackModal .modal-body #tamu_jk').text(data.hasil.nama_jk)
            $('#FeedbackModal .modal-body #tamu_lahir').text(data.hasil.tgl_lahir_nama)
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

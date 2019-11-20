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

           }
       },
       error: function(){
           alert("error");
       }

   });
       }); 
</script>
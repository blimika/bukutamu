<script>
    //hapus tamu
$(".hapuspengunjung").click(function (e) {
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
</script>
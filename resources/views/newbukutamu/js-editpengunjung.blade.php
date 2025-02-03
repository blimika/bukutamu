<script type="text/javascript">
$('#EditPengunjungModal').on('show.bs.modal', function (event) {
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
                //value
            $('#EditPengunjungModal .modal-body #pengunjung_id').val(d.data.pengunjung_id)
            $('#EditPengunjungModal .modal-body #pengunjung_uid').val(d.data.pengunjung_uid)
            $('#EditPengunjungModal .modal-body #teks_pengunjung_id').text('#'+d.data.pengunjung_id)
            $('#EditPengunjungModal .modal-body #teks_pengunjung_uid').text(d.data.pengunjung_uid)
            $('#EditPengunjungModal .modal-body #pengunjung_nomor_hp').val(d.data.pengunjung_nomor_hp)
            $('#EditPengunjungModal .modal-body #pengunjung_nama').val(d.data.pengunjung_nama)
            $('#EditPengunjungModal .modal-body #pengunjung_jk').val(d.data.pengunjung_jk)
            $('#EditPengunjungModal .modal-body #pengunjung_tahun_lahir').val(d.data.pengunjung_tahun_lahir)
            $('#EditPengunjungModal .modal-body #pengunjung_pekerjaan').val(d.data.pengunjung_pekerjaan)
            $('#EditPengunjungModal .modal-body #pengunjung_pendidikan').val(d.data.pengunjung_pendidikan)
            $('#EditPengunjungModal .modal-footer #kunjungan_timeline').attr("href","{{route('tamu.detil','')}}/"+d.data.kunjungan_uid)
            $('#EditPengunjungModal .modal-body #pengunjung_email').val(d.data.pengunjung_email)

            $('#EditPengunjungModal .modal-body #pengunjung_alamat').val(d.data.pengunjung_alamat)
            }
            else
            {
                Swal.fire(
                    'Error!',
                    '' + data.message + '',
                    'error'
                );
            }
        },
        error: function(){
            Swal.fire(
                    'Error!',
                    'koneksi error',
                    'error'
                );
        }

    });
});
</script>

<script>
$('#HapusDataModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var kid = button.data('kid')
  $.ajax({
        url : '{{route("getdatakunjungan","")}}/'+kid,
        method : 'get',
        cache: false,
        dataType: 'json',
        success: function(data){
            if (data.status==false) {
              //kalo data tidak ada
            }
            else {
                $('#HapusDataModal .modal-body #hapus_tanggal').text(data.hasil.tanggal)
                $('#HapusDataModal .modal-body #hapus_nama').text(data.hasil.tamu.nama_lengkap)
            }

        },
        error: function(){
            alert("error");
        }

    });
})
</script>
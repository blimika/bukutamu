<script>
$('#KaitkanModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var kaitkan_id = button.data('id')
    var kaitkan_username = button.data('username')
    var kaitkan_nama = button.data('nama')
    $('#KaitkanModal .modal-body #kaitkan_nama').text(kaitkan_nama);
    $('#KaitkanModal .modal-body #kaitkan_username').text(kaitkan_username);
    $('#KaitkanModal .modal-body #kaitkan_id').val(kaitkan_id);
    $('#KaitkanModal .modal-body #kaitkan_id_teks').text('#'+kaitkan_id);
});
</script>

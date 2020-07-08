<div class="modal fade" id="modalConfirmBookDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-notify modal-danger " role="document">
    <div class="modal-content text-center">
      <div class="modal-header text-center d-flex justify-content-center">
        <p class="heading">Apakah anda yakin?</p>
      </div>
      <div class="modal-footer flex-center">
        <span><a class="btn btn-outline-danger" id="btn-buku-confirm-delete"><i class="fas fa-check fa-lg mr-1"></i>Ya, buang</a></span>
        <a type="button" class="btn btn-danger waves-effect" data-dismiss="modal"><i class="fas fa-times fa-lg mr-1"></i>Tidak</a>
      </div>
    </div>
  </div>
</div>


<script>

  $('#btn-buku-confirm-delete').on('click', function() {

    var value = {
      no_barcode: interactedRowIdentifier
    }

    showButtonLoading('#btn-buku-confirm-delete')
    $.post("<?php echo site_url('book/delete') ?>", value)
      .done(function() {
        $('#modalConfirmBookDelete').modal('hide')
        hideButtonLoading('#btn-buku-confirm-delete', 'Ya, buang', 'fa-check')
        getBooks()
      })
      .fail(function(e, status, thrown) {
        if (e.status != 500) {
          $('#server-failed').modal('show');
        } else {
          $('#edit-failed').modal('show');
        }
        hideButtonLoading('#btn-buku-confirm-delete', 'Ya, buang', 'fa-check')
      })

  })
</script>
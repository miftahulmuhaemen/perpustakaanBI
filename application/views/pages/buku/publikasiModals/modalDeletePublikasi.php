<div class="modal fade" id="modalConfirmPublicationDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-notify modal-danger " role="document">
    <div class="modal-content text-center">
      <div class="modal-header text-center d-flex justify-content-center">
        <p class="heading">Apakah anda yakin?</p>
      </div>
      <div class="modal-footer flex-center">
        <span><a class="btn btn-outline-danger" id="btn-publikasi-confirm-delete"><i class="fas fa-check fa-lg mr-1"></i>Ya, buang</a></span>
        <a type="button" class="btn btn-danger waves-effect" data-dismiss="modal"><i class="fas fa-times fa-lg mr-1"></i>Tidak</a>
      </div>
    </div>
  </div>
</div>


<script>

  $('#btn-publikasi-confirm-delete').on('click', function() {

    var value = {
      id_publikasi: interactedRowIdentifier
    }

    showButtonLoading('#btn-publikasi-confirm-delete')
    $.post("<?php echo site_url('publication/delete') ?>", value)
      .done(function() {
        $('#modalConfirmPublicationDelete').modal('hide')
        hideButtonLoading('#btn-publikasi-confirm-delete', 'Ya, buang', 'fa-check')
        getPublications()
      })
      .fail(function(e, status, thrown) {
        if (e.status != 500) {
          $('#server-failed').modal('show');
        } else {
          $('#edit-failed').modal('show');
        }
        hideButtonLoading('#btn-publikasi-confirm-delete', 'Ya, buang', 'fa-check')
      })

  })
</script>
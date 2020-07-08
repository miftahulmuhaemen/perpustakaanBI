<form class="was-validated" novalidate>
  <div class="modal fade" id="modalEditPublikasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-info modal-notify " role="document">
      <div class="modal-content">
        <div class="modal-header white-text text-center">
          <h4 class="modal-title w-100 font-weight-bold" id="myModalLabel">Perubahan</h4>
          <button class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="white-text">&times;</span>
          </button>
        </div>
        <div class="modal-body container">

          <div class="row">
            <div class="col">
              <label>Tanggal Terbit</label>
              <input type="date" class="form-control" id="tgl_terbit-publikasi-edit" required>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <label>Tanggal Periksa</label>
              <input type="date" class="form-control" id="tgl_periksa-publikasi-edit" required>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <label>Status</label>
              <input type="text" class="form-control" id="status-publikasi-edit">
            </div>
          </div>

          <div class="row">
            <div class="col">
              <label for="judul">Judul</label>
              <input type="text" type="text" class="form-control" id="judul-publikasi-edit" required>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <label>Edisi</label>
              <input type="text" class="form-control" id="edisi-publikasi-edit" required>
            </div>
          </div>

        </div>
        <div class="modal-footer d-flex justify-content-right">
          <button data-dismiss="modal" data-toggle="modal" data-target="#modalConfirmPublicationDelete" class="btn btn-danger" type="button" id="btn-publikasi-delete"><i class="far fa-trash-alt mr-1 fa-lg"></i>Buang</button>
          <button class="btn btn-primary" type="button" id="btn-publikasi-update"><i class="fas fa-edit mr-1 fa-lg"></i>Ubah</button>
        </div>
      </div>
    </div>
  </div>
</form>
<script>
  $('#modalEditPublikasi').on('show.bs.modal', function(event) {

    var button = $(event.relatedTarget)
    interactedRowIdentifier = button.data('id_publikasi')

    $('#btn-publikasi-delete').attr("data-id_publikasi", interactedRowIdentifier)
    $('#judul-publikasi-edit').val(button.data('judul'))
    $('#edisi-publikasi-edit').val(button.data('edisi'))
    $('#tgl_terbit-publikasi-edit').val(button.data('tgl_terbit'))
    $('#tgl_periksa-publikasi-edit').val(button.data('tgl_periksa'))
    $('#status-publikasi-edit').val(button.data('status'))

  })
</script>
<script>
  (function() {
    window.addEventListener('load', function() {
      var forms = document.getElementsByClassName('was-validated');
      var validation = Array.prototype.filter.call(forms, function(form) {

        $('#btn-publikasi-update').on('click', function() {

          if (form.checkValidity() === false) {

            event.preventDefault();
            event.stopPropagation();

          } else {

            var value = {
              id_publikasi: interactedRowIdentifier,
              judul: $('#judul-publikasi-edit').val(),
              edisi: $('#edisi-publikasi-edit').val(),
              tgl_terbit: $('#tgl_terbit-publikasi-edit').val(),
              tgl_periksa: $('#tgl_periksa-publikasi-edit').val(),
              status: $('#status-publikasi-edit').val()
            }

            showButtonLoading('#btn-publikasi-update')
            $.post("<?php echo site_url('publication/update') ?>", value)
              .done(function() {
                hideButtonLoading('#btn-publikasi-update', 'Ubah', 'fa-edit')
                getPublications()
              })
              .fail(function(e, status, thrown) {
                if (e.status != 500) {
                  $('#server-failed').modal('show');
                } else {
                  $('#edit-failed').modal('show');
                }
                hideButtonLoading('#btn-publikasi-update', 'Ubah', 'fa-edit')
              })

            $('#modalEditPublikasi').modal('hide');

          }
        });
      });
    }, false);
  })();
</script>
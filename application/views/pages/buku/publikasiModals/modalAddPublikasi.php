<form class="was-validated" novalidate>
  <div class="modal fade" id="modalAddPublikasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-info modal-notify " role="document">
      <div class="modal-content">
        <div class="modal-header white-text text-center">
          <h4 class="modal-title w-100 font-weight-bold">Tambah</h4>
          <button class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="white-text">&times;</span>
          </button>
        </div>
        <div class="modal-body container">

          <div class="row">
            <div class="col">
              <label>Tanggal Terbit</label>
              <input type="date" class="form-control" id="tgl_terbit-publikasi-add" required>
            </div>
            <div class="col">
              <label>Tanggal Periksa</label>
              <input type="date" class="form-control" id="tgl_periksa-publikasi-add" required>
            </div>
          </div>
          
          <div class="row">
            <div class="col">
              <label>Status</label>
              <input type="text" class="form-control" id="status-publikasi-add" required>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <label for="judul">Judul</label>
              <input type="text" type="text" class="form-control" id="judul-publikasi-add" required>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <label>Edisi</label>
              <input type="text" class="form-control" id="edisi-publikasi-add" required>
            </div>
          </div>

        </div>
        <div class="modal-footer d-flex justify-content-right">
          <button class="btn btn-primary" type="button" id="btn-publikasi-add"><i class="fas fa-plus mr-1 fa-lg"></i>Tambah</button>
        </div>
      </div>
    </div>
  </div>
</form>

<script>
  (function() {
    window.addEventListener('load', function() {
      var forms = document.getElementsByClassName('was-validated');
      var validation = Array.prototype.filter.call(forms, function(form) {

        $('#btn-publikasi-add').on('click', function() {

          if (form.checkValidity() === false) {

            event.preventDefault();
            event.stopPropagation();

          } else {

            var value = {
              judul: $('#judul-publikasi-add').val(),
              edisi: $('#edisi-publikasi-add').val(),
              tgl_terbit: $('#tgl_terbit-publikasi-add').val(),
              tgl_periksa: $('#tgl_periksa-publikasi-add').val(),
              status: $('#status-publikasi-add').val()
            }

            showButtonLoading('#btn-publikasi-add')
            $.post("<?php echo site_url('publication/insert') ?>", value)
              .done(function() {
                hideButtonLoading('#btn-publikasi-add', 'Tambah', 'fa-plus')
                getBooks()
              })
              .fail(function(e, status, thrown) {
                if (e.status != 500) {
                  $('#server-failed').modal('show');
                } else {
                  $('#add-failed').modal('show');
                }
                hideButtonLoading('#btn-publikasi-add', 'Tambah', 'fa-plus')
              })

            $('#modalAddPublikasi').modal('hide');
            $('#judul-publikasi-add, #registrasi-publikasi-add, #no-barcode-publikasi-add, #klasifikasi-publikasi-add, #edisi-publikasi-add, #tgl_terbit-publikasi-add, #tgl_periksa-publikasi-add, #status-publikasi-add').val('')

          }
        });
      });
    }, false);
  })();
</script>
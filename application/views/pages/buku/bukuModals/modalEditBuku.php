<form class="was-validated" novalidate>
  <div class="modal fade" id="modalEditBuku" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-info modal-notify " role="document">
      <div class="modal-content">
        <div class="modal-header white-text text-center">
          <h4 class="modal-title w-100 font-weight-bold" id="myModalLabel">Perubahan</h4>
          <button class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="white-text">&times;</span>
          </button>
        </div>
        <div class="modal-body container">

          <div class="row mb-3">
            <div class="col">
              <label>Nomor Barcode</label>
              <input onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text" class="form-control" id="no-barcode-buku-edit" required>
            </div>

            <div class="col">
              <label>Klasifikasi</label>
              <input type="text" class="form-control" id="klasifikasi-buku-edit" required>
            </div>

            <div class="col">
              <label>Nomor Reg.</label>
              <input onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text" class="form-control" id="registrasi-buku-edit" required>
            </div>

          </div>

          <div class="row mb-3">
            <div class="col">
              <label>Tahun</label>
              <input onkeypress="return event.charCode >= 48 && event.charCode <= 57"  class="form-control yearpicker" id="tahun-buku-edit" required></input>
            </div>

            <div class="col">
              <label>Jumlah</label>
              <input onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text" class="form-control" id="jumlah-buku-edit" required>
            </div>

            <div class="col">
              <label>Lokasi</label>
              <input onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text" class="form-control" id="lokasi-buku-edit" required>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col">
              <label for="judul">Judul</label>
              <input type="text" type="text" class="form-control" id="judul-buku-edit" required>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col">
              <label>Pengarang</label>
              <input type="text" class="form-control" id="pengarang-buku-edit" required>
            </div>
          </div>

        </div>
        <div class="modal-footer d-flex justify-content-right">
          <button data-dismiss="modal" data-toggle="modal" data-target="#modalConfirmBookDelete" class="btn btn-danger" type="button" id="btn-buku-delete"><i class="far fa-trash-alt mr-1 fa-lg"></i>Buang</button>
          <button class="btn btn-primary" type="button" id="btn-buku-update"><i class="fas fa-edit mr-1 fa-lg"></i>Ubah</button>
        </div>
      </div>
    </div>
  </div>
</form>
<script>
  $('#modalEditBuku').on('show.bs.modal', function(event) {

    var button = $(event.relatedTarget)
    interactedRowIdentifier = button.data('no_barcode')

    $('#judul-buku-edit').val(button.data('judul'))
    $('#pengarang-buku-edit').val(button.data('pengarang'))
    $('#tahun-buku-edit').val(button.data('tahun'))
    $('#jumlah-buku-edit').val(button.data('jumlah'))
    $('#lokasi-buku-edit').val(button.data('lokasi'))
    $('#klasifikasi-buku-edit').val(button.data('klasifikasi'))
    $('#no-barcode-buku-edit').val(button.data('no_barcode'))
    $('#registrasi-buku-edit').val(button.data('no_register'))

  })
</script>
<script>
  (function() {
    window.addEventListener('load', function() {
      var forms = document.getElementsByClassName('was-validated');
      var validation = Array.prototype.filter.call(forms, function(form) {

        $('#btn-buku-update').on('click', function() {

          if (form.checkValidity() === false) {

            event.preventDefault();
            event.stopPropagation();

          } else {

            var value = {
              originalBarcode: interactedRowIdentifier,
              judul: $('#judul-buku-edit').val(),
              pengarang: $('#pengarang-buku-edit').val(),
              tahun: $('#tahun-buku-edit').val(),
              jumlah: $('#jumlah-buku-edit').val(),
              lokasi: $('#lokasi-buku-edit').val(),
              klasifikasi: $('#klasifikasi-buku-edit').val(),
              no_barcode: $('#no-barcode-buku-edit').val(),
              no_register: $('#registrasi-buku-edit').val()
            }

            showButtonLoading('#btn-buku-update')
            $.post("<?php echo site_url('book/update') ?>", value)
              .done(function() {
                hideButtonLoading('#btn-buku-update', 'Ubah', 'fa-edit')
                getBooks()
              })
              .fail(function(e, status, thrown) {
                if (e.status != 500) {
                  $('#server-failed').modal('show');
                } else {
                  $('#edit-failed').modal('show');
                }
                hideButtonLoading('#btn-buku-update', 'Ubah', 'fa-edit')
              })

            $('#modalEditBuku').modal('hide');

          }
        });
      });
    }, false);
  })();
</script>

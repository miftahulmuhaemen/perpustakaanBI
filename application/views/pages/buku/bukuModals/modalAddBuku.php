<form class="was-validated" novalidate>
  <div class="modal fade" id="modalAddBuku" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog   " role="document">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Tambah Buku</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>

        <div class="modal-body container">

          <div class="row mb-3">
            <div class="col">
              <label>Nomor Barcode</label>
              <input onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text" class="form-control" id="no-barcode-buku-add" required>
            </div>

            <div class="col">
              <label>Klasifikasi</label>
              <input type="text" class="form-control" id="klasifikasi-buku-add" required>
            </div>

            <div class="col">
              <label>Nomor Reg.</label>
              <input onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text" class="form-control" id="registrasi-buku-add" required>
            </div>

          </div>

          <div class="row mb-3">
            <div class="col">
              <label>Tahun</label>
              <input minlength="4" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text" class="form-control" id="tahun-buku-add" required>
            </div>

            <div class="col">
              <label>Jumlah</label>
              <input onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text" class="form-control" id="jumlah-buku-add" required>
            </div>

            <div class="col">
              <label>Lokasi</label>
              <input onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text" class="form-control" id="lokasi-buku-add" required>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col">
              <label for="judul">Judul</label>
              <input type="text" type="text" class="form-control" id="judul-buku-add" required>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col">
              <label>Pengarang</label>
              <input type="text" class="form-control" id="pengarang-buku-add" required>
            </div>
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-right">
          <button class="btn mauve text-white" type="button" id="btn-buku-add"><i class="fas fa-plus mr-1 fa-lg"></i>Tambah</button>
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

        $('#btn-buku-add').on('click', function() {

          if (form.checkValidity() === false) {

            event.preventDefault();
            event.stopPropagation();

          } else {

            var value = {
              judul: $('#judul-buku-add').val(),
              pengarang: $('#pengarang-buku-add').val(),
              tahun: $('#tahun-buku-add').val(),
              jumlah: $('#jumlah-buku-add').val(),
              lokasi: $('#lokasi-buku-add').val(),
              klasifikasi: $('#klasifikasi-buku-add').val(),
              no_barcode: $('#no-barcode-buku-add').val(),
              no_register: $('#registrasi-buku-add').val()
            }

            showButtonLoading('#btn-buku-add')
            $.post("<?php echo site_url('book/insert') ?>", value)
              .done(function() {
                hideButtonLoading('#btn-buku-add', 'Tambah', 'fa-plus')
                getBooks()
              })
              .fail(function(e, status, thrown) {
                if (e.status != 500) {
                  $('#server-failed').modal('show');
                } else {
                  $('#add-failed').modal('show');
                }
                hideButtonLoading('#btn-buku-add', 'Tambah', 'fa-plus')
              })

            $('#modalAddBuku').modal('hide');
            $('#judul-buku-add, #registrasi-buku-add, #no-barcode-buku-add, #klasifikasi-buku-add, #pengarang-buku-add, #tahun-buku-add, #jumlah-buku-add, #lokasi-buku-add').val('')

          }
        });
      });
    }, false);
  })();
</script>
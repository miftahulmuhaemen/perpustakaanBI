<?php if (isset($data_buku[1])&&$data_buku[1]==0) redirect(base_url('peminjaman'));?>
<div class="container">
  <!--Section: Content-->
  <section class="text-center dark-grey-text">
    <!-- Grid row -->
    <div class="row">

      <!-- Grid column -->
      <div class="col-lg-4 col-md-12 mb-4">

				<p></p>
				<a href="?tab=pinjam" class="w-100 btn btn-outline-white rounded-lg">Lihat</a>
				<span class="counter counter-lg"><?php if(isset($data_buku[1])) echo $data_buku[1]; else echo 0 ?></span>

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-lg-4 col-md-6 mb-4">

        <!-- Card -->
        <div class="card blood-rose">

          <!-- Content -->
          <div class="card-body white-text">

            <!-- Offer -->
            <h5 class="mb-4">Sedang Dipinjam</h5>

            <!--Price -->
            <h2 class="font-weight-bold my-4"><?php if(isset($data_buku[2])) echo $data_buku[2]; else echo 0 ?></h2>
            <p></p>
            <a href="?tab=dipinjam" class="btn btn-outline-white rounded-lg">Lihat</a>

          </div>
          <!-- Content -->

        </div>
        <!-- Card -->

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-lg-4 col-md-6 mb-4">

        <!-- Card -->
        <div class="card blood-rose">

          <!-- Content -->
          <div class="card-body text-white">

            <!-- Offer -->
            <h5 class="mb-4">Sudah Dikembalikan</h5>

            <!--Price -->
            <h2 class="font-weight-bold my-4"><?php if(isset($data_buku[3])) echo $data_buku[3]; else echo 0 ?></h2>
            <p></p>
            <a href="?tab=kembali" class="btn btn-outline-white rounded-lg">Lihat</a>

          </div>
          <!-- Content -->

        </div>
        <!-- Card -->

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </section>
  <!--Section: Content-->


</div>

<?php if ($this->input->get('tab')=="pinjam")$this->load->view('pages/admin/peminjaman/tab/pinjam.php')?>
<?php if ($this->input->get('tab')=="dipinjam")$this->load->view('pages/admin/peminjaman/tab/in-pinjam.php')?>
<?php if ($this->input->get('tab')=="kembali")$this->load->view('pages/admin/peminjaman/tab/kembali.php')?>

<script>

    $(window).on('load',function(){
        $('#sukses').modal('show');
    });

function myFunction() {
document.getElementById("myDropdown").classList.toggle("show");
}

function filterFunction() {
var input, filter, ul, li, a, i;
input = document.getElementById("myInput");
filter = input.value.toUpperCase();
div = document.getElementById("myDropdown");
a = div.getElementsByTagName("a");
for (i = 0; i < a.length; i++) {
	txtValue = a[i].textContent || a[i].innerText;
	if (txtValue.toUpperCase().indexOf(filter) > -1) {
		a[i].style.display = "";
	} else {
		a[i].style.display = "none";
	}
}
}
</script>

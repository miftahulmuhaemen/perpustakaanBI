<div class="container my-5 px-0">


	<!-- Central Modal Medium Success -->
	<div>
		<div class="modal-dialog modal-notify modal-success" role="document">
			<!--Content-->
			<div class="modal-content">
				<!--Header-->
				<div class="modal-header">
					<p class="heading lead">Konfirmasi Peminjaman</p>

				</div>

				<!--Body-->
				<div class="modal-body">
					<div class="text-center">
						<p>Pinjam Buku "<?php echo $buku[0]->judul ?>"?</p>
					</div>
				</div>

				<!--Footer-->
				<div class="modal-footer justify-content-center">
					<a onclick="goBack()" class="btn btn-outline-red waves-effect" data-dismiss="modal">No, thanks</a>
					<a href="<?php echo base_url('buku/tambah')."?id=".$this->input->get('id'); ?>" class="btn btn-success">Yes</a>
				</div>
			</div>
			<!--/.Content-->
		</div>
	</div>


</div>
<script>
function goBack() {
  window.history.back();
}
</script>

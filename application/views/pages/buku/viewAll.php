<style media="screen">
	.label {
		display: inline-block;
		margin-bottom: .5rem;
	}

	.page-item {
		cursor: pointer;
	}

	@media (max-width: 991px) {
		.nama {
			color: #fff;
			background-color: rgba(3, 169, 244, 0.7);
			margin-top: -30px;
			margin-bottom: 10px;
			padding: 0.25rem;
			-webkit-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12) !important;
			box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12) !important;
		}

		.btn-edit {
			color: #fff;
			margin-top: -180px;
			background-color: rgba(63, 81, 181, 0.7);
		}

		.header {
			visibility: hidden;
			height: 0px;
		}

		.user-view {
			padding-top: 1rem;
			background-color: white;
			-webkit-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12) !important;
			box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12) !important;
		}

		.data-show {
			visibility: collapse;
		}
	}

	@media (min-width: 992px) {
		.rgba-blue-strong .rounded {
			background-color: white;
		}

		.icon {
			visibility: collapse;
			width: 0px;
			height: 0px;
		}

		.kelolaUser {
			background-color: white;
			-webkit-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12) !important;
			box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12) !important;
		}
	}
</style>
<?php if (isset($buku) && sizeof($buku) > 0) : ?>
	<div class="row">
		<div class="container my-3 px-3">
			<div class="white round-10 p-0" style="display:flex">
				<div class="col-0 col-md-3 m-0 p-0">
				</div>
				<div class="col-md-6 mx-auto my-0">
					<nav aria-label="Page navigation example">
						<ul class="white pagination pg-indigo d-flex my-0 pt-1 align-items-center">
							<?php
							$p = $this->input->get('p');

							if (!isset($p)) {
								$p = 1;
							}

							if (($total_data) % $limit > 0) {
								$mod = 1;
							} else {
								$mod = 0;
							}
							?>
							<li class="page-item ml-auto <?php if ($p == 1) echo "disabled"; ?>">
								<a href="cari-buku?keyword=<?php echo $keyword; ?>&p=1<?php if ($this->input->get('limit') != null) echo "&limit=" . $this->input->get('limit'); ?>" class="page-link" tabindex="-1">First</a>
							</li>
							<li class="page-item <?php if ($p == 1) echo "disabled"; ?>">
								<a href="cari-buku?keyword=<?php echo $keyword; ?>&p=<?php echo ($p - 1); ?><?php if ($this->input->get('limit') != null) echo "&limit=" . $this->input->get('limit'); ?>" class="page-link" tabindex="-1">Previous</a>
							</li><?php
									for ($i = -3; $i < 2; $i++) {
										if ((($total_data) - ($total_data) % $limit) / $limit + $mod == $p + $i) {
											break;
										}
										if ($p + $i >= 0) : ?>
									<li class="page-item <?php if ($p + $i + 1 == $p) : ?> active<?php else : ?>data-show <?php endif; ?>">
										<a <?php if ($p + $i + 1 != $p) : ?>href="cari-buku?keyword=<?php echo $keyword; ?>&p=<?php echo ($p + $i + 1); ?><?php if ($this->input->get('limit') != null) echo "&limit=" . $this->input->get('limit'); ?>" <?php endif; ?> class="page-link"><?php echo ($p + $i + 1); ?> <span class="sr-only"></span></a>
									</li>
							<?php endif;
									} ?>
							<?php
							?>
							<li class="page-item <?php if ((($total_data) - ($total_data) % $limit) / $limit + $mod == $p) echo "disabled"; ?>">
								<a href="cari-buku?keyword=<?php echo $keyword; ?>&p=<?php echo ($p + 1); ?><?php if ($this->input->get('limit') != null) echo "&limit=" . $this->input->get('limit'); ?>" class="page-link">Next</a>
							</li>
							<li class="page-item mr-auto <?php if ((($total_data) - ($total_data) % $limit) / $limit + 1 == $p) echo "disabled"; ?>">
								<a href="cari-buku?keyword=<?php echo $keyword; ?>&p=<?php echo (($total_data) - ($total_data) % $limit) / $limit + $mod; ?><?php if ($this->input->get('limit') != null) echo "&limit=" . $this->input->get('limit'); ?>" class="page-link" tabindex="-1">Last</a>
							</li>
							<?php ?>
						</ul>
					</nav>
				</div>
				<div class="col-12 col-md-3 col-lg-3 text-right m-auto data-show">
					<div class="dataTables_length bs-select pt-1">
						Show
						<label class="mb-1">
							<select id="limit" onchange="myFunction(this.value)" class="custom-select custom-select-sm form-control form-control-sm" value="11">
								<option value="10">10</option>
								<option value="25">25</option>
								<option value="50">50</option>
								<option value="100">100</option>
							</select>
						</label>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="kelolaUser rounded-lg px-3 pb-2 container">
		<div class="row pt-2 header">
			<div class="col-lg-3">
				Judul
			</div>
			<div class="col-lg-3">
				Pengarang
			</div>
			<div class="col-lg-1">
				Tahun
			</div>
			<div class="col-lg-3">
				Klasifikasi
			</div>
			<div class="col-lg-2">
			</div>
		</div>
		<div class="header py-2">
			<hr style="border-width:2px;border-color:black;margin:0px -1rem">
		</div>
		<?php foreach ($buku as $key => $value) : ?>
			<div class="row user-view rounded-lg d-flex align-items-center mb-5">
				<div class="col">
					<div class="rgba-blue-strong rounded">
						<div class="nama rounded">
							<?php echo ucwords(strtolower($value->judul)); ?><br>
						</div>
					</div>
					<div class="col-12 icon">

					</div>

					<p class="small text-muted mb-0">No. Barcode : <?php echo $value->no_barcode ?></p>
				</div>
				<div class="col-lg-3">
					<i class="icon fa fa-lg fa-pen"></i>&nbsp
					<?php echo $value->pengarang; ?>
				</div>
				<div class="col-lg-1 d-flex align-items-center">
					<i class="icon fa fa-lg fa-calendar"> </i>&nbsp
					<?php echo $value->tahun; ?>
				</div>
				<div class="col-lg-3 d-flex align-items-center">
					<i class="icon fa fa-lg fa-hashtag"> </i>&nbsp
					<small><?php echo $value->klasifikasi; ?></small>
				</div>
				<div class="col-lg-2 text-right" style="min-width:180px">
					<?php if ($this->session->userdata('level') == 5 && $this->session->userdata('status') == 1) : ?>
						<?php

						if (
							isset($pinjam[$value->no_barcode]->status)
							&& ($pinjam[$value->no_barcode]->status == 0
							|| $pinjam[$value->no_barcode]->status == 3)
						) {
						?><a href="buku\pinjam?id=<?php echo encrypt_url($value->no_barcode); ?>"> <button type="button" name="button" class=" white-text btn rgba-indigo-strong p-2"> Pinjam </button> </a>
						<?php
						} else if (!isset($pinjam[$value->no_barcode]->status)) {
						?><a href="buku\pinjam?id=<?php echo encrypt_url($value->no_barcode); ?>"> <button type="button" name="button" class=" white-text btn rgba-indigo-strong p-2"> Pinjam </button> </a><?php
																																																																																														} ?>
					<?php endif; ?>
					<a href="buku?id=<?php echo encrypt_url($value->no_barcode); ?>"> <button type="button" name="button" class=" white-text btn rgba-blue-strong p-2"> Lihat </button> </a>
				</div>
			</div>
		<?php endforeach; ?>
	</div>

	<div class="row mt-1">
		<div class="container px-auto my-3">
			<div class="row ">
				<div class="col-md-12 m-auto">
					<nav aria-label="Page navigation example">
						<ul class="white pagination pg-indigo d-flex  pt-1 align-items-center">
							<?php
							$p = $this->input->get('p');

							if (!isset($p)) {
								$p = 1;
							}

							if (($total_data) % $limit > 0) {
								$mod = 1;
							} else {
								$mod = 0;
							}
							?>
							<li class="page-item ml-auto <?php if ($p == 1) echo "disabled"; ?>">
								<a href="cari-buku?keyword=<?php echo $keyword; ?>&p=1<?php if ($this->input->get('limit') != null) echo "&limit=" . $this->input->get('limit'); ?>" class="page-link" tabindex="-1">First</a>
							</li>
							<li class="page-item <?php if ($p == 1) echo "disabled"; ?>">
								<a href="cari-buku?keyword=<?php echo $keyword; ?>&p=<?php echo ($p - 1); ?><?php if ($this->input->get('limit') != null) echo "&limit=" . $this->input->get('limit'); ?>" class="page-link" tabindex="-1">Previous</a>
							</li><?php
									for ($i = -3; $i < 2; $i++) {
										if ((($total_data) - ($total_data) % $limit) / $limit + $mod == $p + $i) {
											break;
										}
										if ($p + $i >= 0) : ?>
									<li class="page-item <?php if ($p + $i + 1 == $p) : ?> active <?php else : ?>data-show<?php endif; ?>">
										<a <?php if ($p + $i + 1 != $p) : ?>href="cari-buku?keyword=<?php echo $keyword; ?>&p=<?php echo ($p + $i + 1); ?><?php if ($this->input->get('limit') != null) echo "&limit=" . $this->input->get('limit'); ?>" <?php endif; ?> class="page-link"><?php echo ($p + $i + 1); ?> <span class="sr-only"></span></a>
									</li>
							<?php endif;
									} ?>
							<?php
							?>
							<li class="page-item <?php if ((($total_data) - ($total_data) % $limit) / $limit + $mod == $p) echo "disabled"; ?>">
								<a href="cari-buku?keyword=<?php echo $keyword; ?>&p=<?php echo ($p + 1); ?><?php if ($this->input->get('limit') != null) echo "&limit=" . $this->input->get('limit'); ?>" class="page-link">Next</a>
							</li>
							<li class="page-item mr-auto <?php if ((($total_data) - ($total_data) % $limit) / $limit + 1 == $p) echo "disabled"; ?>">
								<a href="cari-buku?keyword=<?php echo $keyword; ?>&p=<?php echo (($total_data) - ($total_data) % $limit) / $limit + $mod; ?><?php if ($this->input->get('limit') != null) echo "&limit=" . $this->input->get('limit'); ?>" class="page-link" tabindex="-1">Last</a>
							</li>
							<?php ?>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>

	<script>
		$("#limit").val(<?php echo $this->input->get('limit'); ?>);

		function myFunction(val) {
			window.location.href = "<?php echo base_url('cari-buku?') ?>keyword=<?php echo $keyword; ?>&p=1&limit=" + val;
		}
	</script>
<?php endif; ?>




<?php if (isset($buku) && sizeof($buku) == 0) {
	include 'not_found.php';
} ?>
<div class="mb-4">
	<div class="container">
		<form class action="<?php echo base_url('anggota') ?>" method="get" id="form_agt">
			<div class="row white rounded-lg z-depth-1 px-2 mb-3">
				<div class="col pr-0">
					<div class="w-100 md-form active-pink active-pink-2 my-0">
						<input autofocus name="keyword" value="<?php if ($this->input->get('keyword') != "") echo $this->input->get('keyword'); ?>" class="form-control" type="text" placeholder="Search" aria-label="Search">
					</div>
				</div>
				<button type="submit" class="btn z-depth-0 p-1 pt-2 px-2">
					<i class="text-primary fas fa-2x fa-search fa-rotate-270"></i>
				</button>
			</div>
			<div class="row white z-depth-1 p-2 rounded-lg mb-3">
				<?php
				$cek = array('nama' => '', 'Id_anggota' => '', 'email' => '', 'instansi' => '');
				foreach ($data['field'] as $key => $value) {
					$cek[$value] = "checked";
				}
				?>

				<div class="custom-control custom-checkbox custom-control-inline">
					<input <?php echo $cek['nama'] ?> value="nama" name="search_field[]" type="checkbox" class="custom-control-input" id="defaultInline1">
					<label class="custom-control-label" for="defaultInline1">Nama</label>
				</div>

				<!-- Default inline 2-->
				<div class="custom-control custom-checkbox custom-control-inline">
					<input <?php echo $cek['Id_anggota'] ?> value="Id_anggota" name="search_field[]" type="checkbox" class="custom-control-input" id="defaultInline2">
					<label class="custom-control-label" for="defaultInline2">Id_anggota</label>
				</div>

				<!-- Default inline 3-->
				<div class="custom-control custom-checkbox custom-control-inline">
					<input <?php echo $cek['email'] ?> value="email" name="search_field[]" type="checkbox" class="custom-control-input" id="defaultInline3">
					<label class="custom-control-label" for="defaultInline3">E-mail</label>
				</div>

				<!-- Default inline 3-->
				<div class="custom-control custom-checkbox custom-control-inline">
					<input <?php echo $cek['instansi'] ?> value="instansi" name="search_field[]" type="checkbox" class="custom-control-input" id="defaultInline4">
					<label class="custom-control-label" for="defaultInline4">Instansi</label>
				</div>
			</div>
		</form>
	</div>
	<div class="kelolaUser rounded-lg px-3 pb-2 container">
		<div class="row pt-2 header">
			<div class="col-lg-3">
				User
			</div>
			<div class="col-lg-4">
				E-Mail
			</div>
			<div class="col-lg-3">
				Instansi
			</div>
			<div class="col-lg-2">
			</div>
		</div>
		<div class="header py-2">
			<hr style="border-width:2px;border-color:black;margin:0px -1rem">
		</div>
		<?php foreach ($data['User'] as $key => $value) : ?>
			<div class="row user-view rounded-lg mb-4 d-flex align-items-center mb-3">
				<div class="col-lg-3">
					<div class="nama rounded font-weight-bold">
						<?php echo ucwords(strtolower($value->nama)); ?><br>
					</div>

					<p class="small text-muted mb-0"><?php echo $value->Id_anggota ?></p>
				</div>
				<div class="col-lg-4">
					<i class="icon fa fa-lg fa-envelope"></i>
					<?php
					if ($value->email != "")
						echo $value->email;
					else
						echo "-";
					?>
				</div>
				<div class="col-lg-3 d-flex align-items-center">
					<i class="icon fa fa-lg fa-building"></i><?php echo $value->instansi; ?>
				</div>
				<div class="col-lg-2 text-right">
					<!-- <input type="hidden" value="<?php echo $value->Id; ?>" id="idAng"/> -->
					<a class="btn btn-edit btn-success" type="button" data-id="<?php echo $value->Id; ?>" id="updateAng"><i class="fas fa-check"></i>&nbsp;&nbsp;&nbsp;Setujui</a>
				</div>

			</div>
		<?php endforeach; ?>
	</div>
	<?php if ($data['totalUser'] > 10) : ?>

		<div class="white z-depth-1 rounded-lg container">
			<div class="col m-auto">
				<nav aria-label="Page navigation example">
					<ul class="pagination pg-indigo d-flex mt-3 pt-1 align-items-center">
						<?php
						$keyword = $data['keyword'];
						$p = $this->input->get('p');
						$limit = 10;
						if (!isset($p)) {
							$p = 1;
						}

						if (($data['totalUser']) % $limit > 0) {
							$mod = 1;
						} else {
							$mod = 0;
						}
						?>
						<li class="page-item ml-auto <?php if ($p == 1) echo "disabled"; ?>">
							<a href="kelola-user?keyword=<?php echo $keyword; ?>&p=1<?php if ($this->input->get('limit') != null) echo "&limit=" . $this->input->get('limit'); ?>" class="page-link" tabindex="-1">First</a>
						</li>
						<li class="page-item <?php if ($p == 1) echo "disabled"; ?>">
							<a href="kelola-user?keyword=<?php echo $keyword; ?>&p=<?php echo ($p - 1); ?><?php if ($this->input->get('limit') != null) echo "&limit=" . $this->input->get('limit'); ?>" class="page-link" tabindex="-1">Previous</a>
						</li><?php
								for ($i = -3; $i < 2; $i++) {
									if ((($data['totalUser']) - ($data['totalUser']) % $limit) / $limit + $mod == $p + $i) {
										break;
									}
									if ($p + $i >= 0) : ?>
								<li class="page-item <?php if ($p + $i + 1 == $p) : ?> active <?php endif; ?>">
									<a <?php if ($p + $i + 1 != $p) : ?>href="kelola-user?keyword=<?php echo $keyword; ?>&p=<?php echo ($p + $i + 1); ?><?php if ($this->input->get('limit') != null) echo "&limit=" . $this->input->get('limit'); ?>" <?php endif; ?> class="page-link"><?php echo ($p + $i + 1); ?> <span class="sr-only"></span></a>
								</li>
						<?php endif;
								} ?>
						<?php
						?>
						<li class="page-item <?php if ((($data['totalUser']) - ($data['totalUser']) % $limit) / $limit + $mod == $p) echo "disabled"; ?>">
							<a href="kelola-user?keyword=<?php echo $keyword; ?>&p=<?php echo ($p + 1); ?><?php if ($this->input->get('limit') != null) echo "&limit=" . $this->input->get('limit'); ?>" class="page-link">Next</a>
						</li>
						<li class="page-item mr-auto <?php if ((($data['totalUser']) - ($data['totalUser']) % $limit) / $limit + 1 == $p) echo "disabled"; ?>">
							<a href="kelola-user?keyword=<?php echo $keyword; ?>&p=<?php echo (($data['totalUser']) - ($data['totalUser']) % $limit) / $limit + $mod; ?><?php if ($this->input->get('limit') != null) echo "&limit=" . $this->input->get('limit'); ?>" class="page-link" tabindex="-1">Last</a>
						</li>
						<?php ?>
					</ul>
				</nav>
			</div>
		</div>
	<?php endif; ?>
</div>

<style media="screen">
	.page-item {
		cursor: pointer;
	}

	@media (max-width: 991px) {
		.nama {
			color: #fff;
			background-color: rgba(3, 169, 244, 0.7);
			margin-top: -15px;
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

	}

	@media (min-width: 992px) {
		.icon {
			visibility: collapse;
			width: 0px;
		}

		.kelolaUser {
			background-color: white;
			-webkit-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12) !important;
			box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12) !important;
		}
	}
</style>


<script type="text/javascript">
	$(document).ready(function() {

		$(".btn-edit").on("click", function() {

			if (confirm('Apakah anda yakin?')) {
				var ID = $(this).attr('data-id');

				var value = {
					ID: ID,
					status: 1
				}

				$.post("<?php echo site_url('user/updateAgt') ?>", value)
					.done(function(data, status) {
						location.reload();
					})
					.fail(function(e, _, __) {
						alert("Server mengalami masalah.")
					})
			}

		});


	});
</script>
<div class="container">
	<section>
		<div class="row">
			<div class="col-12">
				<div class="card card-list mb-4">
					<div class="card-header white d-flex justify-content-between align-items-center py-3">
						<p class="h4-responsive font-weight-bold mb-0">Peminjaman Buku</p>
						<ul class="list-unstyled d-flex align-items-center mb-0">
							<li><a class="nav-link" href="<?php echo base_url('kelola-buku') ?>" class="btn	"> <i class="fas fa-times fa-sm pl-3"> </a></i></li>
						</ul>
					</div>
					<div class="card-body">
						<label class="mdb-main-label text-info" style="font-size: .8rem;">Peminjam belum disetujui <span class="badge badge-danger ml-3"><?php echo sizeof($rpinjam) ?></span></label>
						<?php if (sizeof($rpinjam)>0): ?>
							<input type="text" id="exampleForm2" class="text-muted dropdown-toggle form-control border-bottom  z-depth-0 border-0 " data-toggle="dropdown"aria-haspopup="true" aria-expanded="false" placeholder="<?php if(!isset($rpinjam[$upinjam]['buku']))echo "Pilih Anggota ..";else echo ucwords(strtolower($rpinjam[$upinjam]['user'][0]->nama)); ?>"><hr class="my-0">
							<div id="myDropdown" class="dropdown-menu rounded-lg z-depth-1" style="margin-top:-40px!important;">
								<div class="white md-form my-0 px-3">
									<input class="form-control" type="text" placeholder="Search" aria-label="Search"  id="myInput" onkeyup="filterFunction()">
								</div>
								<div style="min-height:100px;max-height: 300px;overflow:auto;;overflow-x: hidden;">
									<?php foreach ($rpinjam as $key => $value):?>
									<a class="dropdown-item px-3" href="<?php echo base_url('kelola-buku?tab=pinjam&id='.encrypt_url($key))?>"><?php echo $key." - ".ucwords(strtolower($value['user'][0]->nama)) ?></a>
									<?php endforeach; ?>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<div class="mb-5">
				<section>
					<?php if ($this->input->get('saved')!=null){ ?>
						<div class=" modal fade modal-success	" id="sukses" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
							aria-hidden="true">
							<div class="rounded-lg  modal-dialog" role="document">
								<div class="modal-content rounded-lg">
									<!--Header-->
									<div class="modal-header white-text	rounded-top success-color">
										<p class="heading lead">Sukses</p>

										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true" class="white-text">×</span>
										</button>
									</div>

									<!--Body-->
									<div class="modal-body">
										<div class="text-center">
											<i class="fas text-success fa-check fa-4x mb-3 animated rotateIn"></i>
											<p>Data Berhasil Disimpan</p>
										</div>
									</div>

									<!--Footer-->
									<div class="modal-footer justify-content-center">
										<a type="button" class="btn btn-outline-success waves-effect" data-dismiss="modal">Tutup</a>
									</div>
								</div>
							</div>
						</div>
				<?php }?>
					<?php if (isset($rpinjam[$upinjam]['buku'])): ?>
					<style>
						.card-list li.page-item {
							height: 36px;
						}
						.card-list .form-check-input[type="checkbox"] + label:before, .form-check-input[type="checkbox"]:not(.filled-in) + label:after, label.btn input[type="checkbox"] + label:before, label.btn input[type="checkbox"]:not(.filled-in) + label:after {
							margin-top: 0;
						}
						.card-list .form-check-input[type="checkbox"] + label, label.btn input[type="checkbox"] + label {
							height: 15px;
						}
						.card-list .form-check {
							height: 0;
						}
						.card-list .badge {
							height: 18px;
							margin-top: 3px;
						}

						.card-list .form-check-input[type="checkbox"] + label, label.btn input[type="checkbox"] + label {
								height: 15px;
						}
						.form-check-input[type="checkbox"] + label, label.btn input[type="checkbox"] + label {
								position: relative;
								display: inline-block;
								height: 1.5625rem;
								padding-left: 35px;
								line-height: 1.5625rem;
								cursor: pointer;
								-webkit-user-select: none;
								-moz-user-select: none;
								-ms-user-select: none;
								user-select: none;
						}
						.form-check-label {
								margin-bottom: 0;
						}
						[type="checkbox"]:not(:checked), [type="checkbox"]:checked {
								position: absolute;
								pointer-events: none;
								opacity: 0;
						}
						input[type="checkbox"], input[type="radio"] {
								box-sizing: border-box;
								padding: 0;
						}
						.form-check-input {
								position: absolute;
								margin-top: .3rem;
								margin-left: -1.25rem;
						}
						button, input {
								overflow: visible;
						}
						button, input, optgroup, select, textarea {
								margin: 0;
								margin-top: 0px;
								margin-left: 0px;
								font-family: inherit;
								font-size: inherit;
								line-height: inherit;
						}
						.form-check {
								position: relative;
								display: block;
								padding-left: 1.25rem;
						}

						.card-list .form-check-input[type="checkbox"] + label::before, .form-check-input[type="checkbox"]:not(.filled-in) + label::after, label.btn input[type="checkbox"] + label::before, label.btn input[type="checkbox"]:not(.filled-in) + label::after {

								margin-top: 0;

						}
						.form-check-input[type="checkbox"]:checked + label::before, label.btn input[type="checkbox"]:checked + label::before {

								top: -4px;
								left: -5px;
								width: 12px;
								height: 1.375rem;
								border-top: 2px solid transparent;
								border-right: 2px solid #4285f4;
								border-bottom: 2px solid #4285f4;
								border-left: 2px solid transparent;
								-webkit-transform: rotate(40deg);
								transform: rotate(40deg);
								-webkit-transform-origin: 100% 100%;
								transform-origin: 100% 100%;
								-webkit-backface-visibility: hidden;
								backface-visibility: hidden;

						}
						.form-check-input[type="checkbox"] + label::before, .form-check-input[type="checkbox"]:not(.filled-in) + label::after, label.btn input[type="checkbox"] + label::before, label.btn input[type="checkbox"]:not(.filled-in) + label::after {

								position: absolute;
								top: 0;
								left: 0;
								z-index: 0;
								width: 18px;
								height: 18px;
								margin-top: 3px;
								content: "";
								border: 2px solid #8a8a8a;
										border-top-color: rgb(138, 138, 138);
										border-top-style: solid;
										border-top-width: 2px;
										border-right-color: rgb(138, 138, 138);
										border-right-style: solid;
										border-right-width: 2px;
										border-bottom-color: rgb(138, 138, 138);
										border-bottom-style: solid;
										border-bottom-width: 2px;
										border-left-color: rgb(138, 138, 138);
										border-left-style: solid;
										border-left-width: 2px;
								border-radius: 1px;
								-webkit-transition: .2s;
								transition: .2s;

						}
						*, ::after, ::before {

								box-sizing: border-box;

						}
						.card-list .form-check-input[type="checkbox"] + label::before, .form-check-input[type="checkbox"]:not(.filled-in) + label::after, label.btn input[type="checkbox"] + label::before, label.btn input[type="checkbox"]:not(.filled-in) + label::after {
								margin-top: 0;
						}
						.form-check-input[type="checkbox"]:not(.filled-in) + label::after, label.btn input[type="checkbox"]:not(.filled-in) + label::after {
								border: 0;
								-webkit-transform: scale(0);
								transform: scale(0);
						}
						.form-check-input[type="checkbox"] + label::before, .form-check-input[type="checkbox"]:not(.filled-in) + label::after, label.btn input[type="checkbox"] + label::before, label.btn input[type="checkbox"]:not(.filled-in) + label::after {
								position: absolute;
								top: 0;
								left: 0;
								z-index: 0;
								width: 18px;
								height: 18px;
								margin-top: 3px;
								content: "";
								border: 2px solid #8a8a8a;
								border-radius: 1px;
								-webkit-transition: .2s;
								transition: .2s;
						}
						*, ::after, ::before {
								box-sizing: border-box;
						}
					</style>
					<div class="row">
						<div class="col-12">
							<div class="card card-list">
								<div class="card-header white d-flex justify-content-between align-items-center py-3">
									<p class="h5-responsive font-weight-bold mb-0"><i class="fas fa-clipboard-list pr-2"></i>Daftar Buku Dipinjam</p>
									<nav aria-label="Page navigation example">
										<ul class="pagination pg-blue mb-0" hidden>
											<li class="page-item">
												<a class="border page-link" aria-label="Previous">
													<span aria-hidden="true">&laquo;</span>
													<span class="sr-only">Previous</span>
												</a>
											</li>
											<li class="page-item"><a class="border page-link">1</a></li>
											<li class="page-item"><a class="border page-link">2</a></li>
											<li class="page-item"><a class="border page-link">3</a></li>
											<li class="page-item">
												<a class="border page-link" aria-label="Next">
													<span aria-hidden="true">&raquo;</span>
													<span class="sr-only">Next</span>
												</a>
											</li>
										</ul>
									</nav>
								</div>
								<form action="<?php echo base_url('admin/simpanPinjam?id='.$this->input->get('id')) ?>" method="post">
									<div class="card-body">
										<ul class="list-unstyled mb-0">
											<?php foreach ($rpinjam[$upinjam]['buku'] as $key):
												$time1 = new DateTime();
												$time2 = new DateTime($key->tgl_input);
												$timediff = $time1->diff($time2);

												if ($timediff->format('%m')>=1) {
													$col = "badge-light";
													$time = $timediff->format('%m')." Bulan Yang Lalu";
												}else if ($timediff->format('%d')/7>=1) {
													$col = "badge-success";
													$time = ($timediff->format('%d'))." Minggu Yang Lalu";
												}else if ($timediff->format('%d')>=1) {
													$col = "badge-warning";
													$time = $timediff->format('%d')." Hari Yang Lalu";
												}else if ($timediff->format('%h')>=1) {
													$col = "badge-info";
													$time = $timediff->format('%h')." Jam Yang Lalu";
												}else if ($timediff->format('%i')>=1) {
													$col = "badge-danger";
													$time = $timediff->format('%i')." Menit Yang Lalu";
												}else {
													$col = "badge-success";
													$time = $timediff->format('%s')." Detik Yang Lalu";
												}
												?>
												<li class="d-flex justify-content-between align-items-center py-2 ml-2 ">
													<div class="d-inline-flex">
														<div class="form-check pl-0">
															<input name="<?php echo encrypt_url($key->Id_pinjam) ?>" type="hidden" class="form-check-input" value="<?php echo encrypt_url(1) ?>">
															<input name="<?php echo encrypt_url($key->Id_pinjam) ?>" type="checkbox" class="form-check-input" id="<?php echo encrypt_url($key->Id_pinjam); ?>" value="<?php echo encrypt_url(2) ?>">
															<label class="form-check-label" for="<?php echo encrypt_url($key->Id_pinjam); ?>"></label>
														</div>
														<p class="mb-0"><span class="text"><?php echo ucwords(strtolower($key->judul)) ?></span></p>
														<span class="badge <?php echo $col ?> ml-3"><i class="far fa-clock pr-1"></i><?php echo $time ?></span>
													</div>
													<div class="tools">
														<a href="<?php echo base_url('admin/peminjaman?tab=pinjam&id='.$this->input->get('id')."&cancelid=".encrypt_url($key->Id_pinjam)); ?>"><i class="far fa-trash-alt"></i></a>
													</div>
												</li>
											<?php endforeach; ?>
										</ul>
									</div>
									<div class="card-footer white py-3">
										<div class="text-right">
											<button class="btn btn-primary btn-md px-3 my-0 mr-0">Simpan<i class="fas fa-plus pl-2"></i></button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>

					<?php endif; ?>
				</section>
		</div>
	</section>
</div>

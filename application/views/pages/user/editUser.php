<div class="container py-5 card mb-4 rounded-lg" style="padding:1.5rem!important">

	<h4 class="card-title mx-auto my-5"><strong>Atur Data Pengguna</strong></h4>
	<!--Section: Content-->
	<section class="px-md-5 mx-md-5 text-left dark-grey-text">
		<div class="">
			<div class="col-sm-12">
				<form action="<?php echo base_url('user/updateUser/'.$user[0]->Id) ?>" method="post">

				<div class="form-inline">
					<div class="col-sm-3">
						<h5 class="text pb-2 pt-1"><i class="fas fa-user"></i> Nama</h5>
					</div>
						<div class="col-sm-9">
							<input type="text" class="form-control mb-4" placeholder="Nama" value="<?php echo $user[0]->nama; ?>" name="nama" required>
						</div>
				</div>

				<div class="form-inline">
					<div class="col-sm-3">
						<h5 class="text pb-2 pt-1"><i class="fas fa-calendar-day"></i> TTL</h5>
					</div>
						<div class="col-sm-6">
							<input type="text" class="form-control mb-4" placeholder="Kota" value="<?php echo $user[0]->kota; ?>" name="kota" required>
						</div>
						<div class="col-sm-3">
							<input type="date" class="form-control mb-4" placeholder="Tanggal Lahir" value="<?php echo $user[0]->tgl_lahir; ?>" name="tgl_lahir" required>
						</div>
				</div>

				<div class="form-inline">
					<div class="col-sm-3">
						<h5 class="text pb-2 pt-1"><i class="fas fa-phone"></i> No Telepon</h5>
					</div>
						<div class="col-sm-9">
							<input type="text" class="form-control mb-4" placeholder="No Telepon"
							value="<?php echo $user[0]->no_telepon; ?>" name="no_telepon" required>
						</div>
				</div>

					<div class="form-inline">
						<div class="col-sm-3">
							<h5 class="text pb-2 pt-1"><i class="fas fa-at"></i> E-Mail</h5>
						</div>
							<div class="col-sm-9">
								<input type="text" class="form-control mb-4" placeholder="E-mail" value="<?php echo $user[0]->email; ?>" name="email">
							</div>
					</div>

					<div class="form-inline">
						<div class="col-sm-3">
							<h5 class="text pb-2 pt-1"><i class="fas fa-building"></i> Instansi</h5>
						</div>
							<div class="col-sm-9">
								<input type="text" class="form-control mb-4" placeholder="Instansi" value="<?php echo $user[0]->instansi; ?>" name="instansi" required>
							</div>
					</div>

					<div class="form-inline">
						<div class="col-sm-3">
							<h5 class="text pb-2 pt-1"><i class="fas fa-map"></i> Alamat</h5>
						</div>
							<div class="col-sm-9">
								<textarea class="form-control mb-4" id="exampleFormControlTextarea1" rows="3" name="alamat"><?php echo $user[0]->alamat; ?></textarea>
							</div>
					</div>
					<div class="form-inline">
						<div class="col-sm-3">
						</div>
						<div class="col-sm-3">
							<button class="btn btn-indigo my-4 btn-block rounded-pill" type="submit">Simpan</button>
						</div>
						<div class="col-sm-3">
						</div>
					</div>

				</form>
				<!-- Default form register -->

			</div>
			<!--Grid column-->

		</div>
		<!--Grid row-->


	</section>
	<!--Section: Content-->


</div>

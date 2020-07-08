
<?php $user = $user[0];
$bulan = array (1 =>   'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
?>
<div class="container">
  <div class="row">
    <div class="col-xl-4">
			<div class="card mb-5">
				<div class="m-4">
          <h4 class="font-weight-bold mb-3"><?php echo $user->nama ?></h4>
          <h6 class="font-weight-bold grey-text mb-5"><?php echo $user->Id_anggota ?></h6>


					<?php if ($user->tgl_lahir>1000): ?>
					<h6 class="h5">TTL</h6>
					<h6>- <?php echo ucwords(strtolower($user->kota)).", ".date_format(date_create($user->tgl_lahir),"d ").$bulan[date_format(date_create($user->tgl_lahir),"n")].date_format(date_create($user->tgl_lahir)," Y"); ?></h6>
					<?php endif; ?>
					<hr>
					<h6 class="h5">Instansi</h6>
					<h6>- <?php echo $user->instansi ?></h6>
					<hr>

					<h6 class="h5">No Telepon</h6>
					<h6>- <?php echo $user->no_telepon ?></h6>
					<hr>

					<h6 class="h5">E-Mail</h6>
					<h6>- <?php echo $user->email ?></h6>
					<hr>

					<h6 class="h5">Expired</h6>
					<h6>- <?php if (isset($user->tgl_expired)): ?><?php echo date_format(date_create($user->tgl_expired),"d F Y")?><?php endif; ?></h6>
					<hr>


          <p class="grey-text"><?php echo $user->alamat ?></p>
        </div>
			</div>
		</div>
		<?php if (isset($user->tgl_expired)){ ?>
	    <div class="col-12 col-xl-8">
				<?php $this->load->view('pages/user/cetakKartu.php') ?>
			</div>
		<?php } ?>
  </div>
</div>

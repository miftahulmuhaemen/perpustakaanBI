<div class="container">
	<div class="rounded-lg table">
		<div class="row header-table">
			<div class="col-lg-5">Judul</div>
			<div class="col-lg-2">Tanggal Pinjam</div>
			<div class="col-lg-2">Tanggal Kembali</div>
			<div class="col-lg-2">Status Peminjaman</div>
			<div class="col-lg-1"></div>
			<div class="col-12">
				<hr>
			</div>
		</div>
		<?php foreach ($peminjaman as $key):
			if ($key->status==1) {
				$col = "warning";
			}elseif ($key->status==2) {
				$col = "info";
			}elseif ($key->status==3){
				$col = "success";
			}

			$time1 = new DateTime();
			$time2 = new DateTime($key->tgl_input);
			$timediff = $time1->diff($time2);
			$time = null;
			if ($timediff->format('%m')>=1) {
				$time = $timediff->format('%m')." Bulan Yang Lalu";
			}else if ($timediff->format('%d')/7>=1) {
				$time = ($timediff->format('%d'))." Minggu Yang Lalu";
			}else if ($timediff->format('%d')>=1) {
				$time = $timediff->format('%d')." Hari Yang Lalu";
			}else if ($timediff->format('%h')>=1) {
				$time = $timediff->format('%h')." Jam Yang Lalu";
			}else if ($timediff->format('%i')>=1) {
				$time = $timediff->format('%i')." Menit Yang Lalu";
			}else {
				$time = $timediff->format('%s')." Detik Yang Lalu";
			}
			?>
			<div class="pinjam rounded-lg mb-2">
				<div class="row">
					<div class="col-lg-5 d-flex align-items-center"><i class="icon fas fa-book"></i><?php echo $key->judul ?></div>
					<div class="col-lg-2 d-flex align-items-center"><i class="icon fas fa-calendar"><small>&nbsp Tanggal Pinjam &nbsp:</small></i><small><?php echo $time ?></small> </div>
					<div class="col-lg-2 d-flex align-items-center"><i class="icon fas fa-calendar"><small>&nbsp Tanggal Kembali &nbsp:</small> </i><small><?php echo $key->tgl_pinjam ?></small> </div>
					<div class="col-lg-1 d-flex align-items-center text-right">
						<?php if ($key->status==1){ ?>
							<a href="<?php echo base_url('buku/batal/'.encrypt_url($key->Id_pinjam)) ?>"><h6><span class="badge rgba-orange-strong">Batal</span></h6></a>
						<?php }else if ($key->status==2){ ?>
							<h6><span class="badge badge-success">Sedang Dipinjam</span></h6>
						<?php }else if ($key->status==3){ ?>
							<h6><span class="badge badge-info">Sudah Dikembalikan</span></h6>
						<?php } ?>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>
<style media="screen">
	@media (max-width: 991px){
		.header-table{
			visibility: collapse;
		}

		.pinjam{
			padding: 0.5rem;
			margin-bottom: 1rem;
			background-color: white;
		}

	}

	@media (min-width: 992px){

		.table{
			background-color: white;
			padding: 0.5rem;
		}
		.icon{
			visibility: collapse;
			width: 0px;
			height: 0px;
		}
	}
</style>

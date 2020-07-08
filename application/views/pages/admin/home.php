<?php
	$color = "mauve";
 ?>
<div class="container">
	<?php if ($this->session->userdata('level')==1): ?>
	<!-- <div class="row">
		<div class="col mb-4">
			<input type="text" id="exampleForm2" class="text-muted dropdown-toggle form-control border-bottom  z-depth-0 border-0 " data-toggle="dropdown"aria-haspopup="true" aria-expanded="false" placeholder="Pilih BI Corner"><hr class="my-0">
			<div id="myDropdown" class="dropdown-menu rounded-lg z-depth-1" style="margin-top:-40px!important;">
				<div class="white md-form my-0 px-3">
					<input class="form-control" type="text" placeholder="Search" aria-label="Search"  id="myInput" onkeyup="filterFunction()">
				</div>
				<div class="w-100" style="min-height:100px;max-height:300px;overflow:auto;overflow-x:hidden;">
					<?php foreach ($perpus as $key => $value):?>
					<a class="dropdown-item px-3 mr-3" href="<?php echo base_url('dashboard?bicornerid=').encrypt_url($value->Id_perpustakaan)?>"><?php echo $value->nama?></a>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800"></h1>
			<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-white shadow-sm"><i class="fas fa-download fa-sm"></i> Cetak Laporan</a>
		</div>
	</div> -->


	<div class="container">

		  <section>

		    <style>
		      .footer-hover {
		        background-color: rgba(0, 0, 0, 0.1);
		        -webkit-transition: all .3s ease-in-out;
		        transition: all .3s ease-in-out
		      }

		      .footer-hover:hover {
		        background-color: rgba(0, 0, 0, 0.2)
		      }

		      .text-black-40 {
		        color: rgba(0, 0, 0, 0.4)
		      }
		    </style>

		    <!-- Grid row -->
		    <div class="row">

		      <!-- Grid column -->
					<?php if (isset($jumlah_buku)): ?>
			      <div class="mx-auto col-md-6 col-lg-3 mb-4">

		        <!-- Card -->
		        <div class="card <?php echo $color; ?> white-text">
		          <div class="card-body d-flex justify-content-between align-items-center">
		            <div>
		              <p class="h2-responsive font-weight-bold mt-n2 mb-0"><?php echo $jumlah_buku ?></p>
		              <p class="mb-0">Jumlah Koleksi</p>
		            </div>
		            <div>
		              <i class="fas fa-book fa-4x text-black-40"></i>
		            </div>
		          </div>
		          <a class="card-footer footer-hover small text-center white-text border-0 p-2" href="<?php echo base_url('kelola-buku') ?>">Lihat<i class="fas fa-arrow-circle-right pl-2"></i></a>
		        </div>
		        <!-- Card -->

		      </div>
					<?php endif; ?>
					<?php if (isset($bicorner)): ?>
						<div class="mx-auto col-md-6 col-lg-3 mb-4">

			        <!-- Card -->
			        <div class="card <?php echo $color; ?> white-text">
			          <div class="card-body d-flex justify-content-between align-items-center">
			            <div>
			              <p class="h2-responsive font-weight-bold mt-n2 mb-0"><?php echo $bicorner ?></p>
										<p class="mb-0">BI Corner</p>
			            </div>
			            <div>
			              <i class="fas fa-home fa-4x text-black-40"></i>
			            </div>
			          </div>
			          <a class="card-footer footer-hover small text-center white-text border-0 p-2" href="<?php echo base_url('kelola-corner') ?>">Lihat<i class="fas fa-arrow-circle-right pl-2"></i></a>
			        </div>
			        <!-- Card -->

			      </div>
		      <?php endif; ?>
		      <?php if (isset($anggota_baru)): ?>
						<div class="mx-auto col-md-6 col-lg-3 mb-4">

			        <!-- Card -->
			        <div class="card <?php echo $color; ?> lighten-1 white-text">
			          <div class="card-body d-flex justify-content-between align-items-center">
			            <div>
			              <p class="h2-responsive font-weight-bold mt-n2 mb-0"><?php echo $anggota_baru; ?></p>
			              <p class="mb-0">Anggota Baru</p>
			            </div>
			            <div>
			              <i class="fas fa-user-plus fa-4x text-black-40"></i>
			            </div>
			          </div>
			          <a class="card-footer footer-hover small text-center white-text border-0 p-2" href="<?php echo base_url('anggota') ?>" >Lihat<i class="fas fa-arrow-circle-right pl-2"></i></a>
			        </div>
			        <!-- Card -->

			      </div>
		      <?php endif; ?>
		      <!-- Grid column -->

		      <!-- Grid column -->
		      <?php if (isset($visit_month)): ?>
						<div class="mx-auto col-md-6 col-lg-3 mb-4">

			        <!-- Card -->
			        <div class="card <?php echo $color; ?> accent-2 white-text">
			          <div class="card-body d-flex justify-content-between align-items-center">
			            <div>
			              <p class="h2-responsive font-weight-bold mt-n2 mb-0"><?php echo $visit_month ?></p>
			              <p class="mb-0">Kunjungan</p>
			            </div>
			            <div>
			              <i class="fas fa-users fa-4x text-black-40"></i>
			            </div>
			          </div>
			          <a class="card-footer footer-hover small text-center white-text border-0 p-2">Lihat<i class="fas fa-arrow-circle-right pl-2"></i></a>
			        </div>
			        <!-- Card -->

			      </div>
		      <?php endif; ?>
		      <!-- Grid column -->

		    </div>
		    <!-- Grid row -->
		  </section>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-12 col-md-6  mb-4">
				<div class="card card-list">
					<div class="card-header mauve white-text d-flex justify-content-between align-items-center py-3">
						<p class="h5-responsive font-weight-bold mb-0">Data Peminjaman Buku</p>
						<ul class="list-unstyled d-flex align-items-center mb-0">
						</ul>
					</div>
					<a href="#!" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">Sudah Dikembalikan
						<span class="badge badge-success badge-pill"><?php if(isset($data_buku[3])) echo $data_buku[3]; else echo 0; ?></span>
					</a>
					<a href="#!" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">Sedang Dipinjam
						<span class="badge badge-info badge-pill"><?php if(isset($data_buku[2])) echo $data_buku[2]; else echo 0;?></span>
					</a>
					<a href="#!" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">Menunggu Diambil
						<span class="badge badge-warning badge-pill"><?php if(isset($data_buku[1])) echo $data_buku[1]; else echo 0;?></span>
					</a>
					<div class="card-footer white py-3 d-flex justify-content-between">
						<a class="btn mauve white-text btn-md px-3 my-0 mr-0 ml-auto" href="<?php echo base_url('kelola-buku?tab=pinjam') ?>" >Lihat Data</a>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-6 ">
				<div class="card shadow mb-4">
					<!-- Card Header - Dropdown -->
					<div class="mauve card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold white-text">Pengunjung <?php echo date("M Y"); ?></h6>

					</div>
					<!-- Card Body -->
					<div class="card-body px-0 w-100">
						<div class="mx-auto text-center">
						</div>
						<div class="chart-area mx-auto">
							<div id="curve_chart" class="w-100"></div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">


		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {
			var data = google.visualization.arrayToDataTable([
				['Date', 'Pengunjung'],
				<?php for ($i=1; $i <= date("d") ; $i++) {
					$j=0;
						if (isset($dailyVisit[$i])) {
							$j = $dailyVisit[$i];
						}
					?>
					[<?php echo $i.",".$j; ?>],
					<?php
				} ?>
			]);

			var options = {
				title: '',
				curveType: 'function',
				legend: { position: 'bottom' }
			};

			var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

			chart.draw(data, options);
		}
	</script>



	<?php

	$q=str_replace(" ","+","intitle:".$buku[0]->judul.'&maxResults=1');
	$json = file_get_contents('https://www.googleapis.com/books/v1/volumes?q='.$q);
	$data = json_decode($json,true);

	$klasifikasi = intval(substr($buku[0]->klasifikasi, 0, 3));
	if ($klasifikasi<10)
		$klasifikasi = "Publikasi Umum, informasi umum dan komputer";
	else if ($klasifikasi<20)
		$klasifikasi = "Bibiliografi";
	else if ($klasifikasi<30)
		$klasifikasi = "Perpustakaan dan informasi";
	else if ($klasifikasi<40)
		$klasifikasi = " Ensiklopedia dan buku yang memuat fakta-fakta";
	else if ($klasifikasi<50)
		$klasifikasi = "Tidak ada klasifikasi";
	else if ($klasifikasi<60)
		$klasifikasi = "Majalah dan Jurnal";
	else if ($klasifikasi<70)
		$klasifikasi = "Asosiasi, Organisasi dan Museum";
	else if ($klasifikasi<80)
		$klasifikasi = "Media massa, junalisme dan publikasi";
	else if ($klasifikasi<90)
		$klasifikasi = "Kutipan";
	else if ($klasifikasi<100)
		$klasifikasi = "Manuskrip dan buku langka";
	else if ($klasifikasi<110)
		$klasifikasi = "Filsafat dan psikologi";
	else if ($klasifikasi<120)
		$klasifikasi = "Metafisika";
	else if ($klasifikasi<130)
		$klasifikasi = "Epistimologi";
	else if ($klasifikasi<140)
		$klasifikasi = "Parapsikologi dan Okultisme";
	else if ($klasifikasi<150)
		$klasifikasi = "Pemikiran Filosofis";
	else if ($klasifikasi<160)
		$klasifikasi = "Psikologi";
	else if ($klasifikasi<170)
		$klasifikasi = "Filosofis Logis";
	else if ($klasifikasi<180)
		$klasifikasi = "Etik";
	else if ($klasifikasi<190)
		$klasifikasi = "Filosofi kuno, zaman pertengahan, dan filosofi ketimuran";
	else if ($klasifikasi<200)
		$klasifikasi = "Filosofi barat modern";
	else if ($klasifikasi<300)
		$klasifikasi = "Agama";
	else if ($klasifikasi<310)
		$klasifikasi = "Ilmu sosial, sosiologi dan antropologi";
	else if ($klasifikasi<320)
		$klasifikasi = "Statistik";
	else if ($klasifikasi<330)
		$klasifikasi = "Ilmu politik";
	else if ($klasifikasi<340)
		$klasifikasi = "Ekonomi";
	else if ($klasifikasi<350)
		$klasifikasi = "Hukum";
	else if ($klasifikasi<360)
		$klasifikasi = "Administrasi publik dan ilmu kemiliteran";
	else if ($klasifikasi<370)
		$klasifikasi = "Masalah dan layanan sosial";
	else if ($klasifikasi<380)
		$klasifikasi = "Pendidikan";
	else if ($klasifikasi<390)
		$klasifikasi = "Perdagangan, komunikasi dan transportasi";
	else if ($klasifikasi<400)
		$klasifikasi = "Norma, etika dan tradisi";
	else if ($klasifikasi<510)
		$klasifikasi = "Sains";
	else if ($klasifikasi<520)
		$klasifikasi = "Matematika";
	else if ($klasifikasi<530)
		$klasifikasi = "Astronomi";
	else if ($klasifikasi<540)
		$klasifikasi = "Fisika";
	else if ($klasifikasi<550)
		$klasifikasi = "Kimia";
	else if ($klasifikasi<560)
		$klasifikasi = "Ilmu kebumian dan geologi";
	else if ($klasifikasi<570)
		$klasifikasi = "Fosil dan kehidupan prasejarah";
	else if ($klasifikasi<580)
		$klasifikasi = "Biologi";
	else if ($klasifikasi<590)
		$klasifikasi = "Tanaman";
	else if ($klasifikasi<600)
		$klasifikasi = "Zoologi";
	else if ($klasifikasi<610)
		$klasifikasi = "Teknologi";
	else if ($klasifikasi<620)
		$klasifikasi = "Kesehatan dan Obat-Obatan";
	else if ($klasifikasi<630)
		$klasifikasi = "Teknik";
	else if ($klasifikasi<640)
		$klasifikasi = "Pertanian";
	else if ($klasifikasi<650)
		$klasifikasi = "Managemen Rumah Tangga dan Keluarga";
	else if ($klasifikasi<660)
		$klasifikasi = "Manajemen dan Hubungan dengan Publik";
	else if ($klasifikasi<670)
		$klasifikasi = "Teknik Kimia";
	else if ($klasifikasi<680)
		$klasifikasi = "Manufaktur";
	else if ($klasifikasi<690)
		$klasifikasi = "Manufaktur untuk Keperluan Khusus";
	else if ($klasifikasi<700)
		$klasifikasi = "Konstruksi";
	else if ($klasifikasi<710)
		$klasifikasi = "Kesenian dan rekreasi";
	else if ($klasifikasi<720)
		$klasifikasi = "Perencanaan dan Arsitektur Lanskap";
	else if ($klasifikasi<730)
		$klasifikasi = "Arsitektur";
	else if ($klasifikasi<740)
		$klasifikasi = "Patung, Keramik dan Seni Metal";
	else if ($klasifikasi<750)
		$klasifikasi = "Seni Grafis dan Dekoratif";
	else if ($klasifikasi<760)
		$klasifikasi = "Lukisan";
	else if ($klasifikasi<770)
		$klasifikasi = "Percetakan";
	else if ($klasifikasi<780)
		$klasifikasi = "Fotografi, Film, Video";
	else if ($klasifikasi<790)
		$klasifikasi = "Musik";
	else if ($klasifikasi<800)
		$klasifikasi = "Olahraga, Permainan dan Hiburan";
	else if ($klasifikasi<900)
		$klasifikasi = "Literatur, Sastra, Retorika dan Kritik";
	else if ($klasifikasi<910)
		$klasifikasi = "Sejarah";
	else if ($klasifikasi<920)
		$klasifikasi = "Geografi dan Perjalanan";
	else if ($klasifikasi<930)
		$klasifikasi = "Biografi dan Asal-Usul";
	else if ($klasifikasi<940)
		$klasifikasi = "Sejarah Dunia Lama";
	else if ($klasifikasi<950)
		$klasifikasi = "Asal–Usul Eropa";
	else if ($klasifikasi<960)
		$klasifikasi = "Asal-Usul Asia";
	else if ($klasifikasi<970)
		$klasifikasi = "Asal-Usul Afrika";
	else if ($klasifikasi<980)
		$klasifikasi = "Asal-Usul Amerika Utara";
	else if ($klasifikasi<990)
		$klasifikasi = "Asal-Usul Amerika Selatan";
	else if ($klasifikasi<1000)
		$klasifikasi = "Asal-Usul Wilayah Lain";
	?>
<div class="container pb-5">
	<div class="row">
		<ul class="nav justify-content-end py-4 w-100">
		  <li class="nav-item">
		    <a class="nav-link btn btn-indigo p-2 " onclick="goBack()" type="button"> <i class="fas fa-angle-left white-text"></i> <span class="white-text">Kembali</span></a>
		  </li>
		</ul>
	</div>
	<div class="row">
		<div class="col-lg-4">

		</div>
		<div class="col-12 mx-auto mb-4">
			<div class="card pt-2">
					<h6 class="font-weight-bold text-center grey-text text-uppercase small mb-4 mt-2"><?php echo $buku[0]->no_barcode ?></h6>
					<h3 class="font-weight-bold text-center dark-grey-text pb-2"><?php echo $buku[0]->judul ?></h3>
			</div>
		</div>
		<div class="col-12">
			<!-- Card -->
			<div class="card card-cascade narrower card-ecommerce mx-auto">
				<div class="row">
					<div class="col-lg-4 pb-3">
						<?php if (isset($data['items'][0]['volumeInfo']['imageLinks']['thumbnail'])): ?>

							<div class="view view-cascade overlay">
								<img src="<?php echo $data['items'][0]['volumeInfo']['imageLinks']['thumbnail']; ?>" class="card-img-top"
									alt="sample photo">
								<a href="">
									<div class="mask rgba-white-slight"></div>
								</a>
							</div>
							<p class="text-center my-3	">sumber sampul : Google Book</p>
						<?php endif; ?>
					</div>
					<div class="col-lg-8">
						<div class="card-body card-body-cascade text-center pb-3">
							<!-- Title -->
							<h5 class="card-title mb-1">
								<strong>
									<?php echo $buku[0]->nama ; ?>
								</strong>
							</h5>
							<span class="rgba-blue-strong rounded z-depth-1 white-text px-2 my-5"><small><?php echo $klasifikasi ?></small> </span>
							<p class="card-text">
								Nomor Klasifikasi : <?php echo $buku[0]->klasifikasi  ?><br>
								<?php echo $buku[0]->pengarang ?>
								<?php echo $buku[0]->tahun  ?><br>
								<br>
								No Register : <?php echo $buku[0]->no_register ?>
								<br>
								<?php echo $buku[0]->tgl_input ?>
							</p>
							<?php if (isset($data['items'][0]['volumeInfo']['previewLink'])): ?>
								<a href="<?php echo $data['items'][0]['volumeInfo']['previewLink'] ?>">Google Book Link</a>
							<?php endif; ?>
							<div class="">
							 <?php if(isset($data['items'][0]['volumeInfo']['description'])): ?>
								 <h5 class="mb-0 text-info">
									 Deskripsi
								 </h5>

								 <div id="collapseOne1" class="collapse show" role="tabpanel" aria-labelledby="headingOne1"
									 data-parent="#accordionEx">
									 <div class="card-body text-left">
										 <?php  echo $data['items'][0]['volumeInfo']['description']; ?>
									 </div>
								 </div>
							 <?php endif; ?>
						 </div>
						</div>
					</div>
				</div>
			</div>
			<!-- Card -->
		</div>
	</div>
</div>

<script>
function goBack() {
  window.history.back();
}
</script>

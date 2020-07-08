
  <!-- Start your project here-->
  <div style="height: 100vh">
    <div class="flex-center flex-column">
      <h1 class="text-hide animated fadeIn mb-4" style="background-image: url('https://www.e-jukung.com/assets/img/perpus_bi.ico'); width: 250px; height: 230px;">MDBootstrap</h1>
      <h5 class="animated fadeIn mb-3">Akun anda telah berhasil di daftarkan, silahkan login dengan menggunakan Id dibawah</h5>
      <h3 class="animated fadeIn mb-3">Id anggota : <?php echo $this->input->get('id');?></h3>
      <a href="<?php echo base_url();?>"><button class="btn btn-indigo">Login</button></a>
    </div>
  </div>
  <!-- End your project here-->

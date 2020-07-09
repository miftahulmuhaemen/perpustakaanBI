<?php
  if (!isset($keyword)) {
    $keyword="";
  }
 ?>
<style media="screen">
  .border-1:hover{
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 0px 20px 0 rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.5s ease-in-out;
  }
</style>

<div class="container-fluid py-1 <?php if(!isset($buku))echo "h-75";else echo "h-25"; ?>">
  <div class="row" <?php if(!isset($buku))echo'style="margin:5% 0"'?>>
    <div class="col">
      <div class="container">
				<?php if ($this->session->userdata('level')==6): ?>
				<div class="row <?php if ($this->session->userdata('level')==6)echo "py-3"; ?>">
					<a href="logout"><span class="badge badge-pill badge-danger">Keluar</span></a>
				</div>
				<?php endif; ?>
        <section class="text-center text-lg-left dark-grey-text">
          <!--Grid row-->
          <div class="row d-flex justify-content-center">

            <!--Grid column-->
            <div class="w-100<?php if(!isset($buku))echo " col-md-6"; ?> text-center">

              <?php if(!isset($buku)): ?>
                <img class="logo-cari" src="<?php echo base_url('assets/img/logo.ico') ?>" alt="thumbnail"  style="width: 300px">
              <?php endif; ?>

              <form class="input-group py-1 mb-4 border border-1 rounded-pill pr-4 white"  method="get" action="<?php echo base_url('cari-buku') ?>">
                <div class="input-group-append">
                  <button class="btn btn-md  m-0 px-3 py-2 z-depth-0 waves-effect" type="submit" id="button-addon2" >
                    <i class="<?php if(!isset($buku))echo "text-black-50"; else echo "text-primary"; ?> fas fa-2x fa-search fa-rotate-270"></i>
                  </button>
                </div>
                <input name="keyword" type="text" value="<?php echo $keyword;?>" class="keyword border border-0" >
              </form>

            </div>
            <!--Grid column-->

          </div>
          <!--Grid row-->


        </section>
        <!--Section: Content-->


      </div>
    </div>
  </div>

	<?php $this->load->view('pages/buku/viewAll') ?>
</div>

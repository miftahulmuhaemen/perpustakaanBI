<div class="container">
	<?php if ($this->session->userdata('level')==1): ?>
	<div class="row">
		<div class="col mb-4 mt-1s">
			<?php if (sizeof($perpus)>0): ?>
			<div class="white rounded-lg p-2">
				<input type="text" id="exampleForm2" class="text-muted dropdown-toggle form-control border-bottom  z-depth-0 border-0 " data-toggle="dropdown"aria-haspopup="true" aria-expanded="false" placeholder="Pilih BI Corner">
				<hr class="my-0">
				<div id="myDropdown" class="dropdown-menu rounded-lg z-depth-1" style="margin-top:-40px!important;">
					<div class="white md-form my-0 px-3">
						<input class="form-control" type="text" placeholder="Search" aria-label="Search"  id="myInput" onkeyup="filterFunction()">
					</div>
					<div class="w-100" style="min-height:100px;max-height: 300px;overflow:auto;;overflow-x: hidden;">
						<?php foreach ($perpus as $key => $value):?>
						<a class="dropdown-item px-3 mr-3" href="<?php echo base_url('kelola-corner?bicornerid='.encrypt_url($value->Id_perpustakaan))?>"><?php echo $value->nama; if($value->tipe==0)echo ' <span class="badge badge-danger">Dihapus</span>'?></a>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
			<?php endif; ?>
		</div>
		<div>
			<a href="#" class="btn btn-success m-0 p-3 my-1" data-toggle="modal" data-target="#basicExampleModal">Tambah BI Corner</a>
		</div>
	</div>
	<?php endif; ?>
	<div class="row">

		<div class="col-12 col-md-6">
			<div class="card mb-4">
				<div class="col text-right">
					<?php if ($this->session->userdata('level')==1): ?>
						<?php if ($bicorner->tipe!=1){
							if ($bicorner->tipe==2) {
								?><a href="<?php echo base_url('admin/hapus_perpus?id='.encrypt_url($bicorner->Id_perpustakaan)."?time=".date("l jS \of F Y h:i:s A")) ?>" class="btn btn-danger p-2 small mb-0" style="top:-20px">HAPUS</a><?php
							}else {
								?>
								<a href="<?php echo base_url('admin/batal_hapus_perpus?id='.encrypt_url($bicorner->Id_perpustakaan)) ?>" class="btn btn-success p-2 small " style="top:-20px">Batal Hapus</a>
								<a href="<?php echo base_url('admin/hapus_perpus_permanen?id='.encrypt_url($bicorner->Id_perpustakaan)) ?>" class="btn btn-danger p-2 small " style="top:-20px">Hapus Permanen</a>
								<?php
							}
						}?>
					<?php endif; ?>
				</div>
				<form class="text-center p-5" action="<?php echo base_url('admin/simpan_perpus?id='.encrypt_url($bicorner->Id_perpustakaan)) ?>" method="post">
					<p class="h4">BI Corner <?php echo $bicorner->nama ?></p>

					<input name="nama" type="text" id="defaultContactFormName" class="form-control my-4" value="<?php echo $bicorner->nama ?>">

					<input name="email" type="email" id="defaultContactFormEmail" class="form-control mb-4" value="<?php echo $bicorner->email ?>">

					<div class="form-group">
							<textarea name="alamat" class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3"><?php echo $bicorner->alamat ?></textarea>
					</div>

					<button class="btn btn-indigo btn-block" type="submit">Simpan</button>
				</form>
			</div>
		</div>
		<?php if ($this->session->userdata('level')!=1||$this->input->get('bicornerid')!=''): ?>
		<div class="col-12 col-md-6">
			<div class="card card-cascade narrower mb-4">

			  <!-- Card image -->
			  <div class="view view-cascade overlay">
			    <img class="card-img-top" src="<?php echo base_url('assets/img/qrcode.png?t='. time()) ?>"
			      alt="Card image cap">
			    <a>
			      <div class="mask rgba-white-slight"></div>
			    </a>
			  </div>

			  <!-- Card content -->
			  <div class="card-body card-body-cascade">

			    <!-- Label -->
			    <h5 class="pink-text pb-2 pt-1"><i class="fas fa-qrcode"></i> URL Catat Hadir</h5>
			    <!-- Title -->
			    <h4 class="font-weight-bold card-title"></h4>
			    <!-- Text -->
			    <p class="card-text"><?php echo base_url('hadir/'.encrypt_url($bicorner->Id_perpustakaan)) ?></p>
			    <!-- Button -->
			    <a class="btn btn-unique" data-href='<?php echo base_url('assets/img/qrcode.png') ?>' download="<?php echo "QR Code BI Corner ".$bicorner->nama; ?>.jpg" onclick='forceDownload(this)'>Download QR Code</a>

			  </div>

			</div>
		</div>
		<?php endif; ?>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">

        <!--Modal cascading tabs-->
        <div class="modal-c-tabs">

          <!-- Nav tabs -->

					<div class="indigo mx-3 card px-2 white-text" style="top:-20px">
						<h2>Tambah BI Corner</h2>
					</div>

          <!-- Tab panels -->
          <div class="tab-content">
            <!--Panel 17-->
            <div class="tab-pane fade in show active" id="panel17" role="tabpanel">
              <div class="modal-body mb-1">
                <form class="text-center px-3" action="<?php echo base_url('admin/tambah_perpus') ?>" method="post">
									<p class="h4">BI Corner <?php echo $bicorner->nama ?></p>

									<input name="nama" type="text" id="defaultContactFormName" class="form-control my-4" placeholder="Nama BI Corner" required>

									<input name="email" type="email" id="defaultContactFormEmail" class="form-control mb-4" placeholder="Email">

									<div class="form-group">
										<textarea name="alamat" class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3" placeholder="Alamat BI Corner"></textarea>
									</div>

									<button class="btn btn-info btn-block" type="submit">Simpan</button>
								</form>
              </div>
            </div>
            <!--/.Panel 7-->

            <!--Panel 18-->
            <div class="tab-pane fade" id="panel18" role="tabpanel">

              <!--Body-->
              <div class="modal-body">
                <div class="md-form form-sm">
                  <i class="fas fa-envelope prefix"></i>
                  <input type="text" id="form14" class="form-control form-control-sm">
                  <label for="form14">Your email</label>
                </div>

                <div class="md-form form-sm">
                  <i class="fas fa-lock prefix"></i>
                  <input type="password" id="form5" class="form-control form-control-sm">
                  <label for="form5">Your password</label>
                </div>

                <div class="md-form form-sm">
                  <i class="fas fa-lock prefix"></i>
                  <input type="password" id="form6" class="form-control form-control-sm">
                  <label for="form6">Repeat password</label>
                </div>

                <div class="text-center form-sm mt-4">
                  <button class="btn btn-info waves-effect waves-light">Sign up
                    <i class="fas fa-sign-in ml-1"></i>
                  </button>
                </div>

              </div>
              <!--Footer-->
              <div class="modal-footer">
                <div class="options text-right">
                  <p class="pt-1">Already have an account?
                    <a href="#" class="blue-text">Log In</a>
                  </p>
                </div>
                <button type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Close</button>
              </div>
            </div>
            <!--/.Panel 8-->
          </div>

        </div>
      </div>
  </div>
</div>

<script>
function forceDownload(link){
	var url = link.getAttribute("data-href");
	var fileName = link.getAttribute("download");
	link.innerText = "Working...";
	var xhr = new XMLHttpRequest();
	xhr.open("GET", url, true);
	xhr.responseType = "blob";
	xhr.onload = function(){
			var urlCreator = window.URL || window.webkitURL;
			var imageUrl = urlCreator.createObjectURL(this.response);
			var tag = document.createElement('a');
			tag.href = imageUrl;
			tag.download = fileName;
			document.body.appendChild(tag);
			tag.click();
			document.body.removeChild(tag);
			link.innerText="Download QR Code";
	}
	xhr.send();
}


function myFunction() {
document.getElementById("myDropdown").classList.toggle("show");
}

function filterFunction() {
var input, filter, ul, li, a, i;
input = document.getElementById("myInput");
filter = input.value.toUpperCase();
div = document.getElementById("myDropdown");
a = div.getElementsByTagName("a");
for (i = 0; i < a.length; i++) {
	txtValue = a[i].textContent || a[i].innerText;
	if (txtValue.toUpperCase().indexOf(filter) > -1) {
		a[i].style.display = "";
	} else {
		a[i].style.display = "none";
	}
}
}
</script>

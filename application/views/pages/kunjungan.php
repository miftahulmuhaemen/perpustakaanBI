<style>
	input{
		border: 0px!important;
	}
	hr{
		margin: 0
	}
	input.date {
    position: relative;
    width: 150px; height: 20px;
    color: white;
	}

	input.date:before {
	    position: absolute;
	    top: 3px; left: 3px;
	    content: attr(data-date);
	    display: inline-block;
	    color: black;
	}

	input.date::-webkit-datetime-edit, input::-webkit-inner-spin-button, input::-webkit-clear-button {
	    display: none;
	}

	input.date::-webkit-calendar-picker-indicator {
	    position: absolute;
	    top: 3px;
	    right: 0;
	    color: black;
	    opacity: 1;
	}
</style>
<div class="white vh-100 vw-100" style="position: fixed;left: 0vw;z-index: -1;">
</div>


<div style="height: 100vh">
	<div class="flex-center flex-column">
		<div class="container h-100">
			<div class="row align-items-center text-left h-100">
				<div class="col-12 col-lg-6">
					<?php if ($this->session->has_userdata('login')): ?>
						<div class="alert alert-success" role="alert">
							Halo <a href="#" class="alert-link"><?php echo $this->session->userdata('nama'); ?></a>, anda sudah tercatat dalam daftar Kehadiran</a>
						</div>
					<?php endif; ?>
					<form class="card my-4 text-center rounded-lg" action="<?php echo base_url('regis') ?>" method="post" style="padding:1.5rem!important">

						<h4 class="card-title mt-4"><strong>Catat Hadir</strong></h4>
						<h6 class="mb-4"><?php echo $bicorner[0]->nama ?></h6>
						<input type="text" class="form-control" placeholder="Nama" name="Id_perpustakaan" value="<?php echo encrypt_url($bicorner[0]->Id_perpustakaan) ?>" hidden>
						<div class="form-row  mt-4">
							<div class="col">
								<input type="text" class="form-control" placeholder="Nama" name="nama" required>
								<hr>
							</div>
						</div>

						<div class="form-row  mt-4">
							<div class="col">
								<input type="text" class="form-control" placeholder="Tempat Lahir" name="kota" required>
								<hr>
							</div>
							<div class="col">
								<input id="dateinput" class="form-control" placeholder="Tanggal Lahir" type="date" data-date="" data-date-format="DD MMMM YYYY" name="tgl_lahir" required>
								<hr>
							</div>
						</div>

						<input onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text" class="form-control mt-4" placeholder="No Telepon" name="no_telepon" required>
						<hr>

						<input type="email" class="form-control mt-4" placeholder="E-mail" name="email">
						<hr>

						<input type="text" class="form-control mt-4" placeholder="Instansi" name="instansi" required>
						<hr>


						<button class="btn btn-indigo rounded-pill my-4 btn-block" type="submit">Catat Kehadiran</button>

						<p class="text-center">Sudah punya akun?
								<a href="<?php echo base_url('login/'.$bicoid) ?>">Catat Kehadiran Disini</a>
						</p>

					</form>
				</div>
				<div class="col-lg-6 loginInfo text-center">
					<h4 class="grey-darken-text mx-auto font-weight-bold mb-4 text-center">E-Jukung</h4>
					<p class="grey-darken-text mb-4 pb-2 text-center">Sistem Pengelolaan Pelayanan <br>Perpustakaan Bank Indonesia Provinsi Kalimantan Selatan</p>
					<img src="<?php echo base_url('/assets/img/LOGIN.png') ?>" class="img-fluid mx-auto" style="height:300px">
					<div class="text-center white-text">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
$("#dateinput").on("change", function() {
    this.setAttribute(
        "data-date",
        moment(this.value, "YYYY-MM-DD")
        .format( this.getAttribute("data-date-format") )
    )
}).trigger("change")

$(document).on('click','.pass_show .ptxt', function(){
	$(this).toggleClass("fa-eye-slash");
	$(this).toggleClass("black-text");
	$('#defaultSubscriptionFormEmail').attr('type', function(index, attr){return attr == 'password' ? 'text' : 'password'; });
});
</script>

<style>

	body{
		overflow-x: hidden;
	}
	input{
		border: 0px!important;
	}
	hr{
		margin: 0
	}
</style>

<div class="white vh-100 vw-100" style="position: fixed;left: 0vw;z-index: -1;">
</div>
<div style="height: 93vh">
	<div class="flex-center flex-column py-3">
		<div class="container pt-5">
			<div class="row align-items-center">
				<div class="col-sm-6">
					<form name="<?php if($bico!='') echo $bico; ?>" class="card my-4 text-center rounded-lg" action="<?php echo base_url('daftar-selesai/'.$bico) ?>" method="post" style="padding:1.5rem!important">

						<h4 class="card-title my-4"><strong>Daftar</strong></h4>

						<div class="form-row mt-4">
							<div class="col">
								<input type="text" class="form-control" placeholder="Nama" name="nama" required>
								<hr>
							</div>
						</div>

						<div class="form-row mt-4">
							<div class="col">
								<input type="text" class="form-control" placeholder="Tempat Lahir" name="kota" required>
								<hr>
							</div>
							<div class="col">
								<input type="date" class="form-control" placeholder="Tanggal Lahir" name="tgl_lahir" required>
								<hr>
							</div>
						</div>

						<input onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text" class="form-control mt-4" placeholder="No Telepon" name="no_telepon" required>
						<hr>

						<input id="email" type="email" class="form-control mt-4" placeholder="E-mail" name="email">
						<hr class="mb-0">
						<div id="email_result">
							<p class='text-success small'> </p>
						</div>

						<input type="text" class="form-control mt-4" placeholder="Instansi" name="instansi" required>
						<hr>

						<div class="input-group pass_show mt-4">
							<input minlength="8" name="password" type="password" id="defaultSubscriptionFormEmail" class="pass_show form-control border-0 z-depth-0" placeholder="Password" required>
							<i class="ptxt py-1 fa fa-lg fa-eye fa-eye-slash grey-text" style="cursor: pointer"></i>
						</div>
						<hr>

						<button class="btn btn-indigo rounded-pill my-4 btn-block" type="submit">Daftar</button>

						<p>Sudah punya akun?
								<a href="<?php echo base_url('login') ?>">Login Sekarang</a>
						</p>

					</form>
				</div>
				<div class="col-lg-6 loginInfo text-center">
					<h4 class="grey-darken-text mx-auto font-weight mb-4 text-center">E-JUKUNG</h4>
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
$(document).ready(function() {
	$('#email').change(function() {
		var email	= $('#email').val();
		if (email != ''&&$('#email').is(':valid'))
		{
				$.ajax({
					url:"<?php echo base_url(); ?>welcome/email_check",
					method:"POST",
					data:{email:email},
					success:function(data){
						if (data==1) {
							$('#email_result').html("<p class='text-success small'>Email Belum Terdaftar</p>");
						}else {
							$('#email_result').html("<p class='text-danger small'>Email Sudah Terdaftar</p>");
						}
					}
				});
		}
	});
});

$(document).on('click','.pass_show .ptxt', function(){
	$(this).toggleClass("fa-eye-slash");
	$(this).toggleClass("black-text");
	$('#defaultSubscriptionFormEmail').attr('type', function(index, attr){return attr == 'password' ? 'text' : 'password'; });
});
</script>

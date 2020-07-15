<div class="white vh-100 vw-100" style="position: fixed;left: 0vw;z-index: -1;">
</div>
<div style="height: 100vh">
	<div class="flex-center flex-column">

		<div class="container h-100 ">
			<div class="row align-items-center h-100 p-3 text-center">
				<div class="col-lg-8 mx-aut loginInfo py-3  rounded-left">
					<h4 class="grey-darken-text mx-auto font-weight mb-4 text-center">E-JUKUNG</h4>
					<p class="grey-darken-text mb-4 pb-2 text-center">Sistem Pengelolaan Pelayanan <br>Perpustakaan Bank Indonesia Provinsi Kalimantan Selatan</p>
					<img src="<?php echo base_url('/assets/img/LOGIN.png') ?>" class="img-fluid mx-auto" style="height:300px">
					<div class="text-center white-text">
					</div>
				</div>
				<?php if (isset($bicorner) > 0 && $bicorner[0]->Id_perpustakaan != "") {
					$url = encrypt_url($bicorner[0]->Id_perpustakaan);
					$corner = "BI Corner " . $bicorner[0]->nama;
				} else {
					$url = "";
					$corner = "";
				} ?>
				<div class="white col-lg-4 text-center z-depth-1 p-5 rounded-lg mx-auto">
					<h2 class="heading">Login</h2>
					<h6 class="mb-5">Elektronik-Jelajah Pustaka Unggulan</h6>
					<?php if ($msg != "") : ?>
						<div class="alert alert-danger" role="alert">
							<?php echo $msg ?>
						</div>
					<?php endif; ?>
					<form action="<?php echo base_url('login/' . $url) ?>" method="post">

						<div class="input-group">
							<i class=" py-1 fa fa-lg fa-user  grey-text"></i>
							<input name="ID" type="text" id="defaultSubscriptionFormPassword" class=" border-0 form-control  z-depth-0" placeholder="Id" required>
						</div>
						<hr class="mt-0">

						<div class="input-group pass_show">
							<i class=" py-1 fa fa-lg fa-lock grey-text"></i>
							<input minlength="8" name="password" type="password" id="defaultSubscriptionFormEmail" class="pass_show form-control border-0 z-depth-0" placeholder="Password" required>
							<i style="cursor: pointer" class="ptxt py-1 fa fa-lg fa-eye fa-eye-slash grey-text"></i>
						</div>
						<hr class="mt-0">

						<div class="text-center">
							<button type="submit" min="1" class="btn btn-indigo btn-rounded rounded-pill px-5 w-100 my-4 waves-effect">Login</button>
						</div>

					</form>
					<p><a href="<?php echo base_url('daftar') ?>">Daftar</a> atau <a data-toggle="modal" data-target="#forgotPasswordModel">Lupa kata Sandi</a></p>

					<h6></h6>
				</div>
			</div>
		</div>
	</div>
</div>

<form class="was-validated" novalidate>
	<div class="modal fade" id="forgotPasswordModel" tabindex="-1" role="dialog">
		<div class="modal-dialog  modal-dialog-centered" role="document">
			<div class="modal-content">

				<div class="modal-header">
					<h4 class="modal-title">Lupa Kata Sandi</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>

				<div class="modal-body container">
					<p class="lead text-center text-muted pt-2 mb-3">Ketikan alamat surel anda, setelah kami verifikasi surel anda memang ada, akan kami kirimkan tautan pembuatan kata sandi ulang.</p>
					<div class="row mb-3">
						<div class="col">
							<label>Surel</label>
							<input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" class="form-control" id="reset-password-email" required>
						</div>
					</div>
				</div>
				<div class="modal-footer d-flex justify-content-between">
					<div class="footer-response"></div>
					<button onclick="isEmailExist()" class="btn mauve text-white" type="button" id="btn-reset-password">Kirim</button>
				</div>
			</div>
		</div>
	</div>
</form>
<script>
	
	var footer = $('.footer-response')
	var btnSend = $('#btn-reset-password')

	function showButtonLoading(button) {
		$(button).html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled')
	}

	function hideButtonLoading(button, text) {
		$(button).html(text).removeClass('disabled')
	}

	function footerResponse(response) {

		footer.empty()
		if (response) {
			footer.append(`<a class="ml-2" id="response"><i class="fas fa-check fa-2x mb-3 animated rotateIn green-text"></i> Sukses</a>`)
		} else {
			footer.append(`<a class="ml-2" id="response"><i class="fas fa-times fa-2x mb-3 animated rotateIn red-text"></i> Gagal</a>`)
		}

	}

	function sendReset(token, email) {

		$.post('<?php echo site_url('ResetPassword/sendReset') ?>', {
				token: token,
				email: email
			}).done(function(data,status) {
				hideButtonLoading(btnSend, 'Kirim')
				footerResponse(true)
			})
			.fail(function(e, _, __) {
				hideButtonLoading(btnSend, 'Kirim')
				footerResponse(false)
			})

	}

	function getToken(ID, email) {

		$.post('<?php echo site_url('ResetPassword/insertToken') ?>', {
				memberID: ID
			}).done(function(data, status) {
				var response = $.parseJSON(data)
				var token = response['token']
				sendReset(token, email)
			})
			.fail(function(e, _, __) {
				hideButtonLoading(btnSend, 'Kirim')
				footerResponse(false)
			})

	}



	function isEmailExist() {

		var forms = document.getElementsByClassName('was-validated');
		var validation = Array.prototype.filter.call(forms, function(form) {
			if (form.checkValidity() === false) {
				event.preventDefault();
				event.stopPropagation();
			} else {
				showButtonLoading(btnSend)
				var email = $('#reset-password-email').val()
				$.post('<?php echo site_url('ResetPassword/checkEmailAvailability') ?>', {
						email: email
					})
					.done(function(data, status) {
						var response = JSON.parse(data)[0]
						var isEmailExist = (response['Value'] == '1')
						var ID = response['ID']

						if (isEmailExist) {
							getToken(ID, email)
						} else {
							alert("Tidak menemukan surel yang cocok.")
							hideButtonLoading(btnSend, 'Kirim')
							footerResponse(false)
						}

					})
					.fail(function(e, _, __) {
						hideButtonLoading(btnSend, 'Kirim')
						footerResponse(false)
					})
			}
		});

	}

	$(document).on('click', '.pass_show .ptxt', function() {
		$(this).toggleClass("fa-eye-slash");
		$(this).toggleClass("black-text");
		$('#defaultSubscriptionFormEmail').attr('type', function(index, attr) {
			return attr == 'password' ? 'text' : 'password';
		});
	});
</script>
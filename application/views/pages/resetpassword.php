<div class="white vh-100 vw-100" style="position: fixed;left: 0vw;z-index: -1;"></div>
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
                <div class="white col-lg-4 text-center z-depth-1 p-5 rounded-lg mx-auto">
                    <h2 class="heading">Atur Ulang Kata Sandi</h2>
                    <h6 class="mb-5">Elektronik-Jelajah Pustaka Unggulan</h6>

                    <div class="input-group pass_show">
                        <i class=" py-1 fa fa-lg fa-lock grey-text"></i>
                        <input minlength="8" name="password" type="password" id="password-reset" class="pass_show form-control border-0 z-depth-0" placeholder="Kata Sandi Baru" required>
                        <i style="cursor: pointer" class="ptxt py-1 fa fa-lg fa-eye fa-eye-slash grey-text"></i>
                    </div>

                    <div class="text-center">
                        <button id="btn-reset-password" onclick="resetPassword()" class="btn btn-indigo btn-rounded rounded-pill px-5 w-100 my-4 waves-effect">Atur Ulang</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var memberID;
    var btnResetPassword = $('#btn-reset-password');

    $(document).ready(function() {
        $.post("<?php echo site_url('resetpassword/istokenvalid') ?>", {
                token: '<?php echo $token ?>'
            })
            .done(function(data, status) {

                var response = JSON.parse(data)[0]
                if (response) {

                    memberID = response['memberID']
                    var createdAt = new Date().getDate(response['createdAt'])
                    var today = new Date().getDate()
                    var token = response['token']

                    if (today != createdAt) {
                        alert('Masa token sudah habis')
                        window.location.replace('<?php echo site_url() ?>')
                    } else {}

                } else {
                    alert('Token tidak sah!')
                    window.location.replace('<?php echo site_url() ?>')
                }

            })
            .fail(function(e, status, thrown) {
                alert('Token tidak sah atau server bermasalah')
                window.location.replace('<?php echo site_url() ?>')
            })
    })

    function resetPassword() {

        var password = $('#password-reset').val()
        showButtonLoading(btnResetPassword)
        $.post("<?php echo site_url('resetpassword/resetPassword') ?>", {
                memberID: memberID,
                password: password
            })
            .done(function(data, status) {
                hideButtonLoading(btnResetPassword, 'Atur Ulang')
                alert('Silahkan masuk dengan kata sandi baru anda.')
                window.location.replace('<?php echo site_url() ?>')
            })
            .fail(function(e, status, thrown) {
                hideButtonLoading(btnResetPassword, 'Atur Ulang')
                alert('Server mengalami masalah')
            })

    }

	function showButtonLoading(button) {
		$(button).html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled')
	}

	function hideButtonLoading(button, text) {
		$(button).html(text).removeClass('disabled')
	}

    $(document).on('click', '.pass_show .ptxt', function() {
        $(this).toggleClass("fa-eye-slash");
        $(this).toggleClass("black-text");
        $('#defaultSubscriptionFormEmail').attr('type', function(index, attr) {
            return attr == 'password' ? 'text' : 'password';
        });
    });
</script>
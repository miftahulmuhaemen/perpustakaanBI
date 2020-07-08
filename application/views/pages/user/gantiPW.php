<style media="screen">
.pass_show{position: relative}

.pass_show .ptxt {

position: absolute;

top: 50%;

right: 10px;

z-index: 1;

color: #f36c01;

margin-top: -10px;

cursor: pointer;

transition: .3s ease all;

}

.pass_show .ptxt:hover{color: #333333;}
</style>
<div class="container py-5 card" style="padding:1.5rem!important">

	<h4 class="card-title mx-auto my-5"><strong>Ganti Password</strong></h4>
	<!--Section: Content-->
	<section class="px-md-5 mx-md-5 text-center text-lg-left dark-grey-text">

		<div class="row d-flex justify-content-center">

			<div class="col-md-6 mb-5">

				<form  action="<?php echo base_url('user/updatePW/') ?>" method="post" id="passwordForm">
					<label>Password Sekarang</label>
					<div class="form-group pass_show">
						<input type="password" value="faisalkhan@123" class="form-control" placeholder="Current Password">
					</div>
					<label>Password Baru</label>
					<div class="form-group pass_show">
							<input id="id1" type="password" value="faisal.khan@123" class="form-control" placeholder="New Password">
					</div>
					<div class="text-center">
						<button type="submit" class="btn btn-indigo btn-rounded rounded-pill px-5 w-100 my-4 waves-effect">Simpan</button>
					</div>

				</form>
				<!-- Default form register -->

			</div>
			<!--Grid column-->

		</div>
		<!--Grid row-->


	</section>
	<!--Section: Content-->


</div>
<script>
$(document).ready(function(){
$('.pass_show').append('<span class="ptxt">Show</span>');
});


$(document).on('click','.pass_show .ptxt', function(){

$(this).text($(this).text() == "Show" ? "Hide" : "Show");

$(this).prev().attr('type', function(index, attr){return attr == 'password' ? 'text' : 'password'; });

});

</script>

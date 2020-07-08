
<style media="screen">
.text{
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    width: 410px;
}
.box{

		position: relative;

		display: inline-block; /* Make the width of box same as image */

}

.box .text{

		position: absolute;

		z-index: 999;

		left: 50px;

		top: 35%; /* Adjust this value to move the positioned div up and down */

		text-align: left;

		width: 60%; /* Set the width of the positioned div */

}
</style>

<script src="https://files.codepedia.info/files/uploads/iScripts/html2canvas.js"></script>
<div style="width: 634px;	padding-left: 25px; padding-top: 10px;">
		<div id="html-content-holder"  class="box card mx-auto" style="width: 634px;height:448.8px">
			<img src="<?php echo base_url('assets/img/e-card.jpg') ?>" alt="thumbnail" class="mx-auto img-thumbnail" >
			<div class="text">
				<p class="h2 mb-0" style="color:#1a237e">Id. <?php echo decrypt_url($this->session->userdata('id_anggota')); ?></p>
				<p class="h2 mb-0" style="color:#1a237e"><?php echo $this->session->userdata('nama'); ?></p>
				<h5 style="color:#870700"><?php echo $this->session->userdata('instansi'); ?></h5>
				<h5 style="color:#870700">Exp. <?php echo date_format(date_create($this->session->userdata('expired')),"d M Y")?></h5>
			</div>
		</div>
</div>
<a id="btn-Convert-Html2Image" class="btn btn-primary rounded-pill mx-auto" style="margin-left:25px!important"><i class="fas fa-cart-plus mr-2" aria-hidden="true"></i> Simpan Kartu</a>


<script>
$(document).ready(function(){
	var element = $("#html-content-holder"); // global variable
	var getCanvas; // global variable

	html2canvas(element, {
		onrendered: function (canvas) {
					 $("#html-content-holder").html(canvas);
					 getCanvas = canvas;
		}
	});
	$("#btn-Convert-Html2Image").on('click', function () {
		var imgageData = getCanvas.toDataURL("image/png");
		// Now browser starts downloading it instead of just showing it
		var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
		$("#btn-Convert-Html2Image").attr("download", "<?php echo $this->session->userdata('id_anggota') ?>.png").attr("href", newData);
	});
});

</script>

<script>
	$(window).load(function(){
		$('.wrapper').css({'background': '#F0F0F0', 'padding': '15px'});
		$('.sidebar, .main-panel, .navbar-collapse, .navbar, .footer').remove();
	}) 
</script>

<form action="<?php base_url() ?>administrable_tables/upload_image" method="post" enctype="multipart/form-data">
	<input type="hidden" value="<?= $gallery ?>" name="gallery">
	<input type="hidden" value="<?= $table ?>" name="table">
	<div class="fileUpload fileUpload-iframe btn btn-default btn-fill">
	    <span>Upload</span>
	    <input type="file" class="upload" onchange="this.form.submit();"/>
	</div>
</form><br><br><hr>
<div class="row">
	<div class="col-md-12">
		<ul>
		<?php if ($images){ ?>
			<?php foreach ($images as $image) { ?>
				<li>$image</li>
			<?php } ?>
		<?php }else{ ?>
			<p class="empty-gallery">Click on the button to start uploading images or documents</p>
		<?php } ?>
		</ul>
	</div>
</div>
<?php
	$gallery_id = urlencode(substr(base64_encode(openssl_random_pseudo_bytes('30')), 0, 22));
	$gallery_id = strtr($gallery_id, array('/' => '')); 
?>
<input type="hidden" class="save-input" name="<?= $field['name'] ?>" value="<?= $gallery_id ?>">
<div class="form-group">
	<label class="field"><strong><?= $field['name'] ?></strong></label>
   	<iframe class="iframe-gallery" src="<?= base_url() ?>administrable_tables/gallery/<?= $table ?>?gallery=<?= $gallery_id ?>" frameborder="0"></iframe>
</div><hr>  
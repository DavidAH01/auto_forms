<?php
	$gallery_id = urlencode(substr(base64_encode(openssl_random_pseudo_bytes('30')), 0, 22));
	$gallery_id = str_replace(array('/'), array(''), $gallery_id);
?>
<input type="hidden" class="save-input" name="<?= $field['complete_name'] ?>" value="<?= $gallery_id ?>">
<div class="form-group">
	<label class="field"><strong><?= $field['name'] ?></strong></label>
   	<iframe class="iframe-gallery" src="<?= base_url() ?>administrable_tables/gallery/<?= $current_table ?>?gallery=<?= $gallery_id ?>" frameborder="0"></iframe>
</div><hr>  
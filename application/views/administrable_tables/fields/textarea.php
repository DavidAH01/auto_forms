<div class="form-group">
    <label class="field"><strong><?= $field['name'] ?></strong></label>
    <textarea class="save-input tinymce" data-type="textarea" id="<?= $field['complete_name'] ?>" name="<?= $field['complete_name'] ?>"></textarea>
</div><hr>
<script>
	<?php if(isset($stored_data)){ ?>
		$(window).load(function(){
			tinyMCE.get("<?= $field['complete_name'] ?>").setContent("<?= addslashes(trim(preg_replace('[\n|\r|\n\r]', '',$stored_data->{$field['complete_name']}))) ?>"); 
		});
	<?php } ?>
</script>
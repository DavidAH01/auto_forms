<div class="form-group">
	<label class="field"><strong><?= $field['name'] ?></strong></label>
	<br>
	<input id="<?= $field['complete_name'] ?>" class="path-file form-control" placeholder="<?= $field['name'] ?>" disabled="disabled" />
	<div class="fileUpload btn btn-default btn-fill">
	    <span>Upload</span>
	    <input id="upload-<?= $field['complete_name'] ?>" type="file" class="save-input upload" name="<?= $field['complete_name'] ?>" />
	</div>
</div><hr>
<script>
	$("#upload-<?= $field['complete_name'] ?>").on('change', function(){
		$("#<?= $field['complete_name'] ?>").val( $(this).val() );
	})
</script>
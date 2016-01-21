<div class="form-group">
    <label class="field"><strong><?= $field['name'] ?></strong></label>
</div>
<?php foreach ($field['options'] as $option) { ?>
	<label class="checkbox">	
		<input type="checkbox" name="<?= $field['complete_name'] ?>" class="save-input" data-type="checkbox" data-toggle="checkbox" value="<?= $option ?>">
	</label><span class="option-checkbox"><?= $option ?></span>
	<br> 
<?php } ?>
<hr>
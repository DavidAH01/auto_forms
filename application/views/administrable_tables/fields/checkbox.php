<div class="form-group">
    <label class="field"><strong><?= $field['name'] ?></strong></label>
</div>
<?php foreach ($field['options'] as $option) { ?>
	<label class="checkbox">	
		<input type="checkbox" name="<?= $field['complete_name'] ?>" class="save-input" data-type="checkbox" data-toggle="checkbox" value="<?= $option ?>" <?= (isset($stored_data) && in_array($option, explode(',',$stored_data->{$field['complete_name']})))?'checked':'' ?>>
	</label><span class="option-checkbox"><?= $option ?></span>
	<br> 
<?php } ?>
<hr>
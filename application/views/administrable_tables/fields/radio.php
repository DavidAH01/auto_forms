<div class="form-group">
    <label class="field"><strong><?= $field['name'] ?></strong></label>
</div>
<?php foreach ($field['options'] as $option) { ?>
	<label class="radio">
	    <input type="radio" name="<?= $field['complete_name'] ?>" class="save-input" data-type="radio" data-toggle="radio" value="<?= $option ?>" <?= (isset($stored_data) && ($option == $stored_data->{$field['complete_name']}))?'checked':'' ?>>
	</label><span class="option-checkbox"><?= $option ?></span>
	<br> 
<?php } ?>
<hr>
<div class="form-group">
    <label class="field"><strong><?= $field['name'] ?></strong></label>
</div>
<?php foreach ($field['options'] as $option) { ?>
	<label class="radio">
	    <input type="radio" name="<?= $field['complete_name'] ?>" class="save-input" data-toggle="radio" value="<?= $option ?>">
	</label><span class="option-checkbox"><?= $option ?></span>
	<br> 
<?php } ?>
<hr>
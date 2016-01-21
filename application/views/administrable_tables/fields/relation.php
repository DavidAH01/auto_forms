<div class="form-group">
    <label class="field"><strong><?= $field['name'] ?></strong></label>
    <select class="save-input form-control" name="<?= $field['complete_name'] ?>">
    	<option value="">Select one</option>
    	<?php foreach ($field['options'] as $option) { ?>
			<option value="<?= $option['id'] ?>"><?= $option['name'] ?></option>
    	<?php } ?>
    </select>
</div><hr>
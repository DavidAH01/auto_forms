<div class="form-group multiselect-group">
    <label class="field"><strong><?= $field['name'] ?></strong></label>
    <select class="save-input form-control multiselect" multiple="multiple" name="<?= $field['complete_name'] ?>">
    	<?php foreach ($field['options'] as $option) { ?>
			<option value="<?= $option ?>" <?= (isset($stored_data) && in_array($option, explode(',',$stored_data->{$field['complete_name']})))?'selected':'' ?> ><?= $option ?></option>
    	<?php } ?>
    </select>
</div><hr>
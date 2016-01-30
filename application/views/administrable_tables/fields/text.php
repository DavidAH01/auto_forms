<div class="form-group">
    <label class="field"><strong><?= $field['name'] ?></strong></label>
    <input type="text" class="save-input form-control" name="<?= $field['complete_name'] ?>" placeholder="<?= $field['name'] ?>" value="<?= (isset($stored_data))?$stored_data->{$field['complete_name']}:'' ?>" <?= (isset($field['configuration']) && $field['configuration'] == "readonly")?"readonly":"" ?> >
</div><hr>
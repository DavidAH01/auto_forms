<div class="form-group">
	<label class="field"><strong><?= $field['name'] ?></strong></label>
    <div class="input-group date" id="date-<?= $field['complete_name'] ?>">
        <input type="text" class="save-input form-control" name="<?= $field['complete_name'] ?>" placeholder="<?= $field['name'] ?>" value="<?= (isset($stored_data))?$stored_data->{$field['complete_name']}:'' ?>" >
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
        </span>
    </div>
</div><hr>
<script>
	$(function () {
		$("#date-<?= $field['complete_name'] ?>").datetimepicker({
			format: "<?= $field['configuration'] ?>",
		});
	});
</script>
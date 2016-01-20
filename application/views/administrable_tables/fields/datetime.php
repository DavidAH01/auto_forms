<div class="form-group">
	<label class="field"><strong><?= $field['name'] ?></strong></label>
    <div class="input-group date" id="date-<?= $count_fields ?>">
        <input type="text" class="save-input form-control" name="<?= $field['complete_name'] ?>" placeholder="<?= $field['name'] ?>" value="" >
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
        </span>
    </div>
</div>
<script>
	$(function () {
		$('#date-<?= $count_fields ?>').datetimepicker({
			format: "<?= $field['configuration'] ?>",
		});
	});
</script>
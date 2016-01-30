<div class="form-group">
    <label class="field"><strong><?= $field['name'] ?></strong></label>
	<button class="jscolor
	    {required:false, valueElement:'color-<?= $field['complete_name'] ?>', styleElement:'style-<?= $field['complete_name'] ?>', onFineChange:'update(this)'}
	    btn btn-default btn-fill pull-right">
	    <?= $this->lang->line('pick_a_color'); ?>
	</button><br><br>
	<div class="row">
		<div class="col-sm-2">
			<input readonly id="style-<?= $field['complete_name'] ?>" class="form-control">
		</div>
		<div class="col-sm-10">
			<input id="color-<?= $field['complete_name'] ?>" class="save-input form-control" name="<?= $field['complete_name'] ?>" placeholder="<?= $field['name'] ?>" value="<?= (isset($stored_data))?$stored_data->{$field['complete_name']}:'' ?>"><br>
		</div>
	</div>
</div><hr> 
<script>
	function update(picker) {
		<?php if(empty($field['configuration'])){ ?>
			var type = '';
		<?php }else{ ?>
			var type = <?= $field['configuration'] ?>
		<?php } ?>

	   	if(type == 'rgb'){
	   		$("#color-<?= $field['complete_name'] ?>").val(picker.toRGBString());
	   	}else if(type == 'hsv'){
	   		$("#color-<?= $field['complete_name'] ?>").val('hsv('+Math.round(picker.hsv[0]) + '%, ' + Math.round(picker.hsv[1]) + '%, ' + Math.round(picker.hsv[2]) + '%)');
	   	}else{
	   		$("#color-<?= $field['complete_name'] ?>").val(picker.toHEXString());
	   	}
	}
</script>
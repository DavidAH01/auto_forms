<div class="form-group">
    <label class="field"><strong><?= $field['name'] ?></strong></label>
    <input type="text" id="slider-<?= $field['complete_name'] ?>" class="save-input input-slider form-control" name="<?= $field['complete_name'] ?>" placeholder="<?= $field['name'] ?>" >
	<div id="line-slider-<?= $field['complete_name'] ?>" class="div-slider"></div>
</div><hr>
<script>
	var configuration = [<?= $field['configuration'] ?>],
		min = configuration[0] == '' ? 0 : configuration[0],
		max = configuration[1] == '' ? 100 : configuration[1],
		step = configuration[2] == '' || configuration[2] == undefined ? 1 : configuration[2];
		range = configuration[3] == '' || configuration[3] == undefined ? false : configuration[3];

	if(range){
		$( "#line-slider-<?= $field['complete_name'] ?>" ).slider({
	      	range: true,
	      	min: parseFloat(min),
	      	max: parseFloat(max),
	      	step: parseFloat(step),
	      	slide: function( event, ui ) {
	        	$( "#slider-<?= $field['complete_name'] ?>" ).val( ui.values[ 0 ] + " - " + ui.values[ 1 ] );
	      	}
	    });
	    $( "#slider-<?= $field['complete_name'] ?>" ).val( $("#line-slider-<?= $field['complete_name'] ?>" ).slider( "values", 0 ) +
	      " - " + $( "#line-slider-<?= $field['complete_name'] ?>" ).slider( "values", 1 ) );
	
	    <? if(isset($stored_data)) { ?>
			var values = [<?= str_replace(array(' ','-'), array('',','), $stored_data->{$field['complete_name']}) ?>],
				value_1 = values[0] == '' ? min : values[0],
				value_2 = values[1] == '' ? min : values[1];
			$( "#line-slider-<?= $field['complete_name'] ?>" ).slider('values',0,value_1);
			$( "#line-slider-<?= $field['complete_name'] ?>" ).slider('values',1,value_2);
			$( "#slider-<?= $field['complete_name'] ?>" ).val( value_1 + " - " + value_2 );
		<? } ?>

	}else{
		$( "#line-slider-<?= $field['complete_name'] ?>" ).slider({
	      	range: "min",
	      	min: parseFloat(min),
	      	max: parseFloat(max),
	      	step: parseFloat(step),
	      	slide: function( event, ui ) {
	        	$( "#slider-<?= $field['complete_name'] ?>" ).val( ui.value );
	      	}
	    });
	 	$( "#slider-<?= $field['complete_name'] ?>" ).val( $( "#line-slider-<?= $field['complete_name'] ?>" ).slider( "value" ) );
	   	
	   	$( "#line-slider-<?= $field['complete_name'] ?>" ).slider('value',<?= (isset($stored_data))?$stored_data->{$field['complete_name']}:0 ?>);	      	
		$( "#slider-<?= $field['complete_name'] ?>" ).val( <?= (isset($stored_data))?$stored_data->{$field['complete_name']}:0 ?> );
	}
</script>
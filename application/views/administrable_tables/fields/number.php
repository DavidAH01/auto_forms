<div class="form-group">
    <label class="field"><strong><?= $field['name'] ?></strong></label>
    <input type="text" class="save-input form-control number-<?= $field['complete_name'] ?>" name="<?= $field['complete_name'] ?>" placeholder="<?= $field['name'] ?>" value="<?= (isset($stored_data))?$stored_data->{$field['complete_name']}:'' ?>">
</div><hr>
<script>
	var numberFormat = function(number, decimals, m, d){
		var decimals = decimals == undefined ? 2 : decimals, 
			m = m == undefined ? "," : m,
		    d = d == undefined ? "." : d 
		    
	    var str = number.toString(), parts = false, output = [], i = 1, formatted = null;
	    if(str.indexOf(d) > 0) {
	        parts = str.split(d);
	        str = parts[0];
	    }
	    str = str.split("").reverse();
	    for(var j = 0, len = str.length; j < len; j++) {
	        if(str[j] != m) {
	            output.push(str[j]);
	            if(i%3 == 0 && j < (len - 1)) {
	                output.push(m);
	            }
	            i++;
	        }
	    }
	    formatted = output.reverse().join("");
	    return(formatted + ((parts) ? d + parts[1].substr(0, decimals) : ""));
	};

	$('.number-<?= $field['complete_name'] ?>').keyup(function() {
		var value = numberFormat($(this).val(), <?= $field['configuration'] ?>);
		$(this).val(value);
	});
</script>
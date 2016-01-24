$(document).ready(function(){
	$('.create-auto-form').click(function(e){
		e.preventDefault();
		var data = new FormData();
		$('.auto-form .save-input, .auto-form .save-input:selected').each(function() {
			if ($(this).attr('data-type') == 'textarea'){
				data.append($(this).attr('name'),tinyMCE.get( $(this).attr('id') ).getContent());
			}else if ($(this).attr('data-type') == 'checkbox'){
				if (data[$(this).attr('name')] == undefined) {
					var array = [];
					$('.auto-form .save-input[name="'+$(this).attr('name')+'"]:checked').each(function() {
					   array.push($(this).val());
					});
					data.append($(this).attr('name'),array);
				}
			}else{
				data.append($(this).attr('name'),$(this).val());
			}
		});

		$.each($("input[type=file]"), function(i, obj) {
	        $.each(obj.files,function(j,file){
	            data.append('file['+$(obj).attr('name')+']', file);
	        })
		});

		$.each(data, function(key, value) {
		    if (Array.isArray(value))
		    	data[key] = value.join();
		});

		$.ajax({
		  	url: $('#base_url').val()+'administrable_tables/insert_table',
		  	method: 'post',
		  	cache: false,
	    	contentType: false,
	    	processData: false,
		  	data: data
		}).done(function() {
			window.location.href = $('#base_url').val()+'administrable_tables/view/'+$('input[name="current_table"]').val();
		})

	})

	$('.update-auto-form').click(function(e){
		e.preventDefault();
		var data = new FormData();
		$('.auto-form .save-input, .auto-form .save-input:selected').each(function() {
			if ($(this).attr('data-type') == 'textarea'){
				data.append($(this).attr('name'),tinyMCE.get( $(this).attr('id') ).getContent());
			}else if ($(this).attr('data-type') == 'checkbox'){
				if (data[$(this).attr('name')] == undefined) {
					var array = [];
					$('.auto-form .save-input[name="'+$(this).attr('name')+'"]:checked').each(function() {
					   array.push($(this).val());
					});
					data.append($(this).attr('name'),array);
				}
			}else{
				data.append($(this).attr('name'),$(this).val());
			}
		});

		$.each($("input[type=file]"), function(i, obj) {
	        $.each(obj.files,function(j,file){
	            data.append('file['+$(obj).attr('name')+']', file);
	        })
		});

		$.each(data, function(key, value) {
		    if (Array.isArray(value))
		    	data[key] = value.join();
		});

		$.ajax({
		  	url: $('#base_url').val()+'administrable_tables/update_table',
		  	method: 'post',
		  	cache: false,
	    	contentType: false,
	    	processData: false,
		  	data: data
		}).done(function() {
			$.notify({
        		icon: "pe-7s-check",
        		message: "The information has been updated!"
	        },{
	            type: 'warning',
	            timer: 4000,
	            placement: {
	                from: 'bottom',
	                align: 'left'
	            }
	        });
		})
	});

	
})
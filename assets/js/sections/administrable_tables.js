$(document).ready(function(){
	$('.create-auto-form').click(function(e){
		e.preventDefault();
		var data = new FormData();
		$('.auto-form .save-input, .auto-form .save-input:selected').each(function() {
			if ($(this).attr('data-type') == 'textarea'){
				data.append($(this).attr('name'),tinyMCE.get( $(this).attr('id') ).getContent());
			}else if ($(this).attr('data-type') == 'checkbox' || $(this).attr('data-type') == 'radio'){
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

		if ($('.clone-wrapper').length > 0) {
			$('.clone-wrapper').each(function(index, el) {
				var field, steps = [];
				field = $(el).attr('data-field');
				$(el).find('.toclone').each(function(index, el) {
					var obj = {}
					$(el).find('.info-step').each(function(index_input, el) {
						var type = $(el).attr('data-type')
						var name = $(el).attr('name');
						var value = $(el).val();
						if (type == "textarea")
							value = tinyMCE.get('content-'+field+'-'+index).getContent()

						obj[name] = value;
					});
					steps.push(obj);
				});
				data.append(field, JSON.stringify(steps));
			});
		}

		if ($('.sortable-list-field').length > 0) {
			$('.sortable-list-field').each(function(index, el) {
				var field, items = "";
				field = $(el).attr('data-field');
				count = $(el).find('li').length;
				$(el).find('li').each(function(index, el) {
					items += $(el).find('.content').text();
					if (index < count -1) {
						items+=',';		
					}
				});
				data.append(field, items);
			});
		}

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
		  	data: data,
		  	beforeSend: function() {
			    $('.create-auto-form').fadeOut(0);
			    $('#icon-loading').fadeIn(0);
			}
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
			}else if ($(this).attr('data-type') == 'checkbox' || $(this).attr('data-type') == 'radio'){
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

		if ($('.clone-wrapper').length > 0) {
			$('.clone-wrapper').each(function(index, el) {
				var field, steps = [];
				field = $(el).attr('data-field');
				$(el).find('.toclone').each(function(index, el) {
					var obj = {}
					$(el).find('.info-step').each(function(index_input, el) {
						var type = $(el).attr('data-type')
						var name = $(el).attr('name');
						var value = $(el).val()
						if (type == "textarea")
							value = tinyMCE.get('content-'+field+'-'+index).getContent()

						obj[name] = value;
					});
					steps.push(obj);
				});
				data.append(field, JSON.stringify(steps));
			});
		}

		if ($('.sortable-list-field').length > 0) {
			$('.sortable-list-field').each(function(index, el) {
				var field, items = "";
				field = $(el).attr('data-field');
				count = $(el).find('li').length;
				$(el).find('li').each(function(index, el) {
					items += $(el).find('.content').text();
					if (index < count-1) {
						items+=',';		
					}
				});
				data.append(field, items);
			});
		}

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
		  	data: data,
		  	beforeSend: function() {
			    $('.update-auto-form').fadeOut(0);
			    $('#icon-loading').fadeIn(0);
			}
		}).done(function(response) {
			$('.update-auto-form').fadeIn(0);
			$('#icon-loading').fadeOut(0);
			$.notify({
        		icon: "pe-7s-check",
        		message: response.msg
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

	$(document).on('click', '#remove-all-administrable-tables', function(){
		var response = confirm( $('#are_you_sure').val() );
		if (response == true) {
		    var array_delete = [];
			$('tr[role="row"].selected').each(function(){
				var id = $(this).attr('id');
				array_delete.push(id);
			})

			$.ajax({
			  	url: $('#base_url').val()+'administrable_tables/delete_records',
			  	method: 'post',
			  	data: { records: array_delete, table: $('#remove-all-administrable-tables').attr('data-table')}
			}).done(function() {
				location.reload();
			});
	
		}
	})
});
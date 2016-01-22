$(document).ready(function(){
	$('.create-administrator').click(function(e){
		e.preventDefault();
		var data = {}
		$('.save-input').each(function(){
			data[ $(this).attr('name') ] = $(this).val()
		})

		$('.save-input:checked').each(function(){
			data[ $(this).attr('name') ] = $(this).val()
		})

		$.each(data, function(key, value) {
		    if (Array.isArray(value))
		    	data[key] = value.join();
		});

		if ( $('input[name="name"]').val() != "" && $('input[name="email"]').val() != "" && $('input[name="password"]').val() != "" ) {
			expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    		if ( expr.test($('input[name="email"]').val()) ){
    			$.ajax({
				  	url: $('#base_url').val()+'administrators/new_administrator',
				  	method: 'post',
				  	data: data
				}).done(function(response) {
					if (response.error) {
						$.notify({
			        		icon: "pe-7s-info",
			        		message: "This email is already registered!"
				        },{
				            type: 'danger',
				            timer: 4000,
				            placement: {
				                from: 'bottom',
				                align: 'left'
				            }
				        });
					}else{
						window.location.href = $('#base_url').val()+'administrators';
					}
				  	
				});
    		}else{
    			$.notify({
	        		icon: "pe-7s-info",
	        		message: "The email is invalid!"
		        },{
		            type: 'danger',
		            timer: 4000,
		            placement: {
		                from: 'bottom',
		                align: 'left'
		            }
		        });
    		}
		}else{
			$.notify({
        		icon: "pe-7s-info",
        		message: "Name, email and password are required!"
	        },{
	            type: 'danger',
	            timer: 4000,
	            placement: {
	                from: 'bottom',
	                align: 'left'
	            }
	        });
		}
    })



	$('.update-administrator').click(function(e){
		e.preventDefault();
		var data = {}
		$('.save-input').each(function(){
			data[ $(this).attr('name') ] = $(this).val()
		})

		$('.save-input:checked').each(function(){
			data[ $(this).attr('name') ] = $(this).val()
		})

		$.each(data, function(key, value) {
		    if (Array.isArray(value))
		    	data[key] = value.join();
		});

		if ( $('input[name="name"]').val() != "" && $('input[name="email"]').val() != "") {
			expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    		if ( expr.test($('input[name="email"]').val()) ){
    			$.ajax({
				  	url: $('#base_url').val()+'administrators/edit_administrator',
				  	method: 'post',
				  	data: data
				}).done(function(response) {
					if (response.error) {
						$.notify({
			        		icon: "pe-7s-info",
			        		message: "This email is already registered!"
				        },{
				            type: 'danger',
				            timer: 4000,
				            placement: {
				                from: 'bottom',
				                align: 'left'
				            }
				        });
					}else{
						$.notify({
			        		icon: "pe-7s-check",
			        		message: "The information has been updated!"
				        },{
				            type: 'info',
				            timer: 4000,
				            placement: {
				                from: 'bottom',
				                align: 'left'
				            }
				        });
					}
				  	
				});
    		}else{
    			$.notify({
	        		icon: "pe-7s-info",
	        		message: "The email is invalid!"
		        },{
		            type: 'danger',
		            timer: 4000,
		            placement: {
		                from: 'bottom',
		                align: 'left'
		            }
		        });
    		}
		}else{
			$.notify({
        		icon: "pe-7s-info",
        		message: "Name, email are required!"
	        },{
	            type: 'danger',
	            timer: 4000,
	            placement: {
	                from: 'bottom',
	                align: 'left'
	            }
	        });
		}
    })

	$(document).on('click', '#remove-all', function(){
		var response = confirm("Are you sure?");
		if (response == true) {
		    var array_delete = [];
			$('tr[role="row"].selected').each(function(){
				var id = $(this).attr('data-administrator');
				array_delete.push(id);
			})

			$.ajax({
			  	url: $('#base_url').val()+'administrators/delete_administrators',
			  	method: 'post',
			  	data: { users: array_delete }
			}).done(function(response) {
				window.location.href = $('#base_url').val()+'administrators';
			});
	
		}
	})
})

$(window).load(function(){
	$('#form-new-administrator input.clear').val('')
})
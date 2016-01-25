$(document).ready(function(){
	var image = $('.sidebar.auth').attr('data-image');
	$('.sidebar.auth').css( 'background-image', 'url('+image+')' )

	$('#forgot-password').click(function(e){
		e.preventDefault();
		$(this).fadeOut(0);
		$('.content-login').fadeOut(0);
		$('.content-recover-password').fadeIn(0)
	})

	$('#close-recover').click(function(e){
		e.preventDefault();
		$('#forgot-password').fadeIn(0);
		$('.content-login').fadeIn(0);
		$('.content-recover-password').fadeOut(0);
	})

	$('.recover-password').click(function(e){
		e.preventDefault();
		if ($('input.recovery-email').val() != "") {
			expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    		if (expr.test($('input.recovery-email').val())){
    			$.ajax({
				  	url: $('#base_url').val()+'auth/recover_password',
				  	method: 'post',
				  	data: {email: $('input.recovery-email').val()}
				}).done(function(response) {
					if (response.error) {
						$.notify({
			        		icon: "pe-7s-info",
			        		message: "An error has occurred, try it later"
				        },{
				            type: 'warning',
				            timer: 4000,
				            placement: {
				                from: 'bottom',
				                align: 'left'
				            }
				        });
					}else{
						$.notify({
			        		icon: "pe-7s-check",
			        		message: "We send information to your email"
				        },{
				            type: 'warning',
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
	        		message: "The email is invalid"
		        },{
		            type: 'warning',
		            timer: 4000,
		            placement: {
		                from: 'bottom',
		                align: 'left'
		            }
		        });
		    }
		}
	});

	$('.update-password').click(function(e){
		e.preventDefault();
		if ($('input.new-password').val() != "") {
			$.ajax({
			  	url: $('#base_url').val()+'auth/save_password',
			  	method: 'post',
			  	data: {id: $('input.user-id').val(), hash: $('input.recovery-hash').val(), password: $('input.new-password').val()}
			}).done(function(response) {
				if (response.error) {
					$.notify({
		        		icon: "pe-7s-info",
		        		message: "You are not allowed to change the password"
			        },{
			            type: 'warning',
			            timer: 4000,
			            placement: {
			                from: 'bottom',
			                align: 'left'
			            }
			        });
				}else{
					$.notify({
		        		icon: "pe-7s-check",
		        		message: "The password has been updated. Go to the login"
			        },{
			            type: 'warning',
			            timer: 4000,
			            placement: {
			                from: 'bottom',
			                align: 'left'
			            }
			        });
				}
			});
		}
	})
})
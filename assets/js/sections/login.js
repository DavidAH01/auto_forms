$(document).ready(function(){

	var image = $('.sidebar.auth').attr('data-image');
	$('.sidebar.auth').css( 'background-image', 'url('+image+')' )

	$('#forgot-password').click(function(e){
		e.preventDefault();
		$(this).fadeOut('slow')
		$('.content-recover-password').fadeIn('slow')
	})

	$('#close-recover').click(function(){
		$('#forgot-password').fadeIn('slow')
		$('.content-recover-password').fadeOut('slow')
	})

})
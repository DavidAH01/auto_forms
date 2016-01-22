$(document).ready(function(){

	var image = $('.sidebar.auth').attr('data-image');
	$('.sidebar.auth').css( 'background-image', 'url('+image+')' )

	$('#forgot-password').click(function(e){
		e.preventDefault();
		$(this).fadeOut(0);
		$('.content-login').fadeOut(0);
		$('.content-recover-password').fadeIn(0)
	})

	$('#close-recover').click(function(){
		$('#forgot-password').fadeIn(0);
		$('.content-login').fadeIn(0);
		$('.content-recover-password').fadeOut(0);
	})

})
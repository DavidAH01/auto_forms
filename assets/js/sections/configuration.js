$(document).ready(function(){
	$('.update-configuration').click(function(e){
		e.preventDefault();
		var data = {}
		$('.save-input').each(function(){
			data[ $(this).attr('name') ] = $(this).val()
		})
		$.ajax({
		  	url: $('#base_url').val()+'configuration/edit_configuration',
		  	method: 'post',
		  	data: data
		}).done(function(response) {
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
		});
    })
})
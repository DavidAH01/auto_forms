$(document).ready(function(){
	$(document).on('change', '#tasks input[type="checkbox"]', function() {
        var id = $(this).val();
        var state = 0;
        if($(this).is(":checked"))
            state = 1

        $.ajax({
		  	url: $('#base_url').val()+'dashboard/change_state_task',
		  	method: 'post',
		  	data: { id: id, state: state }
		});
    });

    $(document).on('click', '.delete-task', function(){
    	var id = $(this).attr('data-task');
    	if (confirm("Are you sure?")) { 
		  	$.ajax({
			  	url: $('#base_url').val()+'dashboard/delete_task',
			  	method: 'post',
			  	data: { id: id }
			}).done(function() {
			  	$('#tr-task-'+id).remove();

			  	if ( $('#tasks tr').length <= 0 )
			  		$('.empty-task').fadeIn(0);

                $.notify({
                    icon: "pe-7s-check",
                    message: "The task has been deleted!"
                },{
                    type: 'warning',
                    timer: 4000,
                    placement: {
                        from: 'bottom',
                        align: 'left'
                    }
                });
			});
		}
    })

    $(document).on('click', 'button.edit-task', function(){
        var el = $(this);
        $('#edit-task').modal({
            show: true
        });
        var id = el.attr('data-task');
    	var description = el.attr('data-description');
    	var is_private = el.attr('data-privacy');
    	$('#form-edit-task textarea').val(description);
        $('.select-privacy').val(is_private);
    	$('.update-task').attr('data-task', id);
    })

    $('.create-task').click(function(){
    	var description = $('#form-create-task textarea').val();
    	var is_private = $('#form-create-task select option:selected').val();
    	if (description != '') {
    		$.ajax({
			  	url: $('#base_url').val()+'dashboard/create_task',
			  	method: 'post',
			  	data: { description: description, is_private: is_private }
			}).done(function(response) {
			  	var checked = ''
			  	if (response[0].state == 1)
			  		checked = 'checked=""';

			  	var is_private = ''
			  	if (response[0].is_private == 1)
			  		is_private = ' <i class="pe-7s-lock" rel="tooltip" title="Private"></i>';

			  	var template = '<tr id="tr-task-'+response[0].id+'">\
                                    <td>\
                                        <label class="checkbox">\
                                        	<span class="icons"><span class="first-icon fa fa-square-o"></span><span class="second-icon fa fa-check-square-o"></span></span>\
                                            <input type="checkbox" value="'+response[0].id+'" data-toggle="checkbox" '+checked+' >\
                                        </label>\
                                    </td>\
                                    <td>'+response[0].description+is_private+' </td>\
                                    <td class="td-actions text-right">\
                                        <button type="button" rel="tooltip" title="Edit Task" class="edit-task btn btn-info btn-simple btn-xs" data-toggle="modal" data-target="#edit-task" data-task="'+response[0].id+'"  data-description="'+response[0].description+'" data-privacy="'+response[0].is_private+'">\
                                            <i class="fa fa-edit"></i>\
                                        </button>\
                                        <button type="button" rel="tooltip" title="Remove" class="delete-task btn btn-danger btn-simple btn-xs" data-task="'+response[0].id+'">\
                                            <i class="fa fa-times"></i>\
                                        </button>\
                                    </td>\
                                </tr>'

                $('#tasks tbody').prepend(template);
                $('.empty-task').fadeOut(0);

                $('#form-create-task textarea').val('');

                $.notify({
                    icon: "pe-7s-check",
                    message: "The task has been created!"
                },{
                    type: 'warning',
                    timer: 4000,
                    placement: {
                        from: 'bottom',
                        align: 'left'
                    }
                });
			});
    	}
    })

	$('.update-task').click(function(){
		var id = $('.update-task').attr('data-task');
    	var description = $('#form-edit-task textarea').val();
    	var is_private = $('#form-edit-task select option:selected').val();
    	if (description != '') {
    		$.ajax({
			  	url: $('#base_url').val()+'dashboard/edit_task',
			  	method: 'post',
			  	data: { id: id, description: description, is_private: is_private }
			}).done(function() {
			  	location.reload();
			});
    	}
    })
})
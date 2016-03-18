$(document).ready(function(){

    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
   
    var calendar = $('#calendar').fullCalendar({
            monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
            monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
            dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
            dayNamesShort: ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],
            buttonText:{ today:"Hoy",month:"Mes",week:"Semana",day:"Día"},
            events: $('#base_url').val()+'dashboard/events',
            editable: true,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay',
            },
        eventRender: function(event, element, view) {
            if (event.allDay === 'true')
                event.allDay = true;
            else
                event.allDay = false;
        },
        selectable: true,
        selectHelper: true,
        select: function(start, end, allDay) {
            var title = prompt('');
            if (title) {
                var start = $.fullCalendar.formatDate(start, "yyyy-MM-dd HH:mm:ss");
                var end = $.fullCalendar.formatDate(end, "yyyy-MM-dd HH:mm:ss");
                $.ajax({
                    url: $('#base_url').val()+'dashboard/new_event',
                    data: {title: title, start_date: start, end_date: end},
                    type: "POST"
                }).done(function(response) {
                    calendar.fullCalendar('renderEvent',{
                        id: response.eventid,
                        title: title,
                        start: start,
                        end: end,
                        allDay: allDay
                    },true);
                });
                
            }
            calendar.fullCalendar('unselect');
        },

        editable: true,
        eventDrop: function(event, delta) {
            var start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
            var end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
            $.ajax({
                url: $('#base_url').val()+'dashboard/update_event',
                data: {title: event.title, start_date: start, end_date: end, event_id: event.id},
                type: "POST"
            });
        },
        eventClick: function(event) {
            if (confirm($('#are_you_sure').val())) {
                $.ajax({
                    type: "POST",
                    url: $('#base_url').val()+'dashboard/delete_event',
                    data: {event_id: event.id},
                    success: function(json) {
                        $('#calendar').fullCalendar('removeEvents', event.id);
                    }
                });
            }
        },
        eventResize: function(event) {
            var start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
            var end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
            $.ajax({
                url: $('#base_url').val()+'dashboard/update_event',
                data: {start_date: start, end_date: end, event_id: event.id},
                type: "POST"
            });
        }
    });


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
    	if (confirm( $('#are_you_sure').val() )) { 
		  	$.ajax({
			  	url: $('#base_url').val()+'dashboard/delete_task',
			  	method: 'post',
			  	data: { id: id }
			}).done(function(response) {
			  	$('#tr-task-'+id).remove();

			  	if ( $('#tasks tr').length == 0 )
			  		$('.empty-task').removeClass('hidden').fadeIn(0);

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
                var task = response.task;
			  	var checked = ''
			  	if (task[0].state == 1)
			  		checked = 'checked=""';

			  	var is_private = ''
			  	if (task[0].is_private == 1)
			  		is_private = ' <i class="pe-7s-lock" rel="tooltip" title="Private"></i>';

			  	var template = '<tr id="tr-task-'+task[0].id+'">\
                                    <td>\
                                        <label class="checkbox">\
                                        	<span class="icons"><span class="first-icon fa fa-square-o"></span><span class="second-icon fa fa-check-square-o"></span></span>\
                                            <input type="checkbox" value="'+task[0].id+'" data-toggle="checkbox" '+checked+' >\
                                        </label>\
                                    </td>\
                                    <td>'+task[0].description+is_private+' </td>\
                                    <td class="td-actions text-right">\
                                        <button type="button" rel="tooltip" title="Edit Task" class="edit-task btn btn-warning btn-simple btn-xs" data-toggle="modal" data-target="#edit-task" data-task="'+task[0].id+'"  data-description="'+task[0].description+'" data-privacy="'+task[0].is_private+'">\
                                            <i class="fa fa-edit"></i>\
                                        </button>\
                                        <button type="button" rel="tooltip" title="Remove" class="delete-task btn btn-default btn-simple btn-xs" data-task="'+task[0].id+'">\
                                            <i class="fa fa-times"></i>\
                                        </button>\
                                    </td>\
                                </tr>'

                $('#tasks tbody').prepend(template);
                $('.empty-task').fadeOut(0);

                $('#form-create-task textarea').val('');

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
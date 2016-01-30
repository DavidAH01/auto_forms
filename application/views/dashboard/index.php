<div class="content">
    <div class="container-fluid">    
        <div class="row">
            <div class="col-md-8">
                <div class="card ">
                    <div id="calendar"></div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card dashboard">
                    <div class="header">
                        <h4 class="title"><?= $this->lang->line('summary') ?></h4>
                        <p class="category"><?= $this->lang->line('at_a_glance') ?></p>
                        <ul>
                            <?php foreach ($summary as $item){ ?>
                                <li><a href="<?= base_url() ?>administrable_tables/view/<?= $item['name'] ?>"><i class="pe-7s-angle-right"></i>  <?= $item['count'].' '.ucfirst($item['name']) ?></a> - <a href="<?= base_url() ?>administrable_tables/create/<?= $item['name'] ?>"><span><?= $this->lang->line('new') ?></span></a></li> 
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>    

        <div class="row">
            <div class="col-md-6">
                <div class="card dashboard log">
                    <div class="header">
                        <h4 class="title"><?= $this->lang->line('activity') ?></h4>
                        <p class="category"><?= $this->lang->line('publications_and_changes') ?></p>
                        <div id="content-activity">
                            <ul>
                                <?php foreach ($activities as $activity){ ?>
                                    <li><span><?= $activity->created_at ?> </span><?= $activity->name.' '.translate_type_activity($activity->type, $activity->record_id, $activity->table) ?> <a href="<?= base_url() ?>administrable_tables/view/<?= $activity->table ?>"><?= $activity->table ?></a></li> 
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="content"></div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card ">
                    <div class="header">
                        <h4 class="title"><?= $this->lang->line('tasks') ?></h4>
                        <p class="category"><?= $this->lang->line('to-do-list') ?></p>

                        <h5 class="title empty-task <?= ($tasks)?'hidden':'' ?>"><br><br><i class="pe-7s-medal"></i> <?= $this->lang->line('dont_have_tasks') ?></h5>
                    </div>
                    <div class="content">                      
                        <div class="table-full-width">
                            <table class="table" id="tasks">
                                <tbody>
                                    <?php foreach ($tasks as $task) { ?>
                                    <tr id="tr-task-<?= $task->id ?>">
                                        <td>
                                            <label class="checkbox">
                                                <input type="checkbox" value="<?= $task->id ?>" data-toggle="checkbox" <?= ($task->state == 1)?'checked=""':'' ?> >
                                            </label>
                                        </td>
                                        <td><?= $task->description ?> <?= ($task->is_private == 1)?'<i class="pe-7s-lock" rel="tooltip" title="Private"></i>':'' ?></td>
                                        <?php if($task->administrator_id == $this->session->userdata('logged_in')['user_id']){ ?>
                                            <td class="td-actions text-right">
                                                <button type="button" rel="tooltip" title="<?= $this->lang->line('edit_task') ?>" class="edit-task btn btn-warning btn-simple btn-xs" data-task="<?= $task->id ?>" data-description="<?= $task->description ?>" data-privacy="<?= $task->is_private ?>">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" rel="tooltip" title="<?= $this->lang->line('remove') ?>" class="delete-task btn btn-default btn-simple btn-xs" data-task="<?= $task->id ?>"> 
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <div class="card ">
                    <div class="header">
                        <h4 class="title"><?= $this->lang->line('new_task') ?></h4>
                    </div>
                    <div class="content">                      
                        <div class="table-full-width">
                            <table class="table new-task">
                                <tbody id="form-create-task">
                                    <tr>
                                        <td rowspan="2" style="vertical-align:top;">
                                            <textarea placeholder="<?= $this->lang->line('description') ?>"></textarea>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <label><?= $this->lang->line('privacy') ?></label>
                                                <select name="privacy" class="form-control">
                                                    <option value="0"><?= $this->lang->line('public') ?></option>
                                                    <option value="1"><?= $this->lang->line('private') ?></option>
                                                </select>
                                            </div> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">
                                            <button type="button" class="create-task btn btn-warning btn-fill"><?= $this->lang->line('create') ?></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> 

            <!-- Modal -->
            <div id="edit-task" class="modal fade" role="dialog" data-backdrop="false">
                <div class="modal-dialog modal-md">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"><?= $this->lang->line('edit_task') ?></h4>
                        </div>
                        <div class="modal-body">
                            <div class="table-full-width">
                                <table class="table edit-task">
                                    <tbody id="form-edit-task">
                                        <tr>
                                            <td colspan="2">
                                                <textarea placeholder="<?= $this->lang->line('description') ?>"></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <label><?= $this->lang->line('privacy') ?></label>
                                                    <select name="privacy" class="form-control select-privacy">
                                                        <option value="0"><?= $this->lang->line('public') ?></option>
                                                        <option value="1"><?= $this->lang->line('private') ?></option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-right">
                                                <button type="button" class="update-task btn btn-warning btn-fill btn-simple btn-md"><?= $this->lang->line('update') ?></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>    

        </div>        
    </div>    
</div>

<script>

    $(document).ready(function() {
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        
        /*  className colors
        
        className: default(transparent), important(red), chill(pink), success(green), info(blue)
        
        */      
        
          
        /* initialize the external events
        -----------------------------------------------------------------*/
    
        $('#external-events div.external-event').each(function() {
        
            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
            };
            
            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);
            
            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 999,
                revert: true,      // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
            });
            
        });
    
    
        /* initialize the calendar
        -----------------------------------------------------------------*/
        
        var calendar =  $('#calendar').fullCalendar({
            header: {
                left: 'title',
                center: 'agendaDay,agendaWeek,month',
                right: 'prev,next today'
            },
            editable: true,
            firstDay: 1, //  1(Monday) this can be changed to 0(Sunday) for the USA system
            selectable: true,
            defaultView: 'month',
            
            axisFormat: 'h:mm',
            columnFormat: {
                month: 'ddd',    // Mon
                week: 'ddd d', // Mon 7
                day: 'dddd M/d',  // Monday 9/7
                agendaDay: 'dddd d'
            },
            titleFormat: {
                month: 'MMMM yyyy', // September 2009
                week: "MMMM yyyy", // September 2009
                day: 'MMMM yyyy'                  // Tuesday, Sep 8, 2009
            },
            allDaySlot: false,
            selectHelper: true,
            select: function(start, end, allDay) {
                var title = prompt('Event Title:');
                if (title) {
                    calendar.fullCalendar('renderEvent',
                        {
                            title: title,
                            start: start,
                            end: end,
                            allDay: allDay
                        },
                        true // make the event "stick"
                    );
                }
                calendar.fullCalendar('unselect');
            },
            droppable: true, // this allows things to be dropped onto the calendar !!!
            drop: function(date, allDay) { // this function is called when something is dropped
            
                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject');
                
                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);
                
                // assign it the date that was reported
                copiedEventObject.start = date;
                copiedEventObject.allDay = allDay;
                
                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
                
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }
                
            },
            
            events: [
                {
                    title: 'All Day Event',
                    start: new Date(y, m, 1)
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: new Date(y, m, d-3, 16, 0),
                    allDay: false,
                    className: 'info'
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: new Date(y, m, d+4, 16, 0),
                    allDay: false,
                    className: 'info'
                },
                {
                    title: 'Meeting',
                    start: new Date(y, m, d, 10, 30),
                    allDay: false,
                    className: 'important'
                },
                {
                    title: 'Lunch',
                    start: new Date(y, m, d, 12, 0),
                    end: new Date(y, m, d, 14, 0),
                    allDay: false,
                    className: 'important'
                },
                {
                    title: 'Birthday Party',
                    start: new Date(y, m, d+1, 19, 0),
                    end: new Date(y, m, d+1, 22, 30),
                    allDay: false,
                },
                {
                    title: 'Click for Google',
                    start: new Date(y, m, 28),
                    end: new Date(y, m, 29),
                    url: 'http://google.com/',
                    className: 'success'
                }
            ],          
        });
        
        
    });

</script>
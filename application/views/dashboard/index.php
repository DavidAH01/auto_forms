<div class="content">
    <div class="container-fluid">    
        <div class="row">
            <div class="col-md-6">
                <div class="card ">
                    <div class="header">
                        <h4 class="title">My website </h4>
                        <p class="category">In real time</p>
                    </div>
                    <div class="content">                               
                        <iframe src="<?= str_replace('auto_forms', '', base_url()) ?>" frameborder="0" id="iframe-real-time"></iframe>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card ">
                    <div class="header">
                        <h4 class="title">Tasks</h4>
                        <p class="category">To-Do list</p>
                       
                        <?php if( !$tasks) { ?>
                            <h5 class="title empty-task"><br><br><i class="pe-7s-medal"></i> Congratulations, you don't have pending tasks</h5>
                        <?php } ?>
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
                                        <td><?= $task->description ?> <?= ($task->is_private == 1)?'<i class="pe-7s-lock"></i>':'' ?></td>
                                        <?php if($task->administrator_id == $this->session->userdata('logged_in')['user_id']){ ?>
                                            <td class="td-actions text-right">
                                                <button type="button" rel="tooltip" title="Edit Task" class="edit-task btn btn-warning btn-simple btn-xs" data-toggle="modal" data-target="#edit-task" data-task="<?= $task->id ?>" data-description="<?= $task->description ?>" data-privacy="<?= $task->is_private ?>">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" rel="tooltip" title="Remove" class="delete-task btn btn-default btn-simple btn-xs" data-task="<?= $task->id ?>"> 
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
            </div> 

            <div class="col-md-6">
                <div class="card ">
                    <div class="header">
                        <h4 class="title">New task</h4>
                    </div>
                    <div class="content">                      
                        <div class="table-full-width">
                            <table class="table new-task">
                                <tbody id="form-create-task">
                                    <tr>
                                        <td colspan="2">
                                            <textarea placeholder="Description"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <label>Privacy</label>
                                                <select name="privacy" class="form-control">
                                                    <option value="0">Public</option>
                                                    <option value="1">Private</option>
                                                </select>
                                            </div> 
                                        </td>
                                        <td class="text-right">
                                            <button type="button" class="create-task btn btn-warning btn-fill">Create</button>
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
                            <h4 class="modal-title">Edit task</h4>
                        </div>
                        <div class="modal-body">
                            <div class="table-full-width">
                                <table class="table edit-task">
                                    <tbody id="form-edit-task">
                                        <tr>
                                            <td colspan="2">
                                                <textarea placeholder="Description"></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <label>Privacy</label>
                                                    <select name="privacy" class="form-control">
                                                        <option value="0">Public</option>
                                                        <option value="1">Private</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="text-right">
                                                <button type="button" class="update-task btn btn-warning btn-fill btn-simple btn-md">Update</button>
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
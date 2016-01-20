<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Edit <?= ucfirst($table) ?></h4>
                    </div>
                    <div class="content auto-form">
                        <form>
                            <div class="row">
                                <div class="col-md-12">
                                <?php $count_fields = 1;
                                    foreach ($fields as $field) {
                                        switch ($field['type']) {
                                            case 'text':
                                                $this->load->view($list_fields->text_field, array('field' => $field));
                                                break;
                                            case 'textarea':
                                                $this->load->view($list_fields->textarea_field, array('field' => $field));
                                                break;
                                            case 'number':
                                                $this->load->view($list_fields->number_field, array('field' => $field, 'count_fields' => $count_fields));
                                                break;
                                            case 'datetime':
                                                $this->load->view($list_fields->datetime_field, array('field' => $field, 'count_fields' => $count_fields));
                                                break;
                                            case 'slider':
                                                $this->load->view($list_fields->slider_field, array('field' => $field, 'count_fields' => $count_fields));
                                                break;
                                        }
                                        $count_fields++;
                                    } 
                                ?>   
                                </div>
                            </div>
                            
                            <br><br>
                            <?php if(isset($record_id)){ ?>
                                <input type="hidden" class="save-input" name="record_id" value="<?= $record_id ?>">
                                <a href="<?= base_url() ?>administrable_tables/delete/<?= $table ?>?record=<?= $record_id ?>" onclick="return confirm('Are you sure?')"><button type="button" class="btn btn-action btn-danger">Delete</button></a>
                            <?php } ?>
                            <a href="<?= base_url() ?>administrable_tables/view/<?= $table ?>" class="btn btn-warning">Cancel</a>
                            <button type="submit" class="btn btn-info btn-fill pull-right"><?= (isset($record_id))?"Update":"Create" ?></button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>                    
    </div>
</div>
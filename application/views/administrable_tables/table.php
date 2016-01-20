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
                                            case 'select':
                                                $this->load->view($list_fields->select_field, array('field' => $field));
                                                break;
                                            case 'multiselect':
                                                $this->load->view($list_fields->multiselect_field, array('field' => $field, 'count_fields' => $count_fields));
                                                break;
                                            case 'radio':
                                                $this->load->view($list_fields->radio_field, array('field' => $field));
                                                break;
                                            case 'checkbox':
                                                $this->load->view($list_fields->checkbox_field, array('field' => $field));
                                                break;
                                            case 'administrator':
                                                $this->load->view($list_fields->administrator_field, array('field' => $field));
                                                break;
                                            case 'file':
                                                $this->load->view($list_fields->file_field, array('field' => $field));
                                                break;
                                            case 'map':
                                                $this->load->view($list_fields->map_field, array('field' => $field));
                                                break;
                                            case 'gallery':
                                                $this->load->view($list_fields->gallery_field, array('field' => $field));
                                                break;
                                            case 'relation':
                                                $this->load->view($list_fields->relation_field, array('field' => $field));
                                                break;
                                            case 'multirelation':
                                                $this->load->view($list_fields->multirelation_field, array('field' => $field));
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
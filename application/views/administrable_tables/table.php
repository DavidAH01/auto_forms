<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Edit <?= ucfirst(str_replace('_', ' ', $current_table)) ?></h4>
                    </div>
                    <div class="content auto-form">
                        <form enctype="multipart/form-data">
                            <input type="hidden" name="current_table" class="save-input" value="<?= $current_table ?>">
                            <input type="hidden" name="record_id" class="save-input" value="<?= $record_id ?>">
                            <div class="row">
                                <div class="col-md-12">
                                <?php
                                    foreach ($fields as $field) {
                                        $data = array('field' => $field);
                                        switch ($field['type']) {
                                            case 'text':
                                                $this->load->view($list_fields->text_field, $data);
                                                break;
                                            case 'textarea':
                                                $this->load->view($list_fields->textarea_field, $data);
                                                break;
                                            case 'number':
                                                $this->load->view($list_fields->number_field, $data);
                                                break;
                                            case 'datetime':
                                                $this->load->view($list_fields->datetime_field, $data);
                                                break;
                                            case 'color':
                                                $this->load->view($list_fields->color_field, $data);
                                                break;
                                            case 'slider':
                                                $this->load->view($list_fields->slider_field, $data);
                                                break;
                                            case 'select':
                                                $this->load->view($list_fields->select_field, $data);
                                                break;
                                            case 'multiselect':
                                                $this->load->view($list_fields->multiselect_field, $data);
                                                break;
                                            case 'radio':
                                                $this->load->view($list_fields->radio_field, $data);
                                                break;
                                            case 'checkbox':
                                                $this->load->view($list_fields->checkbox_field, $data);
                                                break;
                                            case 'administrator':
                                                $this->load->view($list_fields->administrator_field, $data);
                                                break;
                                            case 'file':
                                                $this->load->view($list_fields->file_field, $data);
                                                break;
                                            case 'map':
                                                $this->load->view($list_fields->map_field, $data);
                                                break;
                                            case 'gallery':
                                                $this->load->view($list_fields->gallery_field, $data);
                                                break;
                                            case 'relation':
                                                $this->load->view($list_fields->relation_field, $data);
                                                break;
                                            case 'multirelation':
                                                $this->load->view($list_fields->multirelation_field, $data);
                                                break;
                                        }
                                    } 
                                ?>   
                                </div>
                            </div>
                            
                            <br><br>
                            <?php if(isset($record_id) && !empty($record_id)){ ?>
                                <input type="hidden" class="save-input" name="record_id" value="<?= $record_id ?>">
                                <a href="<?= base_url() ?>administrable_tables/delete/<?= $current_table ?>?record=<?= $record_id ?>" onclick="return confirm('Are you sure?')"><button type="button" class="btn btn-action btn-danger">Delete</button></a>
                            <?php } ?>
                            <a href="<?= base_url() ?>administrable_tables/view/<?= $current_table ?>" class="btn btn-warning">Cancel</a>
                            <button type="submit" class="<?= (isset($record_id) && !empty($record_id))?"update":"create" ?>-auto-form btn btn-info btn-fill pull-right"><?= (isset($record_id) && !empty($record_id))?"Update":"Create" ?></button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>                    
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title"><?= (isset($record_id) && !empty($record_id))?$this->lang->line('edit'):$this->lang->line('create') ?> <?= ucfirst($section_title) ?></h4>
                    </div>
                    <div class="content auto-form">
                        <form enctype="multipart/form-data">
                            <input type="hidden" name="current_table" class="save-input" value="<?= $current_table ?>">
                            <input type="hidden" name="record_id" class="save-input" value="<?= $record_id ?>">
                            <div class="row">
                                <div class="col-md-12">
                                <?php
                                    if (isset($stored_data))
                                        $data = array('stored_data' => $stored_data);

                                    foreach ($fields as $field) {
                                        $data = array('field' => $field);
                                        if( $field['type'] == 'text' ||
                                            $field['type'] == 'textarea' ||
                                            $field['type'] == 'number' ||
                                            $field['type'] == 'datetime' ||
                                            $field['type'] == 'color' ||
                                            $field['type'] == 'slider' ||
                                            $field['type'] == 'select' ||
                                            $field['type'] == 'multiselect' ||
                                            $field['type'] == 'radio' ||
                                            $field['type'] == 'checkbox' ||
                                            $field['type'] == 'administrator' ||
                                            $field['type'] == 'file' ||
                                            $field['type'] == 'map' ||
                                            $field['type'] == 'gallery' ||
                                            $field['type'] == 'relation' ||
                                            $field['type'] == 'multirelation' ||
                                            $field['type'] == 'steps' ||
                                            $field['type'] == 'list'){

                                            $this->load->view($list_fields->{$field['type'].'_field'}, $data);
                                        }
                                    } 
                                ?>   
                                </div>
                            </div>
                            
                            <br><br>
                            <?php if(isset($record_id) && !empty($record_id)){ ?>
                                <input type="hidden" class="save-input" name="record_id" value="<?= $record_id ?>">
                                <a href="<?= base_url() ?>administrable_tables/delete/<?= $current_table ?>?record=<?= $record_id ?>" onclick="return confirm('<?= $this->lang->line('are_you_sure') ?>')"><button type="button" class="btn btn-action btn-default"><?= $this->lang->line('delete') ?></button></a>
                            <?php } ?>
                            <a href="<?= base_url() ?>administrable_tables/view/<?= $current_table ?>" class="btn btn-link"><?= $this->lang->line('cancel') ?></a>
                            <img src="<?= base_url() ?>assets/images/loading.gif" alt="loading" id="icon-loading">
                            <button type="submit" class="<?= (isset($record_id) && !empty($record_id))?"update":"create" ?>-auto-form btn btn-warning btn-fill pull-right"><?= (isset($record_id) && !empty($record_id))?$this->lang->line('update'):$this->lang->line('create') ?></button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>                    
    </div>
</div>
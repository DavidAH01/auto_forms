<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title"><?= (isset($administrable_id) && !empty($administrable_id))?$this->lang->line('edit'):$this->lang->line('create') ?> <?= ucfirst($section_title) ?></h4>
                    </div>
                    <div class="content auto-form">
                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <th><?= $this->lang->line('name') ?></th>
                                    <th><?= $this->lang->line('component') ?></th>
                                    <th><?= $this->lang->line('configuration') ?></th>
                                    <th width="90px"></th>
                                </thead>
                                <tbody>
                                <?php foreach ($fields as $field) { ?>
                                    <tr data-field="<?php $field->Field ?>" >
                                        <td><input type="text" class="form-control field_name" value="<?= $field->Name ?>"></td>
                                        <td>
                                            <select class="form-control field_component">
                                                <?php foreach (components_list() as $component) { ?>
                                                    <option value="<?php $component ?>" <?= ($component == $field->Component)?'selected':'' ?>><?= ucfirst($component) ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td>
                                            <?php if ($field->Component == 'number') { ?>
                                                <input type="text" style="width: 33.3333% !important; float: left;" class="form-control configuration" value="">
                                                <input type="text" style="width: 33.3333% !important; float: left;" class="form-control configuration" value="">
                                                <input type="text" style="width: 33.3333% !important; float: left;" class="form-control configuration" value="">
                                            <?php } ?>

                                            <?php if ($field->Component == 'slider') { ?>
                                            
                                            <?php } ?>
                                            <?= $field->Comment ?>
                                        </td>
                                        <td width="90px">
                                            <a href="<?= base_url() ?>auto_forms/delete/<?= $field->Name ?>" onclick="return confirm('<?= $this->lang->line('are_you_sure') ?>')"><button type="button" class="btn btn-action btn-default"><?= $this->lang->line('delete') ?></button></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table> 
                        </div>

                            
                        <br><br>
                        <?php if(isset($administrable_id) && !empty($administrable_id)){ ?>
                            <input type="hidden" class="save-input" name="administrable_id" value="<?= $administrable_id ?>">
                            <a href="<?= base_url() ?>auto_forms/delete/<?= $administrable_id ?>" onclick="return confirm('<?= $this->lang->line('are_you_sure') ?>')"><button type="button" class="btn btn-action btn-default"><?= $this->lang->line('delete') ?></button></a>
                        <?php } ?>
                        <a href="<?= base_url() ?>auto_forms" class="btn btn-link"><?= $this->lang->line('cancel') ?></a>
                        <button type="submit" class="<?= (isset($administrable_id) && !empty($administrable_id))?"update":"create" ?>-auto-form btn btn-warning btn-fill pull-right"><?= (isset($administrable_id) && !empty($administrable_id))?$this->lang->line('update'):$this->lang->line('create') ?></button>
                        <div class="clearfix"></div>
                       
                    </div>
                </div>
            </div>
        </div>                    
    </div>
</div>
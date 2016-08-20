<div class="content">
    <div class="container-fluid">
        <div class="row">                   
            <div class="col-md-12">
                <div class="card table-content">
                    <div class="content table-responsive table-full-width">
                        <button type="button" class="btn btn-action btn-default remove-all-data" id="remove-all-administrable-tables" data-table="<?= $table ?>"><?= $this->lang->line('delete_all_selected') ?></button>
                        <div class="scroll-h">
                            <table class="table table-hover table-striped data-table administrable-data-table" data-table="<?= $table ?>">
                                <thead>
                                    <th width="50px"></th>
                                    <th width="200px"></th>
                                    <?php foreach ($fields as $field) { ?>
                                         <th><?= $field['name'] ?></th>
                                    <?php } ?>
                                </thead>
                                <tfoot>
                                    <th width="50px"></th>
                                    <th width="200px"></th>
                                    <?php foreach ($fields as $field) { ?>
                                        <th></th>
                                    <?php } ?>
                                </tfoot>
                                <tbody>
                                <?php $order=1; foreach ($records as $record) { ?>
                                    <tr id="<?= $record->id ?>" data-table="<?= $table ?>">
                                        <td width="50px"><?= $order ?></td>
                                        <td width="200px">
                                            <a data-toggle="tooltip" title="<?= $this->lang->line('edit') ?>" href="<?= base_url() ?>administrable_tables/edit/<?= $table ?>?record=<?= $record->id ?>"><button type="button" class="btn btn-warning btn-info"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>
                                            <a data-toggle="tooltip" title="<?= $this->lang->line('delete') ?>" href="<?= base_url() ?>administrable_tables/delete/<?= $table ?>?record=<?= $record->id ?>" onclick="return confirm('<?= $this->lang->line('are_you_sure') ?>')"><button type="button" class="btn btn-action btn-default"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
                                        </td>
                                        <?php foreach ($fields as $field) { ?>
                                            <?php if($field['type'] == 'relation'){ ?>
                                                <?php $exits = false; ?>
                                                <?php $j=0; foreach ($field['options'] as $option) { ?>
                                                    <?php if($option['id'] == $record->$field['complete_name']){
                                                        $exits = true;
                                                        $position = $j;
                                                    } ?>
                                                <?php $j++; } ?>
                                                <?php if($exits){ ?>
                                                    <th><?= $field['options'][$position]['name'] ?></th>
                                                <?php }else{ ?>
                                                    <th></th>
                                                <?php } ?>
                                            <?php }else if($field['type'] == 'color'){ ?>
                                                <th>
                                                    <span class="color-block" style="background:<?= $record->$field['complete_name']; ?>"></span>
                                                    <?= $record->$field['complete_name'] ?>
                                                </th>
                                            <?php }else if($field['type'] == 'file'){ ?>
                                                <th>
                                                    <?php $file = explode('.', $record->$field['complete_name']); ?>
                                                    <?php $extension = $file[ count($file)-1 ]; ?>
                                                    <?php if($extension == "jpg" || $extension == "jpeg" || $extension == "png" || $extension == "gif"){ ?>
                                                        <img data-action="zoom" src="<?= base_url() ?>uploads/files/<?= $record->$field['complete_name'] ?>">
                                                    <?php }else{ ?>
                                                        <?php if(!empty($file[0])){ ?>
                                                            <a target="_blank" href="<?= base_url() ?>uploads/files/<?= $record->$field['complete_name'] ?>"><?= $this->lang->line('file') ?></a>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </th>
                                            <?php }else{ ?>
                                                <th><?= $record->$field['complete_name'] ?></th>
                                            <?php } ?>
                                        <?php } ?>
                                    </tr>
                                <?php $order++; } ?>
                                </tbody>
                            </table> 
                        </div>
                    </div>
                </div>
            </div>        
        </div>                    
    </div>
</div>
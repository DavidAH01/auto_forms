<div class="content">
    <div class="container-fluid">
        <div class="row">                   
            <div class="col-md-12">
                <div class="card table-content">
                    <div class="content table-responsive table-full-width">
                        <button type="button" class="btn btn-action btn-default remove-all-data" id="remove-all-administrable-tables" data-table="<?= $table ?>"><?= $this->lang->line('delete_all_selected') ?></button>
                        <table class="table table-hover table-striped data-table administrable-data-table" data-table="<?= $table ?>">
                            <thead>
                                <th></th>
                                <?php foreach ($fields as $field) { ?>
                                     <th><?= $field['name'] ?></th>
                                <?php } ?>
                                <th width="170px"></th>
                            </thead>
                            <tfoot>
                                <th></th>
                                <?php foreach ($fields as $field) { ?>
                                    <th><?= $field['name'] ?></th>
                                <?php } ?>
                                <th width="170px"></th>
                            </tfoot>
                            <tbody>
                            <?php $order=1; foreach ($records as $record) { ?>
                                <tr id="<?= $record->id ?>" data-table="<?= $table ?>">
                                    <td><?= $order ?></td>
                                    <?php foreach ($fields as $field) { ?>
                                        <?php if($field['type'] == 'relation'){ ?>
                                            <?php $exits = false; ?>
                                            <?php $j=0; foreach ($field['options'] as $option) { ?>
                                                <?php if($option['id'] == $record->$field['complete_name']){
                                                    $exits = true;
                                                    $position = $j;
                                                $j++; } ?>
                                            <?php } ?>
                                            <?php if($exits){ ?>
                                                <th><?= $field['options'][$position]['name'] ?></th>
                                            <?php }else{ ?>
                                                <th></th>
                                            <?php } ?>
                                        <?php }else{ ?>
                                            <th><?= $record->$field['complete_name'] ?></th>
                                        <?php } ?>
                                    <?php } ?>
                                	<td width="170px">
                                        <a href="<?= base_url() ?>administrable_tables/edit/<?= $table ?>?record=<?= $record->id ?>"><button type="button" class="btn btn-warning btn-info"><?= $this->lang->line('edit') ?></button></a>
                                        <a href="<?= base_url() ?>administrable_tables/delete/<?= $table ?>?record=<?= $record->id ?>" onclick="return confirm('<?= $this->lang->line('are_you_sure') ?>')"><button type="button" class="btn btn-action btn-default"><?= $this->lang->line('delete') ?></button></a>
                                    </td>
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
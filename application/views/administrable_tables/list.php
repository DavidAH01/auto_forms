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
                                <?php $i=0; foreach ($fields as $field) { ?>
                                    <?php if ($i <= 2) { ?>
                                        <th><?= $field['name'] ?></th>
                                    <?php } ?>
                                <?php $i++; } ?>
                                <th></th>
                            </thead>
                            <tfoot>
                                <th></th>
                                <?php $i=0; foreach ($fields as $field) { ?>
                                    <?php if ($i <= 2) { ?>
                                        <th><?= $field['name'] ?></th>
                                    <?php } ?>
                                <?php $i++; } ?>
                                <th></th>
                            </tfoot>
                            <tbody>
                            <?php $order=1; foreach ($records as $record) { ?>
                                <tr id="<?= $record->id ?>" data-table="<?= $table ?>">
                                    <td><?= $order ?></td>
                                    <?php $i=0; foreach ($fields as $field) { ?>
                                        <?php if ($i <= 2) { ?>
                                            <th><?= $record->$field['complete_name'] ?></th>
                                        <?php } ?>
                                    <?php $i++; } ?>
                                	<td>
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
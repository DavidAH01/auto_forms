<div class="content">
    <div class="container-fluid">
        <div class="row">                   
            <div class="col-md-12">
                <div class="card table-content">
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th><?= $this->lang->line('name') ?></th>
                                <th width="200px"></th>
                            </thead>
                            <tbody>
                            <?php foreach ($adminsitrable_tables as $adminsitrable_table) { ?>
                                <tr>
                                    <td><?= ucfirst($adminsitrable_table->name) ?></td>
                                	<td width="200px">
                                        <a href="<?= base_url() ?>auto_forms/edit/<?= $adminsitrable_table->name ?>?administrable=<?= $adminsitrable_table->id ?>"><button type="button" class="btn btn-warning btn-info"><?= $this->lang->line('edit') ?></button></a>
                                        <a href="<?= base_url() ?>auto_forms/delete/<?= $adminsitrable_table->name ?>?administrable=<?= $adminsitrable_table->id ?>" onclick="return confirm('<?= $this->lang->line('are_you_sure') ?>')"><button type="button" class="btn btn-action btn-default"><?= $this->lang->line('delete') ?></button></a>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table> 
                    </div>
                </div>
            </div>        
        </div>                    
    </div>
</div>
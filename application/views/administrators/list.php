<div class="content">
    <div class="container-fluid">
        <div class="row">                   
            <div class="col-md-12">
                <div class="card table-content">
                    <div class="content table-responsive table-full-width">
                        <button type="button" class="btn btn-action btn-default remove-all-data" id="remove-all"><?= $this->lang->line('delete_all_selected') ?></button>
                        <table class="table table-hover table-striped data-table">
                            <thead>
                            	<th><?= $this->lang->line('name') ?></th>
                            	<th><?= $this->lang->line('email') ?></th>
                            	<th><?= $this->lang->line('state') ?></th>
                            	<th><?= $this->lang->line('is_super_administrator') ?></th>
                                <th></th>
                            </thead>
                            <tfoot>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tfoot>
                            <tbody>
                            <?php foreach ($administrators as $administrator) { ?>
                                <tr data-administrator="<?= $administrator->id ?>">
                                	<td><?= $administrator->name ?></td>
                                	<td><?= $administrator->email ?></td>
                                	<td><?= ($administrator->state == 1)?$this->lang->line('active'):$this->lang->line('inactive') ?></td>
                                	<td><?= ($administrator->is_super_administrator == 1)?$this->lang->line('yes'):$this->lang->line('no') ?></td>
                                    <td>
                                        <a href="<?= base_url() ?>administrators/user/<?= $administrator->id ?>"><button type="button" class="btn btn-action btn-warning"><?= $this->lang->line('edit') ?></button></a>
                                        <a href="<?= base_url() ?>administrators/delete/<?= $administrator->id ?>" onclick="return confirm('<?= $this->lang->line('are_you_sure') ?>')"><button type="button" class="btn btn-action btn-default"><?= $this->lang->line('delete') ?></button></a>
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
<div class="content">
    <div class="container-fluid">
        <div class="row">                   
            <div class="col-md-12">
                <div class="card table-content">
                    <div class="content table-responsive table-full-width">
                        <button type="button" class="btn btn-action btn-danger" id="remove-all">Delete all selected</button>
                        <table class="table table-hover table-striped data-table">
                            <thead>
                            	<th>Name</th>
                            	<th>Email</th>
                            	<th>State</th>
                            	<th>Is super administrator?</th>
                                <th></th>
                            </thead>
                            <tfoot>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Is super administrator?</th>
                                <th></th>
                            </tfoot>
                            <tbody>
                            <?php foreach ($administrators as $administrator) { ?>
                                <tr data-administrator="<?= $administrator->id ?>">
                                	<td><?= $administrator->name ?></td>
                                	<td><?= $administrator->email ?></td>
                                	<td><?= ($administrator->state == 1)?"active":"inactive" ?></td>
                                	<td><?= ($administrator->is_super_administrator == 1)?"yes":"no" ?></td>
                                    <td>
                                        <a href="<?= base_url() ?>administrators/user/<?= $administrator->id ?>"><button type="button" class="btn btn-action btn-info">Edit</button></a>
                                        <a href="<?= base_url() ?>administrators/delete/<?= $administrator->id ?>" onclick="return confirm('Are you sure?')"><button type="button" class="btn btn-action btn-danger">Delete</button></a>
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
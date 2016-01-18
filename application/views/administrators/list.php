<div class="content">
    <div class="container-fluid">
        <div class="row">                   
            <div class="col-md-12">
                <div class="card table-content">
                    <div class="content table-responsive table-full-width">
                        <button type="button" class="btn btn-action btn-danger" id="remove-all">Delete all selected</button>
                        <table class="table table-hover table-striped">
                            <thead>
                            	<th>Name</th>
                            	<th>Email</th>
                            	<th>Status</th>
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
                                <tr>
                                	<td>Dakota Rice</td>
                                	<td>dakota.rice@gmail.com</td>
                                	<td>active</td>
                                	<td>yes</td>
                                    <td>
                                        <a href="<?= base_url() ?>administrators/user"><button type="button" class="btn btn-action btn-info">Edit</button></a>
                                        <a href="<?= base_url() ?>administrators/delete" onclick="return confirm('Are you sure?')"><button type="button" class="btn btn-action btn-danger">Delete</button></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table> 
                    </div>
                </div>
            </div>        
        </div>                    
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Edit <?= ucfirst($table) ?></h4>
                    </div>
                    <div class="content">
                        <form>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Company (disabled)</label>
                                        <input type="text" class="form-control" placeholder="Company" value="Creative Code Inc.">
                                    </div>        
                                </div>
                            </div>
                            
                            <br><br>
                            <?php if(isset($record_id)){ ?>
                                <input type="hidden" class="save-input" name="record_id" value="<?= $record_id ?>">
                                <a href="<?= base_url() ?>administrable_tables/delete/<?= $table ?>?record=<?= $record_id ?>" onclick="return confirm('Are you sure?')"><button type="button" class="btn btn-action btn-danger">Delete</button></a>
                            <?php } ?>
                            <a href="<?= base_url() ?>administrable_tables/view/<?= $table ?>" class="btn btn-warning">Cancel</a>
                            <button type="submit" class="btn btn-info btn-fill pull-right"><?= (isset($record_id))?"Update":"Create" ?></button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>                    
    </div>
</div>
 <div class="container into-auth">
    <div class="col-md-4 col-md-offset-4">
        <div class="card">
            <div class="header">
                <h4 class="title login">Auto_Forms</h4>
            </div>
            <div class="content">
                <div class="header">
                    <h5 class="title">New password</h5>
                </div>
                <div class="content">
                    <form autocomplete="off">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="hidden" class="user-id" value="<?= $id ?>">
                                    <input type="hidden" class="recovery-hash" value="<?= $hash ?>">
                                    <input type="password" class="new-password form-control" placeholder="Password">
                                </div>        
                            </div>
                        </div>
                        <a href="<?= base_url() ?>" class="btn btn-link">Login</a>
                        <button class="update-password btn btn-warning btn-fill pull-right">Update</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
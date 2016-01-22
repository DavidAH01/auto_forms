<div class="container into-auth">
    <div class="col-md-4 col-md-offset-4">
        <div class="card">
            <div class="header">
                <h4 class="title login">Auto_Forms</h4>
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <?php if(validation_errors() != NULL && validation_errors() != '') { ?>
                            <div class="alert alert-warning">
                                <?= validation_errors(); ?>
                            </div>
                        <?php } ?>    
                    </div>
                </div>

                <?= form_open('/auth/verify/', array('class' => 'content-login')); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Name">
                            </div>        
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>        
                        </div>
                    </div>

                    <a href="#" id="forgot-password" style="color:grey;">Forgot password?</a>
                    <br><br>
                    <input type="submit" class="btn btn-warning btn-fill pull-center btn-md" value="Login">
                    <div class="clearfix"></div>
                </form>

                <div class="content-recover-password">
                    <div class="header">
                        <h5 class="title">Recover password</h5>
                    </div>
                    <div class="content">
                        <form autocomplete="off">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" placeholder="Email">
                                    </div>        
                                </div>
                            </div>
                            <button class="btn btn-warning" id="close-recover">Cancel</button>

                            <button type="submit" class="btn btn-warning btn-fill pull-right">Recover</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if (isset($success) && !empty($success)) { ?>
        <script>
            alert('<?= $success ?>');
        </script>
    <?php } ?>
</div>
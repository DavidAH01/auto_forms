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
                                <label><?= $this->lang->line('name') ?></label>
                                <input type="text" name="name" class="form-control" placeholder="<?= $this->lang->line('name') ?>">
                            </div>        
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><?= $this->lang->line('password') ?></label>
                                <input type="password" name="password" class="form-control" placeholder="<?= $this->lang->line('password') ?>">
                            </div>        
                        </div>
                    </div>
                    <input type="hidden" name="time-zone" id="time-zone">
                    <a href="#" id="forgot-password" style="color:grey;"><?= $this->lang->line('forgot_password') ?></a>
                    <br><br>
                    <input type="submit" class="btn btn-warning btn-fill pull-center btn-md" value="<?= $this->lang->line('login') ?>">
                    <div class="clearfix"></div>
                </form>

                <div class="content-recover-password">
                    <div class="header">
                        <h5 class="title"><?= $this->lang->line('recover_password') ?></h5>
                    </div>
                    <div class="content">
                        <form autocomplete="off">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><?= $this->lang->line('email') ?></label>
                                        <input type="email" class="form-control recovery-email" placeholder="<?= $this->lang->line('email') ?>">
                                    </div>        
                                </div>
                            </div>
                            <button class="btn btn-link" id="close-recover"><?= $this->lang->line('cancel') ?></button>

                            <button class="recover-password btn btn-warning btn-fill pull-right"><?= $this->lang->line('recover') ?></button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
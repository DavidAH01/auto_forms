<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title"><?= $this->lang->line('edit_configuration') ?></h4>
                    </div>
                    <div class="content">
                        <form onkeypress="return event.keyCode != 13;">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?= $this->lang->line('google_analytics_code') ?> <small><a href="https://www.google.com/analytics/" target="_blank"><?= $this->lang->line('more_info') ?></a></small></label>
                                        <input type="text" class="save-input form-control" name="google_analytics_code" placeholder="<?= $this->lang->line('google_analytics_code') ?>" value="<?= $configuration->google_analytics_code ?>">
                                    </div>        
                                </div>
                    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?= $this->lang->line('website_description') ?> <small><a href="https://moz.com/learn/seo/meta-description" target="_blank"><?= $this->lang->line('more_info') ?></a></small></label>
                                        <input type="text" class="save-input form-control" name="website_description" placeholder="<?= $this->lang->line('website_description') ?>" value="<?= $configuration->website_description ?>">
                                    </div>        
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><?= $this->lang->line('website_keywords') ?> <small><a href="http://www.wordstream.com/meta-keyword" target="_blank"><?= $this->lang->line('more_info') ?></a></small></label><br>
                                        <input type="text" class="save-input form-control" data-role="tagsinput" name="website_keywords" placeholder="<?= $this->lang->line('website_keywords') ?>" value="<?= $configuration->website_keywords ?>">
                                    </div>        
                                </div>
                            </div>

                            <button type="submit" class="update-configuration btn btn-warning btn-fill pull-right"><?= $this->lang->line('update') ?></button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>                    
    </div>
</div> 
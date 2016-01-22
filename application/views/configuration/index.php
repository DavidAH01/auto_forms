<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Edit Configuration</h4>
                    </div>
                    <div class="content">
                        <form onkeypress="return event.keyCode != 13;">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Google analytics Code <small><a href="https://www.google.com/analytics/" target="_blank">more info</a></small></label>
                                        <input type="text" class="save-input form-control" name="google_analytics_code" placeholder="Google Analytics Code" value="<?= $configuration[0]->google_analytics_code ?>">
                                    </div>        
                                </div>
                    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Website description <small><a href="https://moz.com/learn/seo/meta-description" target="_blank">more info</a></small></label>
                                        <input type="text" class="save-input form-control" name="website_description" placeholder="Description" value="<?= $configuration[0]->website_description ?>">
                                    </div>        
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Website Keywords <small><a href="http://www.wordstream.com/meta-keyword" target="_blank">more info</a></small></label><br>
                                        <input type="text" class="save-input form-control" data-role="tagsinput" name="website_keywords" placeholder="Keywords" value="<?= $configuration[0]->website_keywords ?>">
                                    </div>        
                                </div>
                            </div>

                            <button type="submit" class="update-configuration btn btn-warning btn-fill pull-right">Update</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>                    
    </div>
</div> 
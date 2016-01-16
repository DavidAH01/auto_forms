<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Edit Profile</h4>
                    </div>
                    <div class="content">
                        <form>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" placeholder="Name">
                                    </div>        
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" placeholder="Email">
                                    </div>        
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Password</label>
                                        <input type="password" class="form-control" placeholder="Password">
                                    </div>        
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>State</label>
                                    </div> 
                                    <label class="radio">
                                        <input type="radio" value="1" name="state" data-toggle="radio" checked="">
                                    </label><span class="option-checkbox">Active</span>
                                    <br>      
                                    <label class="radio">
                                        <input type="radio" value="0" name="state" data-toggle="radio">
                                    </label><span class="option-checkbox">Inactive</span>
                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Is Super Administrator?</label>
                                    </div>       
                                    <label class="radio">
                                        <input type="radio" value="1" name="is_super_administrator" data-toggle="radio">
                                    </label><span class="option-checkbox">Yes</span>
                                    <br>      
                                    <label class="radio">
                                        <input type="radio" value="0" name="is_super_administrator" data-toggle="radio" checked="">
                                    </label><span class="option-checkbox">No</span> 
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12"><br>
                                    <div class="form-group">
                                        <label>Permissions</label><br>
                                        <select class="multiselect" multiple="multiple">
                                            <option value="cheese">Cheese</option>
                                            <option value="tomatoes">Tomatoes</option>
                                            <option value="mozarella">Mozzarella</option>
                                            <option value="mushrooms">Mushrooms</option>
                                            <option value="pepperoni">Pepperoni</option>
                                            <option value="onions">Onions</option>
                                        </select>
                                    </div>        
                                </div>
                            </div><br><br>
                            <a href="<?= base_url() ?>administrators/delete" onclick="return confirm('Are you sure?')"><button type="button" class="btn btn-action btn-danger"><i class="pe-7s-trash"></i> Delete</button></a>
                            <button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>                    
    </div>
</div>
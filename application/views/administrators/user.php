<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Edit Profile</h4>
                    </div>
                    <div class="content">
                        <form id="<?= (!isset($user))?"form-new-administrator":"" ?>">
                            <?php if(isset($user)){ ?>
                                <input type="hidden" name="id" value="<?= $user->id ?>" class="save-input">
                            <?php } ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="save-input form-control" name="name" placeholder="Name" value="<?= isset($user)?$user->name:""  ?>">
                                    </div>        
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="save-input clear form-control" name="email" placeholder="Email" value="<?= isset($user)?$user->email:""  ?>">
                                    </div>        
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="save-input clear form-control" name="password" placeholder="Password">
                                        <label><small><small><?= isset($user)?"fill this field only if you want to change the password":"" ?></small></small></label>
                                    </div>        
                                </div>
                            </div>
                            
                            <?php if(is_super_administrator()){ ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>State</label>
                                    </div> 
                                    <label class="radio">
                                        <input type="radio" name="state" class="save-input" data-toggle="radio" value="1" <?= isset($user)?($user->state == 1)?"checked":"":"checked"   ?>>
                                    </label><span class="option-checkbox">Active</span>
                                    <br>      
                                    <label class="radio">
                                        <input type="radio" name="state" class="save-input" data-toggle="radio" value="0" <?= isset($user)?($user->state == 0)?"checked":"":""   ?>>
                                    </label><span class="option-checkbox">Inactive</span>
                    
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Is Super Administrator?</label>
                                    </div>       
                                    <label class="radio">
                                        <input type="radio" name="is_super_administrator" class="save-input" data-toggle="radio" value="1" <?= isset($user)?($user->is_super_administrator == 1)?"checked":"":"" ?>>
                                    </label><span class="option-checkbox">Yes</span>
                                    <br>      
                                    <label class="radio">
                                        <input type="radio" name="is_super_administrator" class="save-input" data-toggle="radio" value="0" <?= isset($user)?($user->is_super_administrator == 0)?"checked":"":"checked"  ?>>
                                    </label><span class="option-checkbox">No</span> 
                                </div>

                                <div class="col-md-4"><br>
                                    <div class="form-group">
                                        <label>Permissions</label><br>
                                        <select class="save-input multiselect" multiple="multiple" name="permissions">
                                            <?php foreach($tables as $table){ ?>
                                                <option value="<?= $table->name ?>" <?= (isset($user) && in_array($table->name, explode(',',$user->permissions)))?'selected':'' ?> ><?= $table->name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>        
                                </div>
                            </div>
                            <?php } ?>
                            
                            <br><br>
                            <?php if(isset($user) && $user->is_super_administrator == 1){ ?>
                                <a href="<?= base_url() ?>administrators/delete" onclick="return confirm('Are you sure?')"><button type="button" class="btn btn-action btn-default">Delete</button></a>
                            <?php } ?>

                            <button type="submit" class="<?= (isset($user))?"update":"create" ?>-administrator btn btn-warning btn-fill pull-right"><?= (isset($user))?"Update":"Create"  ?></button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>                    
    </div>
</div>
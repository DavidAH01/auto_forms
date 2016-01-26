<div class="form-group">
    <label class="field"><strong><?= $field['name'] ?></strong></label>
	<div class="clone-wrapper wrapper-<?= $field['complete_name'] ?>" data-field="<?= $field['complete_name'] ?>">
	    <?php if (isset($stored_data) && !empty($stored_data->{$field['complete_name']})){ ?>
	    	<?php $steps = json_decode($stored_data->{$field['complete_name']}) ?>
	    	<?php for($i=0; $i<count($steps);$i++){ ?>
				<div class="toclone"> 	
					<div class="row">
						<?php foreach ($steps[$i] as $key => $value){ ?>
							<?php if($key == "title"){ ?>
								<div class="col-md-6">
							    	<input type="text" class="info-step form-control" name="<?= $key ?>" placeholder="<?= $key ?>" value="<?= $value ?>">
								</div>
							<?php }else if($key == "content"){ ?>
								<div class="col-md-6">
									<textarea class="info-step tinymce-small" data-type="textarea" id="content-<?= $field['complete_name'] ?>-<?= $i; ?>" name="<?= $key ?>"></textarea>
								</div>
								<script>
									$(window).load(function(){
										tinyMCE.get("content-<?= $field['complete_name'] ?>-<?= $i; ?>").setContent("<?= addslashes(trim(preg_replace('[\n|\r|\n\r]', '',$value))) ?>"); 
									});
								</script>
							<?php } ?>
						<?php } ?>
					</div>
					<div class="clearfix"></div><br>
					<a href="" class="delete btn btn-default pull-right"><?= $this->lang->line('remove') ?></a>
					<a href="" class="clone btn btn-default btn-fill pull-right"><?= $this->lang->line('add') ?></a>
					<div class="clearfix"></div><br><br>
				</div>
			<?php } ?>
	    <?php }else{ ?>
		    <div class="toclone"> 
			    <div class="row">
				    <div class="col-md-6">
				    	<input type="text" class="info-step form-control" name="title" value="">
					</div>
					<div class="col-md-6">
						<textarea class="info-step tinymce-small" data-type="textarea" id="content-<?= $field['complete_name'] ?>-0" name="content"></textarea>
					</div>
				</div>
				<div class="clearfix"></div><br>
				<a href="" class="delete btn btn-default pull-right"><?= $this->lang->line('remove') ?></a>
				<a href="" class="clone btn btn-default btn-fill pull-right"><?= $this->lang->line('add') ?></a>
				<div class="clearfix"></div><br><br>
			</div>  
		<?php } ?>
	</div>
</div><hr>
<script>
    $(".wrapper-<?= $field['complete_name'] ?>").cloneya()
		.on('before_clone.cloneya', function (event, toclone) {
            tinymce.remove('textarea.tinymce-small');
        })
		.on('after_append.cloneya', function (event, toclone, newclone) {
			$(".wrapper-<?= $field['complete_name'] ?> textarea").each(function(index, el) {
				$(el).attr("id", "content-<?= $field['complete_name'] ?>-"+index);
			});
			init_tinymce_small();
        })
        .on('remove.cloneya', function (event, clone) {
        	var id = clone.find('textarea').attr('id')
        	tinymce.EditorManager.execCommand('mceRemoveEditor',true, id);
        	tinymce.remove('textarea.tinymce-small');
        	clone.remove();
        	$(".wrapper-<?= $field['complete_name'] ?> textarea").each(function(index, el) {
				$(el).attr("id", "content-<?= $field['complete_name'] ?>-"+index);
			});
			init_tinymce_small();
        });
</script>
<div id="loading-gallery"></div>
<form action="<?= base_url() ?>administrable_tables/save_files_gallery" method="post" enctype="multipart/form-data" id="form-gallery">
	<input type="hidden" value="<?= $gallery ?>" name="gallery">
	<input type="hidden" value="<?= $current_table ?>" name="table">
	<div class="fileUpload fileUpload-iframe btn btn-default btn-fill">
	    <span><?= $this->lang->line('select_files') ?></span>
	    <input type="file" class="upload" name="file[]" id="input-file-gallery" multiple/>
	</div>
</form><br><br><hr>
<div class="row">
	<div class="col-md-12">
		<ul class="content-files-gallery" id="sortable">
		<?php if ($files){ ?>
			<?php foreach ($files as $file) { ?>
				<li data-file="<?= $file->id ?>">
					<div class="delete-file"></div>
					<div class="content-image">		
						<img src="<?= base_url() ?>uploads/<?= $file->folder ?>/<?= $file->file ?>" alt="<?= $file->file ?>">
					</div>
				</li>
			<?php } ?>
		<?php }else{ ?>
			<p class="empty-gallery"><small><?= $this->lang->line('empty_gallery') ?></small></p>
		<?php } ?>
		</ul>
	</div>
</div>

<script>
	$(window).load(function() {
		$("#loading-gallery").fadeOut(500);
	});

	$("#input-file-gallery").change(function(e) {
		e.preventDefault();
		$("#loading-gallery").fadeIn(500);
		$("#form-gallery").submit();
	});

	$( "#sortable" ).disableSelection();

	$("#sortable").sortable({
        update: function() {
            $("#sortable li").each(function(){
                var id = $(this).attr('data-file');
                var order = $(this).index();
              	$.ajax({
				  	url: $('#base_url').val()+'administrable_tables/order_files',
				  	method: 'post',
				  	data: { id: id, order: order }
				});
            });       
        }
    });
	
	$(document).on('click', '.delete-file', function(){
    	var id = $(this).parent('li').attr('data-file');
    	if (confirm("<?= $this->lang->line('are_you_sure') ?>")) { 
		  	$.ajax({
			  	url: $('#base_url').val()+'administrable_tables/delete_file',
			  	method: 'post',
			  	data: { id: id }
			}).done(function(response) {
				$('li[data-file="'+id+'"]').remove();

                $.notify({
                    icon: "pe-7s-check",
                    message: response.msg
                },{
                    type: 'warning',
                    timer: 4000,
                    placement: {
                        from: 'top',
                        align: 'left'
                    }
                });
			});
		}
    });

    $(window).load(function(){
      	$('.content-files-gallery li .content-image img').each(function(){
      	var height = $(this).height();
      	var width = $(this).width();

      	var height_parent = $(this).parent().height();
      	var width_parent = $(this).parent().width();

      	var margin_left = width_parent - width;
      	var margin_top = height_parent - height;

      	if (margin_top > 0) {
        	$(this).css('margin-top', (parseInt(margin_top/2)));
      	};   

      	if (margin_left > 0) {
        	$(this).css('margin-left', (parseInt(margin_left/2)));
      	};  
    });


    });
</script>
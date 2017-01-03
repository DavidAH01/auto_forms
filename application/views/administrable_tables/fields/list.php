<div class="form-group">
    <label class="field"><strong><?= $field['name'] ?></strong></label>
    <div class="list-wrapper">
    	<?php 
			$items = array();
			if (isset($stored_data))
				$items = explode(',', $stored_data->{$field['complete_name']});
		?>
    	<ul id="sortable_<?= $field['complete_name'] ?>" class="sortable-list-field" data-field="<?= $field['complete_name'] ?>"> 
			<?php if(!empty($items[0])){ ?>
				<?php for ($i=0; $i < count($items); $i++) { ?>
					<li class="ui-state-default"><span class="content"><?php echo $items[$i] ?></span> <span class="delete-item-list-sortable">x</span></li>
				<?php } ?>
			<?php } ?>
		</ul>
		
		<div class="row">
			<div class="col-md-10">
				<input type="text" class="save-input form-control" name="<?= $field['complete_name'] ?>" placeholder="<?= $field['name'] ?>">
			</div>
			<div class="col-md-2">
				<a href="" class="btn btn-default btn-fill pull-right add-sortable-list" data-text="<?= $field['complete_name'] ?>"><?= $this->lang->line('add') ?></a>
			</div>
		</div>
    	
    <br></div>
</div><hr>

<script>
	$(document).on('click', '.add-sortable-list', function(event) {
		event.preventDefault();
		var component = $(this).data('text'),
			text = $('input[name="'+ component +'"]').val();

		if (text != "") {
			$('#sortable_' + component).append('<li class="ui-state-default"><span class="content">'+ text +'</span> <span class="delete-item-list-sortable">x</span></li>');
		}	

		$('input[name="'+ component +'"]').val('');
	});

	$(document).on('click', '.delete-item-list-sortable', function(event) {
		event.preventDefault();
		$(this).parent('li').remove();
	});

	function initSortable(){
		$( '.sortable-list-field' ).sortable({
			placeholder: 'ui-state-highlight'
		});

		$( '.sortable-list-field' ).disableSelection();
	}

	initSortable();
</script>
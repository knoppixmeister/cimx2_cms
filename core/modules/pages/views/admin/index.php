<h2>Pages</h2>

<div class="hdr_butts">
	<a class="btn btn-mini" href="<?php e(admin_url('pages/create'))?>">Create page</a> 
	<a class="btn btn-mini" href="<?php e(admin_url('pages/layouts'))?>">Page layouts</a> 
</div>

<?php if(count($items) > 0) e(form_open(admin_url('pages')))?>

<table class="table table-striped table-bordered table-condensed">
<thead>
<tr>
	<th style="width: 1%;"><input type="checkbox" id="_select_all"></th>
	<th style="width: 1%;">ID</th>
	<th>Title</th>
	<th>Slug</th>
	<th style="width: 1%;">Status</th>
	<th>Is default</th>
	<th>Created</th>
	<th colspan="3" style="text-align: center; width: 1%;">Actions</th>
</tr>
</thead>
<tbody>
<?php
	if(count($items) > 0) show_row($items, 2);
	else {
?>
<tr>
	<td colspan="10" style="text-align: center; height: 200px; vertical-align: middle;">No pages. <a href="<?php e(admin_url('pages/create'))?>">Create first one</a>.</td>
</tr>
<?php
	}
?>
</tbody>
</table>
<?php
	if(count($items) > 0) {
?>
	<input type="submit" name="delete" value="Delete selected" id="_delete_btn" class="btn btn-danger disabled" disabled="disabled">
<?php
		e(form_close());
	}

	function show_row($rows=array(), $padding=0) {
		foreach($rows as $i) {
?>
	<tr>
		<td><input type="checkbox" name="items[]" value="<?php e($i['id'])?>" class="item_checkbox" id="item_<?php e($i['id'])?>"></td>
		<td><?php e($i['id'])?>.</td>
		<td style="padding-left: <?php e($padding)?>px;">
		<?php
			foreach(config_item('supported_languages') as $k => $v) {
				e('<b>'.strtoupper($k).': </b>'.$i['title_'.$k].'<br/>');
			}
		?>
		</td>
		<td><?php e($i['slug'])?></td>
		<td style="text-align: center;">
		<?php
			if($i['status'] == "live") {
				e('<span class="label label-success">'.element($i['status'], config_item('pages_statuses')).'</span>');
			}
			elseif($i['status'] == "draft") {
				e('<span class="label">'.element($i['status'], config_item('pages_statuses')).'</span>');
			}
		?>
		</td>
		<td style="width: 100px; text-align: center;">
		<?php
			if($i['is_default'] == DB_TRUE) {
				e(form_checkbox('is_def', NULL, TRUE, 'disabled="disabled"'));
			}
		?>
		</td>
		<td style="width: 100px;">
		<?php
			$usr = get_instance()->users_model->get($i['created_by']);
		
			e('By <a href="'.admin_url('users/edit/'.$usr['id']).'">'.$usr['username']."</a><br/>at ");
			e(date('d-m-Y', $i['created_time']));
		?>
		</td>
		<td style="width: 1%;"><a class="btn btn-primary" href="<?php e(admin_url('pages/edit/'.$i['id']))?>">Edit</a></td>
		<td style="width: 1%;">
		<?php
			if(!empty($i['slug'])) {
		?>
			<nobr><a class="btn" href="<?php e(admin_url('pages/add_child/'.$i['id']))?>">Add subpage</a></nobr>
		<?php
			}
			else e('<div style="width: 30px;">&nbsp;</div>');
		?>
		</td>
		<td style="width: 1%;"><a class="btn btn-danger" href="<?php e(admin_url('pages/delete/'.$i['id']))?>">Delete</a></td>
	</tr>
<?php
			if(!empty($i['child_pages'])) show_row($i['child_pages'], $padding+10);
		}
	}
?>

<script type="text/javascript">
	window.onload = function() {
		(function($) {
			$('.item_checkbox').click(function() {
				if(this.checked) {
					$('#_delete_btn').removeAttr("disabled").removeClass('disabled');
				}
				else {
					var no_checks = true;
					$('.item_checkbox').each(function(index) {
						if(this.checked) {
							no_checks = false;
						}
					});

					if(no_checks) {
						$('#_delete_btn').attr("disabled", "disabled").addClass("disabled");
					}
				}
			});

			$("#_select_all").click(function() {
				if(!this.checked) {
					$('.item_checkbox:checked').attr('checked', false);

					$('#_delete_btn').attr("disabled", "disabled").addClass("disabled");
				}
				else {
					$('.item_checkbox:not(:checked)').attr('checked', true);

					$('#_delete_btn').removeAttr("disabled").removeClass('disabled');
				}
			});
		})(jQuery);
	};
</script>

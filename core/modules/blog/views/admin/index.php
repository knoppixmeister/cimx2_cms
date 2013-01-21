<h2>Blog</h2>

<div class="top_btns">
	<a class="btn btn-mini" href="<?php e(admin_url('blog/create'))?>">Create blog record</a> 
	<a class="btn btn-mini" href="<?php e(admin_url('blog/categories'))?>">Blog categories</a> 
	<a class="btn btn-mini" href="<?php e(admin_url('blog/settings'))?>">Blog settings</a>
</div>

<?php if(count($items) > 0) e(form_open(admin_url('blog')))?>

<table class="table table-striped table-bordered table-condensed">
<thead>
<tr>
	<th style="width: 1%;"><input type="checkbox" name="select_all" id="_select_all"/></th>
	<th>Title</th>
	<th>Category</th>
	<th style="width: 1%;">Status</th>
	<th style="width: 100px;">Date</th>
	<th colspan="2" style="width: 1%;">Actions</th>
</tr>
</thead>
<tbody>
<?php
	if(count($items) > 0) {
		foreach($items as $i) {
?>
<tr>
	<td><?php e(form_checkbox('items[]', $i['id'], set_checkbox('items[]', $i['id'], FALSE), 'id="item_" class="item_checkbox"'))?></td>
	<td>
	<?php
		foreach(config_item('supported_languages') as $l => $v) {
			e("<b>".strtoupper($l).":</b> ".$i['title_'.$l]."<br/>");
		}
	?>
	</td>
	<td>
	<?php
		$c = $this->blog_categories_model->get($i['category_id']);
		e($c['title']);
	?>
	</td>
	<td style="text-align: center;">
	<?php
		if($i['status'] == "draft")	e('<span class="label">'.element($i['status'], config_item('blog_statuses')).'</div>');
		elseif($i['status'] == "live") e('<span class="label label-success">'.element($i['status'], config_item('blog_statuses'))."</span>");
	?>
	</td>
	<td><?php e(date('d-m-Y', $i['created_time']))?></td>
	<td style="width: 1%;"><a class="btn" href="<?php e(admin_url('blog/edit/'.$i['id']))?>">Edit</a></td>
	<td style="width: 1%;"><a class="btn btn-danger" href="<?php e(admin_url('blog/delete/'.$i['id']))?>">Delete</a></td>
</tr>
<?php
		}
	}
	else {
?>
<tr>
	<td colspan="8" style="text-align: center; height: 200px;">No blog records. <a href="<?php e(admin_url('blog/create'))?>">Add first record</a>.</td>
</tr>
<?php
	}
?>
</tbody>
</table>
<?php
	if(count($items) > 0) {
?>
	<input type="submit" name="delete" value="Delete selected" id="_delete_btn" class="btn btn-danger" disabled="disabled">

<?php e(form_close()) ?>

	{tag:pager:show base_url="<?php e(admin_url('blog'))?>" page="<?php e($page)?>" per_page="10" items_count="<?php e($items_count)?>" type="ul"}
<?php
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

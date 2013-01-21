<h2>Blog categories</h2>

<div class="top_btns">
	<a class="btn btn-mini" href="<?php e(admin_url('blog'))?>">Blog</a> 
	<a class="btn btn-mini" href="<?php e(admin_url('blog/categories/create'))?>">Create blog category</a> 
	<a class="btn btn-mini" href="<?php e(admin_url('blog/settings'))?>">Blog settings</a>
</div>

<table class="table table-striped table-bordered table-condensed">
<thead>
<tr>
	<th style="width: 1%;"><?php e(form_checkbox('select_all', 1, set_checkbox('select_all', 1, FALSE), 'id="_select_all"'))?></th>
	<th>Title</th>
	<th>Slug</th>
	<th colspan="2" style="width: 1%;">Actions</th>
</tr>
</thead>
<tbody>
<?php
	if(count($items) > 0) show_row($items, 5);
	else {
?>
<tr>
	<td colspan="4" style="text-align: center; height: 100px;">No blog categories</td>
</tr>
<?php
	}
?>
</tbody>
</table>
<?php
	function show_row($rows=array(), $padding=0) {
		foreach($rows as $i) {
?>
	<tr>
		<td><input type="checkbox" name="items[]" value="<?php e($i['id'])?>" class="item_checkbox" id="item_<?php e($i['id'])?>"></td>
		<td style="padding-left: <?php e($padding)?>px;">
		<?php
			foreach(config_item('supported_languages') as $k => $v) {
				e('<b>'.strtoupper($k).': </b>'.$i['title_'.$k].'<br/>');
			}
		?>
		</td>
		<td><?php e($i['slug'])?></td>
		<td style="width: 1%;"><a class="btn btn-primary" href="<?php e(admin_url('blog/categories/edit/'.$i['id']))?>">Edit</a></td>
		<td style="width: 1%;">
		<?php
			if(!empty($i['slug'])) {
		?>
			<nobr><a class="btn" href="<?php e(admin_url('blog/categories/add_child/'.$i['id']))?>">Add subcategory</a></nobr>
		<?php
			}
			else e('<div style="width: 30px;">&nbsp;</div>');
		?>
		</td>
		<td style="width: 1%;"><a class="btn btn-danger" href="<?php e(admin_url('blog/categories/delete/'.$i['id']))?>">Delete</a></td>
	</tr>
<?php
			if(!empty($i['child_categories'])) show_row($i['child_categories'], $padding+10);
		}
	}
?>

<h2><?php _l('letter_templates_admin_title')?></h2>

<div class="top_btns">
	<a class="btn btn-mini" href="<?php e(admin_url('letter_templates/create'));?>">Create letter template</a>
</div>

<table class="table table-striped table-bordered table-condensed">
<thead>
<tr>
	<th>Name</th>
	<th>Slug</th>
	<th>Description</th>
	<th style="width: 1%;">Language</th>
	<th colspan="2" style="width: 1%;"></th>
</tr>
</thead>
<tbody>
<?php
	if(count($items) > 0) {
		foreach($items as $i) {
?>
<tr>
	<td><?php e($i['name'])?></td>
	<td><?php e($i['slug'])?></td>
	<td><?php e($i['description'])?></td>
	<td><?php e(element('name', element($i['language'], config_item('supported_languages'))))?></td>
	<td><a class="btn" href="<?php e(admin_url('letter_templates/edit/'.$i['id']))?>">Edit</a></td>
	<td><a class="btn btn-danger" href="<?php e(admin_url('letter_templates/delete/'.$i['id']))?>">Delete</a></td>
</tr>
<?php
		}
	}
	else {
?>
<tr>
	<td colspan="7" style="text-align: center; height: 200px;">No letter templates.</td>
</tr>
<?php
	}
?>
</tbody>
</table>
	
{tag:pager:show base_url="<?php e(admin_url('letter_templates'))?>" page="<?php e($page)?>" items_count="<?php e($items_count)?>" per_page="<?php e($per_page)?>" type="ul"}

<h2>Comments</h2>

<table class="table table-striped table-bordered table-condensed">
<thead>
<tr>
	<th style="width: 1%;"><input type="checkbox" name="select_all" id="select_all"></th>
	<th>Title</th>
	<th>Created</th>
	<th>Module</th>
	<th>Module Id</th>
	<th>Is Approved</th>
	<th colspan="2" style="width: 1%;">Actions</th>
</tr>
</thead>
<tbody>
<?php
	if(count($items) > 0) {
		foreach($items as $i) {
?>
<tr>
	<td><?php e(form_checkbox('item_', 1, set_value('item_', FALSE), 'id="item_" class="item_select"'))?></td>
	<td><?php e($i['title'])?></td>
	<td><?php e($i['username'])?>
	<?php e(date('d-m-Y', $i['created_time']))?></td>
	<td><?php e($i['module'])?></td>
	<td><?php e($i['module_id'])?></td>
	<td><?php e($i['is_approved'] == DB_FALSE ? "No" : "Yes")?></td>
	<td><a class="btn btn-primary" href="<?php e(admin_url('comments/edit/'.$i['id']))?>">Edit</a></td>
	<td><a class="btn btn-danger" href="<?php e(admin_url('comments/delete/'.$i['id']))?>">Delete</a> </td>
</tr>
<?php
		}
	}
	else {
?>
<tr>
	<td colspan="9" style="text-align: center; height: 100px;">No comments</td>
</tr>
<?php
	}
?>
</tbody>
</table>

{tag:pager:show base_url="<?php e(admin_url('comments'))?>" page="<?php e($page)?>" items_count="<?php e($items_count)?>" per_page="<?php e($per_page)?>" type="ul"}


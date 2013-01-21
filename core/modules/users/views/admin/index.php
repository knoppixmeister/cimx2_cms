<h2>Users</h2>

<div class="top_btns">
	<a class="btn btn-mini" href="<?php e(admin_url('users/create'))?>">Create user</a> 
	<a class="btn btn-mini" href="<?php e(admin_url('users/roles'))?>">User roles</a> 
</div>

<table class="table table-striped table-bordered table-condensed">
<thead>
<tr>
	<th>Full Name</th>
	<th>Username</th>
	<th>E-mail</th>
	<th>Role</th>
	<th style="width: 1%;">Activated?</th>
	<th style="width: 1%;">Status</th>
	<th style="width: 1%;" colspan="2">Actions</th>
</tr>
</thead>
<tbody>
<?php
	foreach($items as $i) {
?>
<tr>
	<td><?php e($i['first_name']." ".$i['last_name'])?></td>
	<td><?php e($i['username'])?></td>
	<td><?php e($i['email'])?></td>
	<td><?php e($i['role_name'])?></td>
	<td style="text-align: center;">
	<?php
		e($i['activated'] == DB_TRUE ? '<span class="label label-success">yes</span>' : '<span class="label label-important">no</span>');
	?>
	</td>
	<td><?php e($i['status'] == 'active' ? '<span class="label label-success">active</span>' : '<span class="label label-important">inactive</span>')?></td>
	<td style="width: 1%;"><a class="btn" href="<?php e(admin_url('users/edit/'.$i['id']))?>">Edit</a></td>
	<td style="width: 1%;">
	<?php
		if($user['id'] != $i['id']) {
	?>
		<a class="btn btn-danger" href="<?php e(admin_url('users/delete/'.$i['id']))?>">Delete</a>
	<?php
		}
	?>
	</td>
</tr>
<?php
	}
?>
</tbody>
</table>

{tag:pager:show page="<?php e($page) ?>" items_count="<?php e($items_count)?>" per_page="<?php e($per_page) ?>" type="ul"}

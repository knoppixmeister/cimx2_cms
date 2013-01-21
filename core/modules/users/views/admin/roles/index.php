<h2>User roles</h2>

<div class="top_btns">
	<a class="btn btn-mini" href="<?php e(admin_url('users'))?>">Users</a> 
	<a class="btn btn-mini" href="<?php e(admin_url('users/roles/create'))?>">Create role</a>
</div>

<table class="table table-striped table-bordered table-condensed">
<thead>
<tr>
	<th>Name</th>
	<th>Description</th>
	<th style="width: 1%;" colspan="2">Actions</th>
</tr>
</thead>
<tbody>
<?php
	if(count($items) > 0) {
		foreach($items as $i) {
?>
<tr>
	<td><?php e($i['name'])?></td>
	<td><?php e($i['description'])?></td>
	<td style="text-align: center;"><a class="btn" href="<?php e(admin_url('users/roles/edit/'.$i['id']))?>">Edit</a></td>
	<td>
		<?php
			if($i['id'] > 2) {
		?>
		<a class="btn btn-danger" href="<?php e(admin_url('users/roles/delete/'.$i['id']))?>">Delete</a>
		<?php
			}
			else e('&nbsp;');
		?>
	</td>
</tr>
<?php
		}
	}
	else {
?>
<tr>
	<td colspan="4" style="text-align: center; height: 100px;">No roles</td>
</tr>
<?php
	}
?>
</tbody>
</table>

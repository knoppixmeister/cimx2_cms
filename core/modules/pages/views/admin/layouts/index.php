<h2>Page layouts</h2>

<div class="top_btns">
	<a class="btn btn-mini" href="<?php e(admin_url('pages'))?>">Pages</a> 
	<a class="btn btn-mini" href="<?php e(admin_url('pages/layouts/create'))?>">Create page layout</a>
</div>

<table class="table table-striped table-bordered table-condensed">
<thead>
<tr>
	<th>Theme</th>
	<th>Title</th>
	<th>File Layout</th>
	<th colspan="2" style="width: 1%;">Actions</th>
</tr>
</thead>
<tbody>
<?php
	if(count($items) > 0) {
		foreach($items as $i) {
?>
<tr>
	<td><?php e($i['theme'])?></td>
	<td><?php e($i['title'])?></td>
	<td><?php e($i['layout_file'])?></td>
	<td><a class="btn btn-primary" href="<?php e(admin_url('pages/layouts/edit/'.$i['id']))?>">Edit</a></td>
	<td><a class="btn btn-danger" href="<?php e(admin_url('pages/layouts/delete/'.$i['id']))?>">Delete</a></td>
</tr>
<?php
		}
	}
	else {
?>
<tr>
	<td colspan="5" style="text-align: center; height: 100px;">No layouts</td>
</tr>
<?php
	}
?>
</tbody>
</table>

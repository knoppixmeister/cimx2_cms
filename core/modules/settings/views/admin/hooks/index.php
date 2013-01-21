<table width="100%">
<thead>
<tr>
	<th>Point</th>
	<th>Path</th>
	<th>File</th>
	<th>Class</th>
	<th>Function</th>
	<th colspan="3" style="width: 1%;">Actions</th>
</tr>
</thead>
<tbody>
<?php
	foreach($this->hooks_model->points as $p) {
		if(!empty($items[$p])) {
			foreach($items[$p] as $i) {
?>
<tr>
	<td><?php e($p)?></td>
	<td><?php e($i['filepath'])?></td>
	<td><?php e($i['filename'])?></td>
	<td><?php e($i['class'])?></td>
	<td><?php e($i['function'])?></td>
	<td>Edit</td>
	<td>Enable/Disable</td>
	<td><a href="<?php e(base_url()."admin/".$module."/hooks/delete/1");?>">Delete</a></td>
</tr>
<?php
			}
		}
	}
?>
</tbody>
</table>

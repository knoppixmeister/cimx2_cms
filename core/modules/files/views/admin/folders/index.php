<div class="hdr_butts">
	<a class="btn btn-mini" href="<?php e(admin_url('files/folders/create'));?>">Create folder</a>
</div>

<table class="table table-striped table-bordered table-condensed">
<thead>
<tr>
	<th>Name</th>
	<th>Slug</th>	
	<th colspan="3" style="text-align: center; width: 1%;">Actions</th>
</tr>
</thead>
<tbody>
<?php
	if(count($items) > 0) show_row($items, 2);

	function show_row($rows=array(), $padding=0) {
		foreach($rows as $i) {
?>
	<tr>
		<td style="padding-left: <?php e($padding)?>px;"><a href="<?php e(admin_url('files/folders/content/'.$i['id']))?>"><?php e($i['name'])?></a></td>
		<td><?php e($i['slug'])?></td>
		<?php
			if($i['name'] != "/") {
		?>
		<td><a class="btn btn-primary" href="<?php e(admin_url('files/folders/edit/'.$i['id']))?>">Edit</a></td>
		<td><nobr><a class="btn" href="<?php e(admin_url('files/folders/add_subfolder/'.$i['id']))?>">Add child</a></nobr></td>
		<td><a class="btn btn-danger" href="<?php e(admin_url('files/folders/delete/'.$i['id']))?>">Delete</a></td>
		<?php
			}
			else {
		?>
		<td colspan="3">&nbsp;</td>
		<?php
			}
		?>
	</tr>
<?php
			if(!empty($i['childs'])) show_row($i['childs'], $padding+10);
		}
	}
?>
</tbody>
</table>

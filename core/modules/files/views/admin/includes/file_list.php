<table class="table table-striped table-bordered table-condensed">
<thead>
<tr>
	<th style="width: 1%;"><input type="checkbox" id="_select_all"></th>
	<th></th>
	<th>File</th>
	<th>Title</th>
	<th style="width: 100px;">Type</th>
	<th>Size</th>
	<th colspan="2" style="width: 1%;">Actions</th>
</tr>
</thead>
<tbody>
<?php
	if(count($items) > 0) {
		foreach($items as $i) {
?>
<tr>
	<td><input type="checkbox" name="item_<?php e($i['id'])?>" id="item_<?php e($i['id'])?>"></td>
	<td style="width: 40px;">
	<?php
		if(!empty($i['image_width']) && !empty($i['image_height'])) {
	?>
		<img width="40" src="<?php e(base_url())?>public/uploads/<?php e(date('Y/m', $i['created_time']))?>/<?php e($i['file_name'])?>"/>
	<?php
		}
	?>
	</td>
	<td>
		<a href="<?php e(base_url())?>public/uploads/<?php e(date('Y/m', $i['created_time']))?>/<?php e($i['file_name'])?>" target="_blank">
			<?php e($i['file_name'])?>
		</a>&nbsp;<a href="<?php e(site_url('files/download/'.$i['id']))?>" target="_blank"><i class="icon-download"></i></a>
	</td>
	<td><?php e($i['title'])?></td>
	<td><?php e($i['file_mime_type'])?></td>
	<td style="text-align: center;">
	<?php
		if(!empty($i['image_width']) && !empty($i['image_height'])) e($i['image_width']."x".$i['image_height']."<br/>");

		e($i['file_size'])?> Kb
	</td>
	<td><a href="<?php e(admin_url('files/edit/'.$i['id']))?>" class="btn btn-primary">Edit</a></td>
	<td><a href="<?php e(admin_url('files/delete/'.$i['id']))?>" class="btn btn-danger">Delete</a></td>
</tr>
<?php
		}
	}
	else {
?>
<tr>
	<td colspan="7" style="text-align: center; height: 200px;">No files</td>
</tr>
<?php
	}
?>
</tbody>
</table>
<?php
	if(count($items) > 0) {
?>
<a href="#" class="btn btn-danger" id="items_list_delete">Delete selected</a>

<div class="pagination">
	<ul>
		<li><a href="#">←</a></li>
		<li class="active"><a href="#">10</a></li>
		<li class="disabled"><a href="#">...</a></li>
		<li><a href="#">20</a></li>
		<li><a href="#">→</a></li>
	</ul>
</div>
<?php
	}
?>

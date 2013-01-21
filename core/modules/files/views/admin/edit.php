<h2>Edit file</h2>

<?php e(form_open(admin_url('files/edit/'.$item['id']))) ?>

	<table class="edit_file_tbl">
	<tr>
		<th>Folder&nbsp;<font color="red">*</font></th>
		<td><?php e(form_dropdown('folder', $parent_folders, set_value('folder', $item['folder_id']), 'id="folder"'))?></td>
	</tr>
	<tr>
		<td style="width: 150px;">
		<?php
			if(is_numeric($item['image_width']) && is_numeric($item['image_height'])) {
				if($item['image_width'] > 40) {
		?>
			<img style="border: 1px solid gray;" src="<?php e(site_url('files/thumb/'.$item['id']."/150"))?>"/>
		<?php
				}
				else {
		?>
			<img style="width: 150px;" alt="" src="<?php e(base_url(TRUE))?>public/uploads/<?php e(date('Y/m', $item['created_time'])."/".$item['file_name'])?>"/>
		<?php
				}
			}
		?>
		</td>
		<td style="vertical-align: top;">

			<table>
			<tr>
				<th>File name</th>
				<td><?php e($item['file_name'])?></td>
			</tr>
			<tr>
				<th>File type</th>
				<td><?php e($item['file_mime_type'])?></td>
			</tr>
			<tr>
				<th>File size</th>
				<td><?php e($item['file_size']." Kb")?></td>
			</tr>
			<tr>
				<th>Upload date</th>
				<td><?php e(date('d.m.Y', $item['created_time']))?></td>
			</tr>
			<?php
				if(!empty($item['image_width']) && !empty($item['image_height'])) {
			?>
			<tr>
				<th>Dimensions</th>
				<td><?php e($item['image_width']."&nbsp;x&nbsp;".$item['image_height'])?></td>
			</tr>
			<?php
				}
			?>
			</table>

		</td>
	</tr>
	<tr>
		<td colspan="2" style="padding-top: 10px;">&nbsp;</td>
	</tr>
	<tr>
		<th>Title&nbsp;<font color="red">*</font></th>
		<td><?php e(form_input('file_title', set_value('file_title', $item['title']), 'style="width: 500px;"'))?></td>
	</tr>
	<tr>
		<th>Description</th>
		<td><?php e(form_textarea('description', set_value('description', $item['description']), 'style="width: 500px;"'))?></td>
	</tr>
	<tr>
		<th>File URL</th>
		<td>
			<?php e(form_input('file_url', base_url(TRUE)."public/uploads/".date('Y/m', $item['created_time'])."/".$item['file_name'], 'style="width: 500px;" id="file_url" onclick="this.select()" readonly'))?> 
			<a href="<?php e(base_url(TRUE))?>public/uploads/<?php e(date('Y/m', $item['created_time'])."/".$item['file_name'])?>" target="_blank">Link</a>
		</td>
	</tr>
	</table>

	<div class="bottom_btns">
		<input type="submit" class="btn btn-primary" value="Save" name="save">
		<input type="submit" class="btn" value="Save & exit" name="save_exit">
		<span style="padding-left: 20px;">
			<a class="btn" href="<?php e(admin_url('files/folders/content/'.$item['folder_id']))?>">Cancel</a>
		</span>
		<span style="float: right;">
			<a href="<?php e(admin_url('files/delete/'.$item['id']))?>" class="btn btn-danger">Delete</a>
		</span>
	</div>

<?php e(form_close())?>

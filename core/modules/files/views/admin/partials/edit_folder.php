<table id="edit_folder_tbl">
<tr>
	<th>Parent folder&nbsp;<font color="red">*</font></th>
	<td><?php e(form_dropdown('parent', $parent_folders, set_value('parent', $item['parent_id']), 'id="parent_folder_id"'))?></td>
</tr>
<tr>
	<th>Folder name&nbsp;<font color="red">*</font></th>
	<td><?php e(form_input('name', set_value('name', $item['name']), 'id="folder_name"'))?></td>
</tr>
</table>

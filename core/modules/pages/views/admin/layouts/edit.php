<h2><?php e(ucfirst($action))?> page layout</h2>

<?php e(form_open($action_url))?>

	<table class="edit_tbl" width="100%">
	<tr>
		<th style="width: 20%;">Title <font color="red">*</font></th>
		<td><?php e(form_input('title', set_value('title', $item['title']), 'style="width: 400px;"'))?></td>
	</tr>
	<tr>
		<th style="width: 20%;">Theme <font color="red">*</font></th>
		<td><?php e(form_dropdown('theme', $themes, set_value('theme', $item['theme'])))?></td>
	</tr>
	<tr>
		<th>Layout file <font color="red">*</font></th>
		<td><?php e(form_dropdown('layout', $layouts, set_value('layout', $item['layout_file'])))?></td>
	</tr>
	<!--
	<tr>
		<th>Content</th>
		<td colspan="2">
			<textarea rows="10" cols="50" name="content"><?php e(set_value('content', $item['content']));?></textarea>
			<script type="text/javascript">CKEDITOR.replace('text', {enterMode : CKEDITOR.ENTER_BR});</script>
		</td>
	</tr>
	-->
	</table>

	<div class="bottom_btns">
		<input class="btn btn-primary" type="submit" value="Save" name="save"/>
		<input class="btn" type="submit" value="Save & Exit" name="save_exit"/>
		<span style="padding-left: 20px;"><a class="btn" href="<?php e(admin_url('pages/layouts'))?>">Cancel</a></span>
		<?php
			if($action == "edit") {
		?>
		<span><a href="<?php e(admin_url('pgaes/layouts/delete/'.$item['id']))?>" class="btn btn-danger pull-right">Delete</a></span>
		<?php
			}
		?>
	</div>
	
<?php e(form_close())?>

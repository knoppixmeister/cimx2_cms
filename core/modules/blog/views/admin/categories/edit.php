<h2><?php e(ucfirst($action))?> blog category</h2>

<br/>

<?php e(form_open($action_url, array('class' => "form-horizontal", )))?>

<fieldset>

	<div class="control-group">
		<label for="code" class="control-label">Parent category:</label>
		<div class="controls">
			<?php e(form_dropdown('parent_category', $parent_categories, set_value('parent_category', $item['parent_id'])))?>
		</div>
	</div>

	<?php
		foreach(config_item('supported_languages') as $l => $v) {
	?>
	<div class="control-group">
		<label for="code" class="control-label">Title <?php e(strtoupper($l))?>: <font color="red">*</font></label>
		<div class="controls">
			<input type="text" id="title_<?php e($l)?>" name="title_<?php e($l)?>" value="<?php e(set_value('title_'.$l, $item['title_'.$l]))?>" class="input-xlarge" style="width: 500px;">
			<?php e(($l == config_item('default_language') ? '<font color="blue">*</font>' : "")) ?>
		</div>
	</div>
	<?php
		} 
	?>

	<div class="control-group">
		<label for="code" class="control-label">Slug: <font color="red">*</font></label>
		<div class="controls">
			<input type="text" id="slug" name="slug" value="<?php e(set_value('slug', $item['slug']))?>" class="input-xlarge" style="width: 500px;">
		</div>
	</div>

	<div class="control-group">
		<label for="code" class="control-label">Description</label>
		<div class="controls">
			<?php e(form_textarea('description', set_value('description', $item['description']), 'style="width: 500px;"'))?>
		</div>
	</div>

	<div class="form-actions">
		<input class="btn btn-primary" type="submit" name="save" value="Save"> 
		<input class="btn" type="submit" value="Save & Exit" name="save_exit"> 
		<span style="padding-left: 30px;">
			<a class="btn" href="<?php e(admin_url('blog/categories'))?>">Cancel</a>
		</span>	
	</div>

</fieldset>

<?php e(form_close())?>

<script type="text/javascript">
	$("#title_<?php e(config_item('default_language'))?>").keyup(function() {
		$.get("<?php e(site_url('ajax/url_title?title='))?>"+$("#title_<?php e(config_item('default_language'))?>").val(), function(data) {
			$("#slug").val(data);
		});
	});
</script>

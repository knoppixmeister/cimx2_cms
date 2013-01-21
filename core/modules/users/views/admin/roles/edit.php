<h2><?php e(ucfirst($action))?> role</h2>

<?php e(form_open($action_url, array('class' => "form-horizontal", )))?>

<fieldset>

	<div class="control-group">
		<label for="code" class="control-label">Name: *</label>
		<div class="controls">
			<input type="text" id="name" name="name" value="<?php e(set_value('name', $item['name']))?>" class="input-xlarge span8">
		</div>
	</div>

	<div class="control-group">
		<label for="description" class="control-label">Description</label>
		<div class="controls">
			<textarea rows="5" name="description" id="description" class="input-xlarge span8"><?php e(set_value('textarea', $item['description']))?></textarea>
		</div>
	</div>

	<div class="form-actions">
		<button class="btn btn-primary" type="submit" name="save">Save</button> 
		<input class="btn" type="submit" value="Save & Exit" name="save_exit"> 
		<span style="padding-left: 30px;">
			<a class="btn" href="<?php e(admin_url('users/roles'))?>">Cancel</a>
		</span>	
	</div>

</fieldset>

<?php e(form_close())?>

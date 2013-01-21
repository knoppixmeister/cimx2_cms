<h2>Create folder</h2>

<?php e(form_open(admin_url('files/edit_folder/?path=/')))?>

	<?php require_once dirname(__FILE__).'/partials/edit_folder.php' ?>

	<div class="bottom_btns" style="margin-top: 20px; margin-bottom: 30px;">
		<input class="btn btn-primary" type="submit" value="Save" name="save"/>
		<input class="btn" type="submit" value="Save & Exit" name="save_exit"/>
		<span style="padding-left: 20px;"><a class="btn" href="<?php e(admin_url($module))?>" id="cancel">Cancel</a></span>
		<span><a href="<?php e(admin_url('files/delete_folder/'.$item['id']))?>" class="btn btn-danger" style="float: right;">Delete</a></span>
	</div>

<?php e(form_close()) ?>

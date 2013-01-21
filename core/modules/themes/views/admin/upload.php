<h2>Upload theme</h2>

<?php e(form_open_multipart(admin_url('themes/upload')))?>

	<input type="file" name="theme"/><br/>
	<br/>
	<input class="btn btn-primary" type="submit" value="Submit"/>
	<span style="padding-left: 30px;">
		<a class="btn" href="<?php e(admin_url('themes'))?>">Cancel</a>
	</span>

<?php e(form_close())?>

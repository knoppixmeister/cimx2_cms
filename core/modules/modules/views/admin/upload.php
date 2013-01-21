<h2>Upload module</h2>

<?php e(form_open_multipart(admin_url('modules/upload', TRUE)))?>

	<input type="file" name="module"/><br/>
	<input class="btn btn-primary" type="submit" value="Submit"/>
	<input class="btn" type="submit" value="Cancel" name="cancel"/>

<?php e(form_close())?>

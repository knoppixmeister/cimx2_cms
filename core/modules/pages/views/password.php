<?php
	e('<div class="errors">'.validation_errors()."</div>");

	e(form_open(site_url()));
?>

	<div>
		<p><?php _l('pages_password_protected')?></p>
		<br/>
		<?php e(form_password('password'))?>
	</div>
	<input type="submit" value="Submit"/>

<?php e(form_close())?>

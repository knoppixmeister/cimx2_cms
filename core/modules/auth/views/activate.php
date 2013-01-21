<h2>{tag:lang:auth_activate_account}</h2>
<?php
	e(form_open("auth/activate"));

	if(!empty($msg)) {
?>
	<div class="error msg_activate_error"><p><?php e($msg)?></p></div>
<?php
	}

	if(validation_errors() != "") {
?>
		<div class="error activate_error"><?php e(validation_errors())?></div>
<?php
	}
?>

	<table class="activate_tbl">
	<tr>
		<th width="30%">{tag:lang:line name="auth_email"}:</th>
		<td><?php e(form_input('email', set_value('email')))?></td>
	</tr>
	<tr>
		<th>{tag:lang:line name="auth_activation_code"}:</th>
		<td><?php e(form_input('code', set_value('code')))?></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" value="{tag:lang:line name='auth_activate'}"/></td>
	</tr>
	</table>

<?php e(form_close())?>

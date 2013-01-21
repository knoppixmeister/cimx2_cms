<h2>{tag:lang:line name="auth_password_reset"}</h2>
<?php
	e(form_open('auth/password_reset/'.$code));

		$msg = $this->session->flashdata('msg');
		if(!empty($msg)) e('<div class="success">'.$msg.'</div>');

		if(validation_errors() != "") {
?>
		<div class="error forgot_pass_error"><?php e(validation_errors())?></div>
<?php
		}
?>

	<table class="forgot_pass_tbl">
	<tr>
		<th width="30%">{tag:lang:line name="auth_password"}</th>
		<td><?php e(form_password('password', set_value('password'), 'id="password"'))?></td>
	</tr>
	<tr>
		<th width="30%">{tag:lang:line name="auth_confirm_password"}</th>
		<td><?php e(form_password('confirm_password', set_value('confirm_password'), 'id="confirm_password"'))?></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" value="{tag:lang:line name='auth_reset'}"></td>
	</tr>
	<tr>
		<td colspan="2">
			<a href="<?php e(site_url('login'))?>">{tag:lang:line name="auth_signin"}</a> 
			<a href="<?php e(site_url('register'))?>">{tag:lang:line name="auth_register"}</a>
		</td>
	</tr>
	</table>

<?php e(form_close())?>

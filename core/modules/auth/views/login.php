<h2>{tag:lang:line name="auth_signin"}</h2>
<?php
	$next_url = (!empty($next) ? "?next=".urlencode($next) : "" );

	e(form_open('login'.$next_url));

		$msg = $this->session->flashdata('msg');
		if(!empty($msg)) e('<div class="success">'.$msg.'</div>');

		if(validation_errors() != "") {
?>
		<div class="error sigin_error"><?php e(validation_errors())?></div>
<?php
		}
?>

	<table class="login_tbl">
	<tr>
		<th width="30%">{tag:lang:line name="auth_<?php e($auth_type)?>"}</th>
		<td><?php e(form_input('user_id', set_value('user_id')))?></td>
	</tr>
	<tr>
		<th>{tag:lang:line name="auth_password"}</th>
		<td><input type="password" name="password"/></td>
	</tr>
	<tr>
		<th></th>
		<td><?php e(form_checkbox('remember_me', 1, set_checkbox('remember_me', 1), 'id="rm"'))?> <label for="rm">{tag:lang:line name="auth_remember_me"}</label></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" value="{tag:lang:line name='auth_signin'}"></td>
	</tr>
	<tr>
		<td></td>
		<td style="padding-top: 10px;">
			<a href="<?php e(site_url('auth/forgot_password'))?>">{tag:lang:auth_forgot_password}</a> |  
			<a href="<?php e(site_url('register'))?>">{tag:lang:auth_register}</a>
		</td>
	</tr>
	</table>

<?php e(form_close())?>

<h2>{tag:lang:auth_password_retrieval}</h2>
<?php
	e(form_open('auth/forgot_password'));

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
		<th width="30%">{tag:lang:line name="auth_email"}</th>
		<td><?php e(form_email('email', set_value('email'), 'id="email" required="required"'))?></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" value="{tag:lang:auth_get_new_password}"></td>
	</tr>
	<tr>
		<td></td>
		<td style="padding-top: 10px;">
			<a href="<?php e(site_url('login'))?>">{tag:lang:auth_signin}</a> | 
			<a href="<?php e(site_url('register'))?>">{tag:lang:auth_register}</a>
		</td>
	</tr>
	</table>

<?php e(form_close())?>

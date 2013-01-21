<?php
	e(form_open(admin_url('login')))
?>

	<div style="margin: 0 auto; margin-top: 100px; width: 300px;" class="well" id="admin_login_tbl_wrapper">

		<h3 style="padding-bottom: 10px;">Administration Login</h3>

	<?php
		if(validation_errors() != "") {
	?>
		<div class="alert alert-error">
		 	<a data-dismiss="alert" class="close">×</a>
		 	<?php e(validation_errors())?>
	    </div>
	<?php
		}
	?>

		<table class="admin_login_tbl" style="width: 100%;">
		<tr>
			<th width="30%">Username</th>
			<td><?php e(form_input('username', set_value('username')))?></td>
		</tr>
		<tr>
			<th>Password</th>
			<td><?php e(form_password('password', set_value('password')))?></td>
		</tr>
		<tr>
			<th></th>
			<td><?php e(form_checkbox('remember_me', 1, set_checkbox('remember_me', 1)))?>&nbsp;Remember me</td>
		</tr>
		<tr>
			<td></td>
			<td style="padding-top: 10px;"><input class="btn btn-primary" type="submit" value="Sign in"></td>
		</tr>
		<tr>
			<td colspan="2" style="padding-top: 10px; text-align: right;">
				<a href="<?php e(site_url(''))?>" target="_blank">View site home page</a>
			</td>
		</tr>
		</table>

	</div>

<?php e(form_close())?>

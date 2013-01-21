<h2>{tag:lang:line name="auth_register"}</h2>
<?php
	e(form_open('register'));

		$msg = $this->session->flashdata('msg');
		if(!empty($msg)) e('<div class="success">'.$msg.'</div>');

		if(validation_errors() != "") {
?>
		<div class="error register_error"><?php e(validation_errors())?></div>
<?php
		}
?>

	<table class="register_tbl">
	<tr>
		<th width="30%">{tag:lang:line name="auth_first_name"}</th>
		<td><?php e(form_input('first_name', set_value('first_name')))?></td>
	</tr>
	<tr>
		<th width="30%">{tag:lang:line name="auth_last_name"}</th>
		<td><?php e(form_input('last_name', set_value('last_name')))?></td>
	</tr>
	<tr>
		<th width="30%">{tag:lang:line name="auth_username"}</th>
		<td>
			<?php e(form_input('username', set_value('username'), 'id="username"'))?><span id="username_check_res"></span>

			<script type="text/javascript">
				$('#username').blur(function() {
					if($("#username").val() != "") {
						$.get('<?php e(site_url('auth/check_data?type=username&data='))?>'+$("#username").val(), function(data) {
							if(data.status == "err") {
								$('#username_check_res').html('{tag:theme:image file="ok_green.gif"}');
							}
							else if(data.status == "ok") {
								$('#username_check_res').html('{tag:theme:image file="err_red.gif"}');
							}
						});
					}
				});
			</script>
		</td>
	</tr>
	<tr>
		<th width="30%">{tag:lang:line name="auth_email"}</th>
		<td>
			<?php e(form_input('email', set_value('email'), 'id="email"'))?><span id="email_check_res"></span>

			<script type="text/javascript">
				$('#email').blur(function() {
					if($("#email").val() != "") {
						$.get('<?php e(site_url('auth/check_data?type=email&data='))?>'+$("#email").val(), function(data) {
							if(data.status == "err") {
								$('#email_check_res').html('{tag:theme:image file="ok_green.gif"}');
							}
							else if(data.status == "ok") {
								$('#email_check_res').html('{tag:theme:image file="err_red.gif"}');
							}
						});
					}
				});
			</script>
		</td>
	</tr>
	<tr>
		<th>{tag:lang:line name="auth_password"}</th>
		<td><?php e(form_password('password', set_value('password')))?></td>
	</tr>
	<tr>
		<th>{tag:lang:line name="auth_confirm_password"}</th>
		<td><?php e(form_password('confirm_password', set_value('confirm_password')))?></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" value="{tag:lang:line name='auth_register'}"></td>
	</tr>
	<tr>
		<td colspan="2"><a href="<?php e(site_url('login'))?>">{tag:lang:line name="auth_signin"}</a></td>
	</tr>
	</table>

<?php e(form_close())?>

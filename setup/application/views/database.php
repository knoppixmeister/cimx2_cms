<div style="width: 984px; margin: 0 auto; border: 1px solid silver;">

	<?php if(validation_errors() != "") e(validation_errors())?>

	<?php e(form_open(site_url('setup/step4')))?>

		<h2>Database settings</h2>

		<table>
		<tr>
			<th>Type</th>
			<td>
				<select name="db_type" disabled="disabled">
					<option value="mysql">MySQL</option>
				</select>
			</td>
		</tr>
		<tr>
			<th>Hostname</th>
			<td><?php e(form_input('db_hostname', set_value('db_hostname', 'localhost')))?></td>
		</tr>
		<tr>
			<th>Port</th>
			<td><?php e(form_input('db_port', set_value('db_port', '3306')))?></td>
		</tr>
		<tr>
			<th>Username</th>
			<td><?php e(form_input('db_username', set_value('db_username')))?></td>
		</tr>
		<tr>
			<th>Password</th>
			<td><?php e(form_input('db_password', set_value('db_password')))?></td>
		</tr>
		<tr>
			<th>Database name</th>
			<td>
				<?php e(form_input('db_name', set_value('db_name')))?><br/>
				<?php e(form_checkbox('db_create_db', 1, set_checkbox('db_create_db', 1, TRUE)))?> Create DB if not exist
			</td>
		</tr>
		</table>

		<hr size="1"/>

		<h2>Administrator user</h2>

		<table>
		<tr>
			<th>First name</th>
			<td><input type="text" name="first_name" value="<?php e(set_value('first_name'))?>"></td>
		</tr>
		<tr>
			<th>Last name</th>
			<td><input type="text" name="last_name" value="<?php e(set_value('last_name'))?>"></td>
		</tr>
		<tr>
			<th>Username</th>
			<td><input type="text" name="username" value="<?php e(set_value('username'))?>"></td>
		</tr>
		<tr>
			<th>E-mail</th>
			<td><input type="text" name="email" value="<?php e(set_value('email'))?>"></td>
		</tr>
		<tr>
			<th>Password</th>
			<td><input type="password" name="password" value="<?php e(set_value('password'))?>"></td>
		</tr>
		<tr>
			<th>Confirm Password</th>
			<td><input type="password" name="confirm_password" value="<?php e(set_value('confirm_password'))?>"></td>
		</tr>
		</table>

		<div style="margin-top: 20px;">
			<input type="button" value="Back" onclick='location.href="<?php e(site_url('setup/step3'))?>"'>
			<input type="submit" value="Next">
		</div>

	<?php e(form_close()) ?>

</div>

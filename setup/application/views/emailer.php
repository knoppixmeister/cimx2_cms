<div style="width: 984px; margin: 0 auto; height: 400px; border: 1px solid silver;">

	<h2>E-mail subsystem settings</h2>

	<?php if(validation_errors() != "") e(validation_errors())?>

	<?php e(form_open('setup/step5'))?>

		<table>
		<tr>
			<th>Type</th>
			<td>
			<?php
				$type = array(
							'mail'		=>	'mail', 
							'smtp'		=>	'SMTP', 
							'sendmail'	=>	'Sendmail', 
						);

				e(form_dropdown('emailer_type', $type, set_value('emailer_type')));
			?>
			</td>
		</tr>
		<tr>
			<th>Sendmail path</th>
			<td><?php e(form_input('emailer_sendmail_path', set_value('emailer_sendmail_path', '/usr/bin/sendmail')))?></td>
		</tr>
		<tr>
			<th>SMTP Host</th>
			<td><?php e(form_input('emailer_smtp_host', set_value('emailer_smtp_host')))?></td>
		</tr>
		<tr>
			<th>SMTP Username</th>
			<td><?php e(form_input('emailer_smtp_username', set_value('emailer_smtp_username')))?></td>
		</tr>
		<tr>
			<th>SMTP Password</th>
			<td><?php e(form_input('emailer_smtp_password', set_value('emailer_smtp_password')))?></td>
		</tr>
		<tr>
			<th>SMTP Port</th>
			<td><?php e(form_input('emailer_smtp_port', set_value('emailer_smtp_port', '25')))?></td>
		</tr>
		</table>

		<input type="button" value="Back" onclick='location.href="<?php e(site_url('setup/step4'))?>"'>
		<input type="button" value="Skip" onclick='location.href="<?php e(site_url('setup/finish'))?>"'>
		<input type="submit" value="Next">

	<?php e(form_close())?>

</div>

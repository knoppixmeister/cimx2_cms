<div style="width: 984px; margin: 0 auto; border: 1px solid silver;">

	<?php e(form_open(site_url('setup/step3')))?>
		<input type="hidden" name="server" value="sdfsdf"/>

		<table>
		<tr>
			<th>Server</th>
			<td>Apache</td>
		</tr>
		<tr>
			<th>PHP Engine</th>
			<td><?php e(PHP_VERSION)?></td>
		</tr>
		<tr>
			<th>Database engine</th>
			<td><?php e(print_r(get_loaded_extensions()))?></td>
		</tr>
		</table>

		<input type="button" value="Back" onclick='location.href="<?php e(site_url('setup/step2'))?>"'/>
		<input type="submit" value="Next"/>

	<?php e(form_close())?>

</div>

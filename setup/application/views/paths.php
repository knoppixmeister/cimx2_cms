<div style="width: 984px; margin: 0 auto; border: 1px solid silver;">

	<?php e(form_open(site_url('setup/step2')))?>

		<table>
		<tr>
			<th>Base site url</th>
			<td><?php e(base_url(''))?></td>
		</tr>
		<tr>
			<th>Base site directory</th>
			<td><?php e('')?></td>
		</tr>
		<tr>
			<th>Server settings</th>
			<td>
			<?php
				$default = "";

				if(function_exists('apache_get_modules')) {
					if(in_array('mod_rewrite', apache_get_modules())) $default = "apache_mod_rewrite";
					else  $default = "apache";
				}

				$options = 	array(
								'apache'				=>	'Apache without mod_rewrite',
								'apache_mod_rewrite' 	=>	'Apache with mod_rewrite', 
								'nginx'					=>	'Nginx', 
								'other'					=>	'Others', 
							);

				e(form_dropdown('server', $options, set_value('server', $default)))
			?>
			</td>
		</tr>
		</table>

		<hr size="1">
		
		<h2>Paths</h2>
	
		<table>
		<tr>
			<th>cache</th>
			<td><?php echo is_really_writable(FCPATH."../application/cache")." ".realpath(FCPATH."../application/cache")?></td>
		</tr>
		<tr>
			<th>config</th>
			<td><?php echo is_really_writable(FCPATH."../application/config")." ".FCPATH."../application/config"?></td>
		</tr>
		<tr>
			<th>Base site directory</th>
			<td><?php e('')?></td>
		</tr>
		</table>

		<input type="button" value="Back" onclick='location.href="<?php e(site_url('setup/step1'))?>"'>
		<input type="submit" value="Next">

	<?php e(form_close())?>

</div>

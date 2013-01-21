<h2>Settings</h2>

<?php e(form_open(admin_url('settings'), array('class' => "form-horizontal", )))?>

	<div class="tabbable">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#1" data-toggle="tab">General</a></li>
			<li><a href="#2" data-toggle="tab">Users & Auth</a></li>
			<li><a href="#3" data-toggle="tab">E-mail</a></li>
			<li><a href="#4" data-toggle="tab">Admin panel</a></li>
			<li><a href="#5" data-toggle="tab">System info</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="1">

				<fieldset>

          			<div class="control-group">
						<label for="input01" class="control-label">Site name</label>
						<div class="controls">
							<?php e(form_input('site_name', set_value('site_name', (empty($items['site_name']) ? "Unnamed website" : $items['site_name'])), 'class="input-xlarge"'))?>
            			</div>
          			</div>

         			<div class="control-group">
						<label for="input01" class="control-label">Admin e-mail</label>
						<div class="controls">
							<?php e(form_input('admin_email', set_value('admin_email', $items['admin_email']), 'class="input-xlarge"'))?>
            			</div>
          			</div>

          			<div class="control-group">
						<label for="input01" class="control-label">Frontend is open</label>
						<div class="controls">
							<label class="checkbox">
								<?php
									$def = ($items['frontend_opened'] == DB_TRUE ? TRUE : FALSE);
		
									e(form_checkbox('frontend_opened', 1, set_checkbox('frontend_opened', 1, $def), 'class="input-xlarge"'))
								?>
              				</label>
            			</div>
          			</div>

          			<div class="control-group">
						<label for="input01" class="control-label">Date format</label>
						<div class="controls">
							<?php e(form_input('date_format', set_value('date_format', $items['date_format']), 'class="input-xlarge"'))?>
            			</div>
          			</div>

          			<div class="control-group">
						<label for="input01" class="control-label">Time format</label>
						<div class="controls">
							<?php e(form_input('time_format', set_value('time_format', (empty($items['time_format']) ? "H:i" : $items['time_format'])), 'class="input-xlarge"'))?>
            			</div>
          			</div>

          			<div class="control-group">
						<label for="input01" class="control-label">Items per page</label>
						<div class="controls">
							<?php e(form_input('items_per_page', set_value('items_per_page', nvl($items['items_per_page'], '30')), 'class="input-xlarge"'))?>
            			</div>
          			</div>

				</fieldset>

	    	</div>
	    	<div class="tab-pane" id="2">

				<fieldset>

          			<div class="control-group">
						<label for="input01" class="control-label">Login by</label>
						<div class="controls">
						<?php
							$login_by = array(
											'email'		=>	'Email', 
											'username'	=>	'Username', 
											'both'		=>	'Both', 
										);

							e(form_dropdown('login_by', $login_by, set_value('login_by', $items['login_by'])));
						?>
            			</div>
          			</div>

          			<div class="control-group">
						<label for="input01" class="control-label">Allow Auth</label>
						<div class="controls">
						<?php
							$options = 	array(
											1	=>	'Yes', 
											0	=>	'No', 
										);

							e(form_dropdown('allow_auth', $options, set_value('allow_auth', $items['allow_auth'])));
						?>
            			</div>
          			</div>

          			<div class="control-group">
						<label for="input01" class="control-label">Allow Register</label>
						<div class="controls">
							<?php e(form_dropdown('allow_register', $options, set_value('allow_register', $items['allow_register'])))?>
            			</div>
          			</div>

          			<div class="control-group">
						<label for="input01" class="control-label">Default user role</label>
						<div class="controls">
						<?php
							$res = $this->roles_model->get_all();
							$roles = array('' => '', );
							foreach($res as $r) {
								$roles[$r['id']] = $r['description'];
							}

							e(form_dropdown('default_user_role', $roles, set_value('default_user_role', nvl($items['default_user_role'], 'user'))));
						?>
            			</div>
          			</div>

          		</fieldset>

	    	</div>
	    	<div class="tab-pane" id="3">

	    		<fieldset>

          			<div class="control-group">
						<label for="input01" class="control-label">Type</label>
						<div class="controls">
						<?php
							$emailer_types= array(
								'mail' 		=> 'mail', 
								'smtp' 		=> 'SMTP', 
								'sendmail'	=> 'Sendmail', 
							);
			
							e(form_dropdown('emailer_type', $emailer_types, set_value('emailer_type', $items['emailer_type'])));
						?>
						</div>
					</div>

					<div class="control-group">
						<label for="input01" class="control-label">Send from e-mail</label>
						<div class="controls">
							<input type="text" name="emailer_send_from" value="<?php e(set_value('emailer_send_from', (!empty($items['emailer_send_from']) ? $items['emailer_send_from'] : "user@test.com")))?>"/>
						</div>
					</div>

					<div class="control-group">
						<label for="input01" class="control-label">Mailpath</label>
						<div class="controls">
							<input type="text" name="emailer_mailpath" value="<?php e(set_value('emailer_mailpath', $items['emailer_mailpath']))?>"/>
						</div>
					</div>

					<div class="control-group">
						<label for="input01" class="control-label">SMTP server</label>
						<div class="controls">
							<input type="text" name="emailer_smtp_server" value="<?php e(set_value('emailer_smtp_server', $items['emailer_smtp_server']))?>"/>
						</div>
					</div>

					<div class="control-group">
						<label for="input01" class="control-label">SMTP port</label>
						<div class="controls">
							<input type="text" name="emailer_smtp_port" value="<?php e(set_value('emailer_smtp_port', $items['emailer_smtp_port']))?>"/>
						</div>
					</div>

					<div class="control-group">
						<label for="input01" class="control-label">SMTP user</label>
						<div class="controls">
							<input type="text" name="emailer_smtp_user" value="<?php e(set_value('emailer_smtp_user', $items['emailer_smtp_user']))?>"/>
						</div>
					</div>

					<div class="control-group">
						<label for="input01" class="control-label">SMTP password</label>
						<div class="controls">
							<input type="text" name="emailer_smtp_pass" value="<?php e(set_value('emailer_smtp_pass', $items['emailer_smtp_pass']))?>"/>
						</div>
					</div>

					<div class="control-group">
						<label for="input01" class="control-label">SMTP Timeout</label>
						<div class="controls">
							<input type="text" name="emailer_smtp_timeout" value="<?php e(set_value('emailer_smtp_timeout', (!empty($items['emailer_smtp_timeout']) ? $items['emailer_smtp_timeout'] : "25")))?>"/>
						</div>
					</div>	

				</fieldset>

				<hr size="1"/>

				<fieldset>

          			<div class="control-group">
						<label for="input01" class="control-label">Send to</label>
						<div class="controls">
							<input type="text" name="send_to_mail" id="send_to_email"/>
						</div>
					</div>

					<div class="control-group">
						<label for="input01" class="control-label"></label>
						<div class="controls">
							<input class="btn" type="button" value="Test" id="test_email_send">
						</div>
					</div>

				</fieldset>

	    	</div>
	    	<div class="tab-pane" id="4">

	    		<fieldset>

          			<div class="control-group">
						<label for="admin_theme" class="control-label">Admin Theme</label>
						<div class="controls">
							<?php e(form_dropdown('admin_theme', $admin_themes, set_value('admin_theme', (!empty($items['admin_theme']) ? $items['admin_theme'] : "admin")), 'id="admin_theme"'))?>
            			</div>
          			</div>

          		</fieldset>

				<!--
				<table>
				<tr>
					<th>Allowed IP(s):</th>
					<td><textarea rows="5" cols="50" name="allowed_ip"><?php e(set_value('allowed_ip', ''))?></textarea></td>
				</tr>
				<tr>
					<th>Allowed Domain(s):</td>
					<td><textarea rows="5" cols="50" name="allowed_domain"><?php e(set_value('allowed_domain', ''))?></textarea></td>
				</tr>
				</table>
				-->

	    	</div>
	    	<div class="tab-pane" id="5">
	    	
	    		<table>
	    		<tr>
					<th>DB Driver:</th>
					<td><?php e(form_input('db_host', $this->db->platform(), 'disabled="disabled"'))?></td>
				</tr>
				<tr>
					<th>DB Host:</th>
					<td><?php e(form_input('db_host', $this->db->hostname, 'disabled="disabled"'))?></td>
				</tr>
				<tr>
					<th>DB Name:</th>
					<td><?php e(form_input('db_host', $this->db->database, 'disabled="disabled"'))?></td>
				</tr>
				<tr>
					<th>DB User:</th>
					<td><?php e(form_input('db_host', $this->db->username, 'disabled="disabled"'))?></td>
				</tr>
				<tr>
					<th>DB Password:</th>
					<td><?php e(form_input('db_host', $this->db->password, 'disabled="disabled"'))?></td>
				</tr>
				</table>

	    	</div>
	    </div>
    </div>

    <fieldset>

		<div class="form-actions">
			<input type="submit" class="btn btn-primary" value="Save"/>
		</div>

	</fieldset>

<?php e(form_close())?>

<script type="text/javascript">
	(function($) {
		$(document).ready(function() {
			$("#test_email_send").click(function() {
				$(this).attr('disabled', 'disabled');

				var e = $("#send_to_email").val();

				if(e == "") {
					alert('Not specified test e-mail');

					$(this).removeAttr('disabled');
				}
				else {
					$.getJSON("<?php e(admin_url('settings/test_email?email='))?>"+e, function(data) {
						alert(data.status+" : "+data.message);

						$("#test_email_send").removeAttr('disabled');
					});
				}
			});
		});
	})(jQuery);
</script>

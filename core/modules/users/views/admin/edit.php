{tag:jqueryui:jqueryui_all}

<h2>User details</h2>

<?php e(form_open($action_url, array('class' => "form-horizontal", )))?>

	<div class="tabbable">
    	<ul class="nav nav-tabs">
			<li class="active"><a href="#1" data-toggle="tab">Details</a></li>
			<li><a href="#2" data-toggle="tab">Password</a></li>
			<li><a href="#3" data-toggle="tab">Additional info</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="1">

    			<table>
				<tr>
					<th>First Name</th>
					<td><input type="text" name="first_name" value="<?php e(set_value('first_name', $item['first_name']))?>"></td>
				</tr>
				<tr>
					<th>Last Name</th>
					<td><input type="text" name="last_name" value="<?php e(set_value('last_name', $item['last_name']))?>"></td>
				</tr>
				<tr>
					<th>Username</th>
					<td><input type="text" name="username" value="<?php e(set_value('username', $item['username']))?>"></td>
				</tr>
				<tr>
					<th>E-mail</th>
					<td><input type="text" name="email" value="<?php e(set_value('email', $item['email']))?>"></td>
				</tr>
				<tr>
					<th>Role</th>
					<td><?php e(form_dropdown('role', $roles, set_value('role', $item['role_id'])))?></td>
				</tr>
				<tr>
					<th>Status</th>
					<td>
					<?php
						$statuses = array(
										'active' 	=> 'Active', 
										'disabled' 	=> 'Disabled', 
									);
		
						e(form_dropdown('status', $statuses, set_value('status', $item['status'])));
					?>
					</td>
				</tr>
				</table>

    		</div>
    		<div class="tab-pane" id="2">

    			<table>
				<tr>
					<th>Password</th>
					<td><?php e(form_password('password', set_value('password'), 'autocomplete="off"'))?></td>
				</tr>
				<tr>
					<th>Confirm password</th>
					<td><?php e(form_password('confirm_password', set_value('confirm_password'), 'autocomplete="off"'))?></td>
				</tr>
				</table>

    		</div>
    		<div class="tab-pane" id="3">

				<fieldset>
					<div class="control-group">
						<label class="control-label" for="birth_date">Birth date</label>
						<div class="controls">
							<input type="text" class="input-xlarge datepicker" id="birth_date">

							<script type="text/javascript">
								$(".datepicker").datepicker({
									showOn: 			"button", 
									buttonImage: 		"{tag:module:image_url file='calendar.gif'}", 
									buttonImageOnly:	true
								});
							</script>

						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="birth_date">Phone</label>
						<div class="controls">
							<input type="text" class="input-xlarge datepicker" id="birth_date">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="web">Web</label>
						<div class="controls">
							<input type="text" name="web" class="input-xlarge datepicker" id="web">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="birth_date">Skype</label>
						<div class="controls">
							<input type="text" class="input-xlarge datepicker" id="birth_date">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="birth_date">MSN</label>
						<div class="controls">
							<input type="text" class="input-xlarge datepicker" id="birth_date">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="birth_date">ICQ</label>
						<div class="controls">
							<input type="text" class="input-xlarge datepicker" id="birth_date">
						</div>
					</div>
				</fieldset>

    		</div>
		</div>
	</div>

	<div style="margin-top: 20px; margin-bottom: 30px;">
		<input class="btn btn-primary" type="submit" value="Save" name="save"/>
		<input class="btn" type="submit" value="Save & Exit" name="save_exit"/>
		<span style="padding-left: 20px;"><a class="btn" href="<?php e(admin_url('users'))?>">Cancel</a></span>
	</div>

<?php e(form_close())?>

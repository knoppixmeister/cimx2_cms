<h2>Contacts settings</h2>

<div class="top_btns">
	<a class="btn btn-mini" href="<?php e(admin_url('contacts'))?>">Contacts messages</a>
</div>

<?php e(form_open(admin_url('contacts/settings')))?>

	<table>
	<tr>
		<th>Send messages from:</th>
		<td><?php e(form_input('send_from', set_value('send_from', $send_from), 'class="span8"'))?></td>
	</tr>
	<tr>
		<th>Send messages to:</th>
		<td><textarea rows="10" cols="50" name="send_to" class="span8"><?php e(set_value('send_to', $send_to))?></textarea></td>
	</tr>
	<tr>
		<th>Contact address:</th>
		<td><?php e(form_input('contacts_address', set_value('contact_address', $contact_address), 'class="span8"'))?></td>
	</tr>
	</table>

	<div class="bottom_btns">
		<input class="btn btn-primary" type="submit" value="Save"/>
		<span style="padding-left: 20px;"><a class="btn" href="<?php e(admin_url('contacts'))?>">Back</a></span>
	</div>

<?php e(form_close())?>

<h2>{tag:lang:line name="contacts_contacts"}</h2>

<div style="overflow: hidden; width: 100%;">
	<div style="width: 49%; float: left;">

		<div>{tag:page:content slug="_contacts"}</div>

		{tag:contacts:gmap_address}

	</div>
	<div style="width: 50%; float: right;">

		<h2>{tag:lang:line name="send_us_message"}</h2>
		<?php
			e(form_open('contacts', 'id="contacts_form"'));

			$var = $this->session->flashdata('success_msg');
			if(!empty($var)) echo $var;
		?>
			<table class="contacts_tbl">
			<?php
				if(validation_errors() != "") {
			?>
			<tr>
				<td colspan="2" class="error" style="text-align: center;"><?php e(validation_errors())?></td>
			</tr>
			<?php
				}
			?>
			<tr>
				<td colspan="2" style="text-align: right;">
					<font color="red">*</font>&nbsp;-&nbsp;{tag:lang:line name="contacts_required_fields"}  
				</td>
			</tr>
			<tr>
				<td>
					{tag:lang:line name="contacts_your_name"}:&nbsp;<font color="red">*</font><br/>
					<input type="text" name="full_name" value="<?php e(set_value('full_name'))?>">
				</td>
			</tr>
			<tr>
				<td>
					{tag:lang:line name="contacts_email"}&nbsp;<font color="red">*</font><br/>
					<input type="text" name="email" value="<?php e(set_value('email'))?>">
				</td>
			</tr>
			<tr>
				<td>
					{tag:lang:line name="contacts_phone"}&nbsp;<font color="red">*</font><br/>
					<input type="text" name="phone" value="<?php e(set_value('phone'))?>">
				</td>
			</tr>
			<tr>
				<td>
					{tag:lang:line name="contacts_subject"}&nbsp;<font color="red">*</font><br/>
					<input type="text" name="subject" value="<?php e(set_value('subject'))?>">
				</td>
			</tr>
			<tr>
				<td>
					{tag:lang:line name="contacts_message_text"}&nbsp;<font color="red">*</font><br/>
					<textarea name="text"><?php e(set_value('text'))?></textarea>
				</td>
			</tr>
			<tr>
				<td style="text-align: center; padding-top: 20px;">
					<input type="submit" class="button" value='{tag:lang:line name="contacts_send"}'>
				</td>
			</tr>
			</table>

		<?php e(form_close())?>

	</div>
</div>

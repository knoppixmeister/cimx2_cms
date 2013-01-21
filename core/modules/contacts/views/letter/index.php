<table>
<tr>
	<th>Name: </th>
	<td><?php e($full_name)?></td>
</tr>
<tr>
	<th>Subject: </th>
	<td><?php e($subject)?></td>
</tr>
<tr>
	<th>E-mail: </th>
	<td><?php e($email)?></td>
</tr>
<tr>
	<th>Phone: </th>
	<td><?php e($phone)?></td>
</tr>
<tr>
	<th>Text: </th>
	<td><?php e(nl2br($text))?></td>
</tr>
<tr>
	<th>IP: </th>
	<td><?php e($_SERVER['REMOTE_ADDR'])?></td>
</tr>
</table>

<h2>Contact details</h2>

<table class="table table-striped table-bordered table-condensed" >
<tbody>
<tr>
	<th style="width: 100px;">Name:</th>
	<td><?php e($item['name'])?></td>
</tr>
<tr>
	<th>E-mail:</th>
	<td><?php e($item['email'])?></td>
</tr>
<tr>
	<th>Phone:</th>
	<td><?php e($item['phone'])?></td>
</tr>
<tr>
	<th>Subject:</th>
	<td><?php e($item['subject'])?></td>
</tr>
<tr>
	<th>Text:</th>
	<td><?php e(nl2br($item['text']))?></td>
</tr>
<tr>
	<th>IP:</th>
	<td><?php e(nl2br($item['ip']))?></td>
</tr>
<tr>
	<th>Created:</th>
	<td><?php e(date('d-m-Y H:i', $item['created_time']))?></td>
</tr>
</tbody>
</table>

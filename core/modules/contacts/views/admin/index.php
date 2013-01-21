<h2>Contacts</h2>

<div class="top_btns">
	<a class="btn btn-mini" href="<?php e(admin_url('contacts/settings'))?>">Settings</a>
</div>

<?php e(form_open(admin_url('contacts')))?>

	<table class="table table-striped table-bordered table-condensed">
	<thead>
	<tr>
		<th style="width: 1%;"><input type="checkbox" id="check_all"></th>
		<th>Name</th>
		<th>E-mail</th>
		<th style="width: 1%;">Phone</th>
		<th>Subject</th>
		<th style="width: 1%;">IP</th>
		<th>Date</th>
		<th colspan="2" style="width: 1%;">Actions</th>
	</tr>
	</thead>
	<tbody>
<?php
		if(count($items) > 0) {
			foreach($items as $i) {
?>
	<tr class="hoverable">
		<td><?php e(form_checkbox('items[]', $i['id'], FALSE, 'class="check_item"'))?></td>
		<td><?php e($i['name'])?></td>
		<td><?php e($i['email'])?></td>
		<td><?php e($i['phone'])?></td>
		<td><?php e($i['subject'])?></td>
		<td><?php e($i['ip'])?></td>
		<td><?php e(date('d-m-Y H:i', $i['created_time']))?></td>
		<td><a class="btn" href="<?php e(admin_url('contacts/view/'.$i['id']))?>">View</a></td>
		<td><a class="btn btn-danger" href="<?php e(admin_url('contacts/delete/'.$i['id']))?>">Delete</a></td>
	</tr>
<?php
			}
		}
		else {
?>
	<tr>
		<td colspan="9" style="text-align: center; height: 100px;">No contacts</td>
	</tr>
<?php
		}
?>
	</tbody>
	</table>

	
<?php
	if(count($items) > 0) {
?>
	<div style="margin-top: 10px;">
		<input type="submit" class="btn btn-danger" name="delete" value="Delete"/>&nbsp;Mark as: <?php e(form_dropdown('mark_as', array('' => '', 'read' => 'Read', ), NULL, 'id="mark_as"'))?>
	</div>
<?php
	}

	e(form_close());

	if(count($items) > 0) {
?>
{tag:pager:show base_url="<?php _admin_url('contacts')?>" page="<?php e($page)?>" items_count="<?php e($items_count)?>" per_page="<?php e($per_page)?>" type="ul"}
<?php
	}
?>
<script type="text/javascript">
	window.onload = function() {
		(function($) {
			$('#check_all').click(function () {
				if(this.checked == false) $('.check_item:checked').attr('checked', false);
				else $('.check_item:not(:checked)').attr('checked', true);
			});
		})(jQuery);
	};
</script>

<h2>Modules</h2>

<div class="top_btns">
	<a class="btn btn-mini" href="<?php e(admin_url($module.'/upload'))?>">Upload module</a>
</div>

<table class="table table-striped table-bordered table-condensed">
<thead>
<tr>
	<th colspan="7"><h2>User modules</h2></th>
</tr>
<tr>
	<th>Name</th>
	<th style="width: 1%;">Slug</th>
	<th>Version</th>
	<th>Author</th>
	<th>Description</th>
	<th colspan="3" style="width: 1%;">Actions</th>
</tr>
</thead>
<tbody>
<?php
	if(count($user_modules) > 0) {
		foreach($user_modules as $i) {
?>
<tr>
	<td><?php e($i['info']['name']['en'])?></td>
	<td>
	<?php
		if(!empty($i['data']) && $i['data']['enabled'] == DB_TRUE && $i['data']['is_admin'] == DB_TRUE) {
	?>
		<a href="<?php e(admin_url($i['slug']))?>"><?php e($i['slug'])?></a>
	<?php
		}
		else e($i['slug']);
	?>
	</td>
	<td><?php e($i['info']['version'])?></td>
	<td><?php e($i['info']['author'])?></td>
	<td><?php e($i['info']['description']['en'])?></td>
	<?php
		if(empty($i['data']['is_system']) || $i['data']['is_system'] == DB_FALSE) {
	?>
	<td>
	<?php
		if(!empty($i['data'])) {
			if(empty($i['data']['enabled']) || $i['data']['enabled'] == DB_FALSE) {
	?>
		<a class="btn" href="<?php e(admin_url('modules/enable/'.$i['slug']))?>">Enable</a>
	<?php
			}
			elseif($i['data']['enabled'] == DB_TRUE) {
	?>
		<a class="btn" href="<?php e(admin_url('modules/disable/'.$i['slug']))?>">Disable</a>
	<?php
			}
		}
		else e('<a class="btn disabled">Enable</a>');
	?>
	</td>
	<td>
	<?php	
		if(empty($i['data'])) {
	?>
		<a class="btn btn-success" href="<?php e(admin_url('modules/install/'.$i['slug']))?>">Install</a>
	<?php
		}
		else {
	?>
		<a class="btn btn-warning" id="btn-uninstall" href="<?php e(admin_url('modules/uninstall/'.$i['slug']))?>">Uninstall</a>
	<?php
		}
	?>
	</td>
	<td><a class="btn btn-danger" href="<?php e(admin_url('modules/undeploy/'.$i['slug']))?>">Undeploy</a></td>
	<?php
		}
		else e('<td colspan="3"></td>');
	?>
</tr>
<?php
		}
	}
	else {
?>
<tr>
	<td colspan="8" style="text-align: center; height: 100px;">No modules</td>
</tr>
<?php
	}
?>
</tbody>
<thead>
<tr>
	<td colspan="8"><h2>System modules</h2></td>
</tr>
<tr>
	<th>Name</th>
	<th style="width: 1%;">Slug</th>
	<th>Version</th>
	<th>Author</th>
	<th>Description</th>
	<td colspan="3"></td>
</tr>
</thead>
<?php
	if(count($system_modules) > 0) {
		e('<tbody>');

		foreach($system_modules as $i) {
?>
<tr>
	<td><?php e($i['info']['name']['en'])?></td>
	<td>
	<?php
		if($i['data']['is_admin'] == DB_TRUE) {
	?>
		<a href="<?php e(admin_url($i['slug']))?>"><?php e($i['slug'])?></a>
	<?php
		}
		else e($i['slug']);
	?>
	</td>
	<td><?php e($i['info']['version'])?></td>
	<td><?php e($i['info']['author'])?></td>
	<td><?php e($i['info']['description']['en'])?></td>
	<td colspan="3"></td>
</tr>
<?php
		}

		e('</tbody>');
	}
?>
</table>

<script type="text/javascript">
	window.onload = function() {
		if(typeof jQuery == "undefined") alert('This page requires JQuery library to be installed');

		(function($) {
			$("#btn-uninstall").click(function() {
				return confirm('Are you sure you want uninstall this module and delete all of it data?');
			});
		})(jQuery);
	};
</script>

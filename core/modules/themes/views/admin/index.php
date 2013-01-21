<h2>Themes</h2>

<div class="top_btns">
	<a class="btn btn-mini" href="<?php e(admin_url('themes/upload'))?>">Upload theme</a>
</div>

<h2>Front end themes</h2>

<?php e(form_open(admin_url('themes/set_frontend_default', TRUE)))?>

	<table class="table table-striped table-bordered table-condensed">
	<thead>
	<tr>
		<th style="width: 1%;">Default</th>
		<th>Name</th>
		<th>Version</th>
		<th>Author</th>
		<th>Description</th>
		<th style="width: 1%;">Actions</th>
	</tr>
	</thead>
	<tbody>
	<?php
		foreach($frontend_themes as $i) {
	?>
	<tr>
		<td style="text-align: center;"><?php e(form_radio('theme', $i['slug'], $i['is_default']))?></td>
		<td><?php e($i['info']['name']['en'])?></td>
		<td><?php e($i['info']['version'])?></td>
		<td><?php e($i['info']['author'])?></td>
		<td><?php e($i['info']['description']['en'])?></td>
		<td>
		<?php
			if($i['slug'] != 'default' && $i['slug'] != 'admin' && !$i['is_default']) {
		?>
			<a class="btn btn-danger" href="<?php e(admin_url('themes/delete/'.$i['slug']))?>">Delete</a>
		<?php
			}
		?>
		</td>
	</tr>
	<?php
		}
	?>
	</tbody>
	</table>

	<input class="btn" type="submit" value="Set as default"/>

<?php e(form_close())?>

<hr size="1"/>

<h2>Admin themes</h2>

<?php e(form_open(admin_url('themes/set_admin_default', TRUE)))?>

	<table class="table table-striped table-bordered table-condensed">
	<thead>
	<tr>
		<th style="width: 1%;">Default</th>
		<th>Name</th>
		<th>Version</th>
		<th>Author</th>
		<th>Description</th>
		<th style="width: 1%;">Actions</th>
	</tr>
	</thead>
	<tbody>
	<?php
		foreach($admin_themes as $i) {
	?>
	<tr>
		<td style="text-align: center;"><?php e(form_radio('theme', $i['slug'], $i['is_default']))?></td>
		<td><?php e($i['info']['name']['en'])?></td>
		<td><?php e($i['info']['version'])?></td>
		<td><?php e($i['info']['author'])?></td>
		<td><?php e($i['info']['description']['en'])?></td>
		<td>
		<?php
			if($i['slug'] != 'default' && $i['slug'] != 'admin') {
		?>
			<a class="btn btn-danger" href="<?php e(admin_url('themes/delete/'.$i['slug']))?>">Delete</a>
		<?php
			}
		?>
		</td>
	</tr>
	<?php
		}
	?>
	</tbody>
	</table>

	<input class="btn" type="submit" value="Set as default"/>

<?php e(form_close())?>

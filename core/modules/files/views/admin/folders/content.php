<?php
	if(!ini_get('file_uploads')) {
?>
<div class="alert alert-error">
	<button data-dismiss="alert" class="close" type="button">×</button>
	<strong>Current php instance does not support file uploads. Please check php.ini settings!</strong>
</div>
<?php
	}
?>
<h2>Files</h2>

<div class="top_btns">
	<?php
		if(ini_get('file_uploads')) {
	?>
	<a class="btn btn-mini" href="<?php e(admin_url('files/upload'))?>">Upload file(s)</a> 
	<a class="btn btn-mini" href="<?php e(admin_url('files/folders/create'))?>">Create folder</a> 
	<?php
		}
	?>
</div>

<?php e(form_open(admin_url('files/folders/content/'.$folder['id'])))?>

	<table class="table table-striped table-bordered table-condensed">
	<thead>
	<tr>
		<th style="width: 1%;"><input type="checkbox" id="_select_all"></th>
		<th></th>
		<th>Name</th>
		<th style="width: 100px;">Type</th>
		<th>Size</th>
		<th colspan="2" style="width: 1%;">Actions</th>
	</tr>
	</thead>
	<tbody>
	<?php
		if($folder['id'] != 0) {
	?>
	<tr>
		<td>&nbsp;</td>
		<td style="width: 40px; text-align: center;">
			<a href="<?php e(admin_url('files/folders/content/'.$parents['parent']['id']))?>">
				<img src="<?php e(base_url(TRUE))?>public/modules/files/images/folder.png" alt=""/>
			</a>
		</td>
		<td colspan="5"><a href="<?php e(admin_url('files/folders/content/'.$parents['parent']['id']))?>">..</a></td>
	</tr>
	<?php
		}
	
		if(count($items) > 0) {
			foreach($items as $i) {
	?>
	<tr>
		<td><input type="checkbox" name="<?php e($i['type'])?>s[]" value="<?php e($i['data']['id'])?>" class="item_checkbox" id="item_<?php e($i['data']['id'])?>"></td>
		<td style="width: 40px; text-align: center;">
		<?php
			if($i['type'] == "folder") {
		?>
			<a href="<?php e(admin_url('files/folders/content/'.$i['data']['id']))?>">
				<img src="<?php e(base_url(TRUE))?>public/modules/files/images/folder.png" alt=""/>
			</a>
		<?php
			}
			else {
				if(!empty($i['data']['image_width']) && !empty($i['data']['image_height'])) {
					if($i['data']['image_width'] > 40) {
		?>
			<img width="40" style="border: 1px solid gray;" src="<?php e(site_url('files/thumb/'.$i['data']['id']."/40"))?>"/>
		<?php
					}
					else {
		?>
			<img width="40" src="<?php e(base_url()."public/uploads/".date('Y/m', $i['data']['created_time'])."/".$i['data']['file_name'])?>"/>
		<?php
					}
				}
			}
		?>
		</td>
		<td>
		<?php
			if($i['type'] == "folder") e('<a href="'.admin_url('files/folders/content/'.$i['data']['id']).'">'.$i['data']['name']."</a>");
			else {
		?>
			<a href="<?php e(base_url())?>public/uploads/<?php e(date('Y/m', $i['data']['created_time']))?>/<?php e($i['data']['file_name'])?>" target="_blank">
				<?php e($i['data']['file_name'])?>
			</a>&nbsp;<a href="<?php e(site_url('files/download/'.$i['data']['id']))?>" target="_blank"><i class="icon-download"></i></a>
		<?php
			}
		?>
		</td>
		<td>
		<?php
			if($i['data']['type'] == "folder") e('Folder');	
			else e($i['data']['file_mime_type']);
		?>
		</td>
		<td style="text-align: center;">
		<?php
			if($i['type'] == "file") {
				if(!empty($i['data']['image_width']) && !empty($i['data']['image_height'])) e($i['data']['image_width']."x".$i['data']['image_height']."<br/>");
	
				e($i['data']['file_size']." Kb");
			}
		?>
		</td>
		<td>
		<?php
			if($i['type'] == "folder") {
		?>
			<a href="<?php e(admin_url('files/folders/edit/'.$i['data']['id']))?>" class="btn btn-primary">Edit</a>
		<?php
			}
			else {
		?>
			<a href="<?php e(admin_url('files/edit/'.$i['data']['id']))?>" class="btn btn-primary">Edit</a>
		<?php
			}
		?>
		</td>
		<td>
		<?php
			if($i['type'] == "folder") {
		?>
			<a href="<?php e(admin_url('files/folders/delete/'.$i['data']['id']))?>" class="btn btn-danger">Delete</a>
		<?php
			}
			else {
		?>
			<a href="<?php e(admin_url('files/delete/'.$i['data']['id']))?>" class="btn btn-danger">Delete</a>
		<?php
			}
		?>
		</td>
	</tr>
	<?php
			}
		}
		else {
	?>
	<tr>
		<td colspan="7" style="text-align: center; height: 200px;">No files</td>
	</tr>
	<?php
		}
	?>
	</tbody>
	</table>
<?php
	if(count($items) > 0) {
?>
	<input type="submit" class="btn btn-danger" id="_delete_btn" name="delete" value="Delete selected" disabled="disabled"/>

<?php e(form_close())?>
<!--
<div class="pagination">
	<ul>
		<li><a href="#">←</a></li>
		<li class="active"><a href="#">10</a></li>
		<li class="disabled"><a href="#">...</a></li>
		<li><a href="#">20</a></li>
		<li><a href="#">→</a></li>
	</ul>
</div>
-->
<?php
	}
?>

<script type="text/javascript">
	(function($) {
		$('.item_checkbox').click(function() {
			if(this.checked) {
				$('#_delete_btn').removeAttr("disabled").removeClass('disabled');
			}
			else {
				var no_checks = true;
				$('.item_checkbox').each(function(index) {
					if(this.checked) {
						no_checks = false;
					}
				});

				if(no_checks) {
					$('#_delete_btn').attr("disabled", "disabled").addClass("disabled");
				}
			}
		});
		
		$("#_select_all").click(function() {
			if(!this.checked) {
				$('.item_checkbox:checked').attr('checked', false);

				$('#_delete_btn').attr("disabled", "disabled").addClass("disabled");
			}
			else {
				$('.item_checkbox:not(:checked)').attr('checked', true);

				$('#_delete_btn').removeAttr("disabled").removeClass('disabled');
			}
		});
	})(jQuery);
</script>

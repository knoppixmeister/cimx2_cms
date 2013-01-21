<link rel="stylesheet" href="<?php e(base_url(TRUE))?>public/themes/admin/jquery_file_upload/css/jquery.fileupload-ui.css">

<h2>Upload files</h2>

<style type="text/css">
	#dropzone {
		height:		120px;
		border:		1px solid silver;
		text-align:	center;
		padding-top:30px;
		cursor: 	pointer;
	}
</style>

<div id="simple_uploader" style="width: 70%; margin: 0 auto;">

	<?php
		if($in_dialog) $action_url = admin_url('files/dialog/upload_files?simple_uploader');
		else $action_url = admin_url('files/upload?simple_uploader');

		e(form_open_multipart($action_url, array('class' => "form-horizontal", )))
	?>

		<fieldset>

			<div class="control-group">
				<label for="file" class="control-label">File</label>
            	<div class="controls">
					<input type="file" name="file" id="file" class="input-file">
            	</div>
			</div>

			<div class="form-actions">
				<button class="btn btn-primary" type="submit">Upload</button>
			</div>

		</fieldset>

	<?php e(form_close()) ?>

	<p>
		You are using the browser’s built-in file uploader.<br/>
		The CIMX2 uploader includes multiple file selection and drag and drop capability.<br/>
		<span id="mult_upl_sw" style="display: none;">
			Switch to the <a href="#" id="mult_upl_open">multi-file uploader</a>.<br/>
		</span>
		Maximum upload file size: <?php e(ini_get('post_max_size'))?>. After a file has been uploaded, you can edit it's information.
	</p>

</div>

<div id="ajax_uploader" style="width: 70%; margin: 0 auto; display: none;">

	<div>
		<table style="margin-bottom: 10px;">
		<tr>
			<td>Folder:</td>
			<td><?php e(form_dropdown('parent_folder', $parent_folders, array(), 'id="parent_folder" style="margin-bottom: 0px;"'))?></td>
			<td><a class="btn" id="create_folder_btn">Create folder</a></td>
		</tr>
		</table>
		<?php require dirname(__FILE__).'/popups/edit_folder.php' ?>
	</div>

	<div id="dropzone">

		<h4>Drop files here</h4>
		or<br/>
		<span class="btn fileinput-button" style="margin: 0 auto; float: none;">
			<span><i class="icon-plus"></i> Add files...</span>
			<input id="fileupload" type="file" name="userfile" multiple="multiple">
		</span>

	</div>

	<div style="margin-top: 10px;">
		You are using the multi-file uploader. Problems? Try the <a href="#" id="simp_upl_open">simple uploader</a> instead.<br/>
		Maximum upload file size: <?php e(ini_get('post_max_size'))?>.
	</div>

	<div style="margin-top: 5px;" id="uploaded-files-preview"></div>

</div>

<script type="text/javascript">
<?php
	if(!isset($_REQUEST['simple_uploader'])) {
?>
	$('#simple_uploader').css('display', 'none');

	$('#ajax_uploader').css('display', 'block');
<?php
	}
	else {
?>	
	$('#mult_upl_sw').css('display', 'block');
<?php
	}
?>

	$('#simp_upl_open').click(function() {
		$('#ajax_uploader').css('display', 'none');

		$('#simple_uploader').css('display', 'block');
		$('#mult_upl_sw').css('display', 'block');
	});

	$('#mult_upl_open').click(function() {
		$('#simple_uploader').css('display', 'none');

		$('#ajax_uploader').css('display', 'block');
	});

</script>

<?php
	if(ini_get('file_uploads')) require dirname(__FILE__).'/partials/upload.php';
	else {
?>

	<div class="alert alert-error">
		<button data-dismiss="alert" class="close" type="button">×</button>
		<strong>Current php instance does not support file uploads. Please check php.ini settings!</strong>
	</div>

<?php
	}
?>

<script type="text/javascript" src="<?php e(base_url())?>public/modules/files/js/files.js"></script>

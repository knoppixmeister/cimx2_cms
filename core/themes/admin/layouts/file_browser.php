<?php
	$CI = &get_instance();

	e(doctype('html5'));
?>
<html>
<head>
	<title>File browser</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	{tag:bootstrap:all_css}

	<script type="text/javascript">
		var BASE_URL 		=	"<?php e(base_url())?>";
		var BASE_ADMIN_URL 	=	"<?php e(admin_url(''))?>";

		var CSRF_TOKEN_NAME = "<?php e($this->security->get_csrf_token_name())?>";
		var CSRF_VALUE 		= "<?php e(get_cookie(config_item("csrf_cookie_name")))?>";
	</script>

	<style type="text/css">
		body {
			margin: 5px;
		}

		img {
			border: 	1px solid silver;
			background: white;
			padding: 	2px;
		}

		.tab-content {
			overflow: visible;
		}
	</style>

	{tag:jquery:jquery}
	{tag:bootstrap:all_js src="ext"}

</head>
<body>
	<?php
		if(validation_errors() != "") {
			e('<div class="alert alert-error" id="validation_errors">
				<a class="close" data-dismiss="alert">×</a>'.validation_errors()."</div>");
		}

		$msg = $CI->session->flashdata('success_msg');
		if(!empty($msg)) {
	?>
	<div class="alert alert-success">
		<a class="close" data-dismiss="alert">×</a>
		<?php e($msg)?>
	</div>
	<?php
		}

		if(!empty($error)) {
	?>
	<div class="alert alert-error">
		<a class="close" data-dismiss="alert">×</a>
		<?php e($error)?>
	</div>
	<?php
		}
	?>

	{tag:template:body}

	<script src="<?php e(base_url())?>public/themes/admin/jquery_file_upload/js/vendor/jquery.ui.widget.js" type="text/javascript"></script>
	<script src="<?php e(base_url())?>public/themes/admin/jquery_file_upload/js/jquery.iframe-transport.js" type="text/javascript"></script>
	<script src="<?php e(base_url())?>public/themes/admin/jquery_file_upload/js/jquery.fileupload.js" type="text/javascript"></script>

	<script src="<?php e(base_url())?>public/modules/files/js/files.js?version=<?php e(time())?>" type="text/javascript"></script>

</body>
</html>

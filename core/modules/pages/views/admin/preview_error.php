<?php e(doctype('html5'))?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

	<title>Preview error</title>

	<style type="text/css">
		body {
			background: gray;
		}

		.preview_error {
			text-align: center;
			width: 400px;
			margin: 0 auto;
			margin-top: 20px;
			padding-top: 50px;
			padding-bottom: 50px;
			border: 1px solid silver;
			background: silver;
		}
	</style>
</head>
<body>

	<div class="preview_error">
		Preview not available.<br/>
		<?php e(validation_errors()) ?>
	</div>

</body>
</html>

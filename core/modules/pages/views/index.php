<?php
	if(!empty($page_css)) {
?>
<style type="text/css">
	<?php e($page_css)?>
</style>
<?php
	}

	e($text);

	if(!empty($page_js)) {
?>
<script type="text/javascript">
	<?php e($page_js)?>
</script>
<?php
	}

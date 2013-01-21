<?php e(doctype('html5'))?>
<html lang="<?php e(CURRENT_LANGUAGE)?>">
<head>
	{tag:template:partial name="header.html"}
</head>
<body>

	<div style="width: 1000px; margin: 0 auto; margin-bottom: 10px; padding-left: 0; text-align: right;">
	<?php
		foreach(config_item('supported_languages') as $l => $v) {
	?>
		<a href="<?php e(switch_url_lang($l))?>"><?php e(strtoupper($l))?></a> 
	<?php
		}
	?>
	</div>

	<div style="width: 1000px; margin: 0 auto; margin-bottom: 10px; padding-left: 0; text-align: right;">
	{if '{tag:user:is_logged_in}' }
		<a href="<?php e(site_url('logout'))?>">Log out</a>
	{else}
		<a href="<?php e(site_url('login'))?>">Login</a> 
		<a href="<?php e(site_url('register'))?>">Register</a> 
	{/if}
	</div>

	<ul id="line_menu" style="width: 1000px; margin: 0 auto; margin-bottom: 10px; padding-left: 0;">
		<li><a href="<?php e(site_url(''))?>">Home</a></li>
		<li><a href="<?php e(site_url('test'))?>">Test</a></li>
		<li><a href="<?php e(site_url('blog'))?>">Blog</a></li>
		<li><a href="<?php e(admin_url())?>" target="_blank">Admin control panel</a></li>
	</ul>

	<div style="width: 1000px; margin: 0 auto; overflow: hidden;">

		{tag:template:body}

	</div>

	{tag:template:partial name="footer.php"}

</body>
</html>

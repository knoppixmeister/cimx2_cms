<?php
	$CI = &get_instance();

	e(doctype('html5'));
?>
<html lang="<?php e(CURRENT_LANGUAGE)?>">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<title>{tag:template:title}</title>

	{tag:bootstrap:all_css no_resp="1"}
	<style type="text/css">
		body {
			padding-top: 60px;
		}
	</style>
	{tag:bootstrap:responsive_css}

	{tag:theme:css file="admin.css"}

	{tag:jquery:jquery src="local"}

	<script type="text/javascript">
		var SITE_URL		= "<?php e(site_url(''))?>";
		var BASE_URL 		= "<?php e(base_url())?>";
		var BASE_ADMIN_URL	= "<?php e(admin_url(''))?>";

		var CSRF_TOKEN_NAME = "<?php e($this->security->get_csrf_token_name())?>";
		var CSRF_VALUE 		= "<?php e(get_cookie(config_item("csrf_cookie_name")))?>";
	</script>

</head>
<body>

	<div class="navbar navbar-fixed-top navbar-inverse">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>     
          		<a class="brand" href="#"><?php e(system_get_setting('site_name'))?></a>
				<ul class="nav pull-right">
					<li class="divider-vertical"></li>
					<li class="dropdown">
						<a data-toggle="dropdown" class="dropdown-toggle" href="#">Logged in as <span style="color: #0088CC;"><?php e($user['username'])?></span> <b class="caret"></b></a>
		              	<ul class="dropdown-menu">
		                	<li style="padding-left: 15px; padding-bottom: 5px;">{tag:helper:gravatar email="<?php e($user['email'])?>"}</li>
		                	<li><a href="<?php e(admin_url('users/edit/'.$user['id']))?>"><i class="icon-user"></i>&nbsp;Edit profile</a></li>
		                	<li class="divider"></li>
		                	<li><a href="<?php e(admin_url('logout'))?>"><i class="icon-off"></i>&nbsp;Logout</a></li>
						</ul>
					</li>
          		</ul>
				<div class="nav-collapse">
					<ul class="nav">
						<li class="<?php e($module == "admin" ? 'active' : '')?>"><a href="<?php e(admin_url(''))?>">Dashboard</a></li>
						<li class="dropdown">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">View site&nbsp;<b class="caret"></b></a>
							<ul class="dropdown-menu">
							<?php
								foreach(config_item('supported_languages') as $lang => $info) {
							?>
								<li><a target="_blank" href="<?php e(site_url('', FALSE, TRUE))?>"><?php e(strtoupper($lang)." language")?></a></li>
							<?php
								}
							?>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid">
    	<div class="row-fluid">
    		<div class="span2">

				<div style="padding: 8px 0;" class="well">
					<?php
						get_instance()->load->helper('admin/admin');

						//admin_menu_tree()
					?>
			        <ul class="nav nav-list">
			          	<li class="nav-header">System modules</li>
			          	<li class="<?php e($module == "files" ? "active" : "")?>"><a href="<?php e(admin_url('files'))?>"><i class="icon-folder-open"></i>Files</a></li>
						<li class="<?php e($module == "pages" ? "active" : "")?>"><a href="<?php e(admin_url('pages'))?>"><i class="icon-book"></i>Pages</a></li>
						<li class="<?php e($module == "blog" ? "active" : "")?>"><a href="<?php e(admin_url('blog'))?>"><i class="icon-pencil"></i>Blog</a></li>
						<li class="<?php e($module == "comments" ? "active" : "")?>"><a href="<?php e(admin_url('comments'))?>"><i class="icon-comment"></i>Comments</a></li>
						<li class="<?php e($module == "contacts" ? "active" : "")?>"><a href="<?php e(admin_url('contacts'))?>"><i class="icon-envelope"></i>Contacts</a></li>
						<li class="<?php e($module == "letter_templates" ? "active" : "")?>"><a href="<?php e(admin_url('letter_templates'))?>"><i class="icon-file"></i>Letter templates</a></li>
						<li class="<?php e($module == "modules" ? "active" : "")?>"><a href="<?php e(admin_url('modules'))?>"><i class="icon-cog"></i>Modules</a></li>
						<li class="<?php e($module == "users" ? "active" : "")?>"><a href="<?php e(admin_url('users'))?>"><i class="icon-user"></i>Users</a></li>
						<li class="<?php e($module == "themes" ? "active" : "")?>"><a href="<?php e(admin_url('themes'))?>"><i class="icon-picture"></i>Themes</a></li>
						<li class="<?php e($module == "settings" ? "active" : "")?>"><a href="<?php e(admin_url('settings'))?>"><i class="icon-adjust"></i>Settings</a></li>
						<li class="nav-header">User modules</li>
						<?php
							$mods = $CI->modules_model->get_all('user');

							foreach($mods as $m) {
								if(	!empty($m['data']) && 
									$m['data']['enabled'] == DB_TRUE && 
									$m['data']['is_admin'] == DB_TRUE) {
						?>
						<li class="<?php e($module == $m['slug'] ? "active" : "")?>"><a href="<?php e(admin_url($m['slug']))?>"><?php e($m['slug'])?></a></li>
						<?php
								}
							}
						?>
					</ul>
				</div>

    		</div>
    		<div class="span10">

				<?php
					if(validation_errors() != "") {
						e('<div class="alert alert-error" id="validation_errors"><a class="close" data-dismiss="alert">×</a>'.validation_errors()."</div>");
					}

					$msg = $CI->session->flashdata('success_msg');
					if(!empty($msg)) {
				?>
				<div class="alert alert-success" id="success_msg">
					<a class="close" data-dismiss="alert">×</a>
					<?php e($msg)?>
				</div>
				<?php
					}

					$msg = $CI->session->flashdata('error_msg');
					if(!empty($msg)) {
				?>
				<div class="alert alert-error" id="error_msg">
					<a class="close" data-dismiss="alert">×</a>
					<?php e($msg)?>
				</div>
				<?php
					}

					if(!empty($upload_errors)) {
				?>
				<div class="alert alert-error" id="upload_errors">
					<a class="close" data-dismiss="alert">×</a>
					<?php e($upload_errors)?>
				</div>
				<?php
					}
				?>
    			{tag:template:body}

    		</div>
    	</div>
    </div>

	<div style="text-align: center; margin-top: 10px; font-size: 11px; margin-bottom: 20px;">
		Time: {elapsed_time}; Memory: {memory_usage}<br/>
		Built with <a href="http://twitter.github.com/bootstrap/" target="_blank">Twitter Bootstrap</a>, 
		<a href="http://jquery.com" target="_blank">JQuery</a>, 
		<a href="http://jqueryui.com" target="_blank">JQuery UI</a>&nbsp;&amp; 
		<a href="http://blueimp.github.com/jQuery-File-Upload/" target="_blank">BlueImp Jquery File Upload</a><br/>
		CI_MX2 ver. 2.0 (CI ver. <?php e(CI_VERSION)?>)
	</div>

	{tag:bootstrap:all_js}

	<script src="<?php e(base_url())?>public/themes/admin/jquery_file_upload/js/vendor/jquery.ui.widget.js"></script>
	<script src="<?php e(base_url())?>public/themes/admin/jquery_file_upload/js/jquery.iframe-transport.js"></script>
	<script src="<?php e(base_url())?>public/themes/admin/jquery_file_upload/js/jquery.fileupload.js"></script>

	<script type="text/javascript">
		(function($) {
			$(document).ready(function() {
				//window.parent.jQuery('.cke_dialog_footer').hide();

				$('.dropdown-toggle').dropdown();

				$('.btn-danger').click(function() {
					return confirm('Are you sure you want delete this?');
				});

				$("#success_msg, #error_msg, #upload_errors").delay(3000).fadeOut();
			});
		})(jQuery);
	</script>

</body>
</html>

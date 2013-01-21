<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	$config = 	array(
					'blog_settings/index'	=>	array(
													array(
														'field'	=>	'enable_blog', 
														'label'	=>	'Enable blog', 
														'rules'	=>	'xss_clean', 
													), 
													array(
														'field'	=>	'records_per_page', 
														'label'	=>	'Records per page', 
														'rules'	=>	'required|numeric', 
													), 
													array(
														'field'	=>	'allow_comments', 
														'label'	=>	'Allow comments', 
														'rules'	=>	'required', 
													), 
													array(
														'field'	=>	'allow_anonymous_comments', 
														'label'	=>	'Allow anonymous comments', 
														'rules'	=>	'required', 
													), 
												), 
				);

<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	$config	=	array(
					'admin/auth/login'	=>	array(
												array(
													'field' => 	'username', 
													'label'	=>	'Username', 
													'rules'	=>	'required|trim|strtolower|xss_clean', 
												),
												array(
													'field'	=>	'password', 
													'label'	=>	'Password', 
													'rules'	=>	'required|trim|callback__admin_auth_check', 
												),
												array(
													'field'	=>	'remember_me', 
													'label'	=>	'Remember me',  
													'rules'	=>	'trim', 
												), 
											),
				);

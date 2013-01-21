<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	$config = 	array(
					'auth/register'			=>	array(
													array(
														'field'	=>	'first_name', 
														'label'	=>	lang('auth_first_name'), 
														'rules'	=>	'required|trim', 
													), 
													array(
														'field'	=>	'last_name', 
														'label'	=>	lang('auth_last_name'), 
														'rules'	=>	'required|trim', 
													), 
													array(
														'field'	=>	'username', 
														'label'	=>	lang('auth_username'), 
														'rules'	=>	'required|trim|strtolower|max_length[15]|callback__username_uniq_check', 
													), 
													array(
														'field'	=>	'email', 
														'label'	=>	lang('auth_email'), 
														'rules'	=>	'required|trim|strtolower|valid_email|max_length[100]|callback__email_uniq_check', 
													), 
													array(
														'field'	=>	'password', 
														'label'	=>	lang('auth_password'), 
														'rules'	=>	'required|trim|xss_clean|min_length[4]', 
													), 
													array(
														'field'	=>	'confirm_password', 
														'label'	=>	lang('auth_confirm_password'), 
														'rules'	=>	'required|trim|xss_clean|min_length[4]|matches[password]', 
													), 
												), 
					'auth/activate' => array(
						array(
							'field' =>	'email', 
							'label' =>	'lang:auth_email', 
							'rules'	=>	'required|trim|xss_clean|strtolower|valid_email', 
						), 
						array(
							'field' =>	'code', 
							'label'	=>	'lang:auth_activation_code', 
							'rules'	=>	'required|trim|xss_clean|strtolower|callback__activation_code_check', 
						), 
					), 
					'auth/forgot_password' => 	array(
						array(
							'field' =>	'email', 
							'label'	=>	'lang:auth_email', 
							'rules'	=>	'required|trim|strtolower|valid_email|max_length[100]|callback__email_exists_check', 
						), 
					), 
					'auth/password_reset' => 	array(
													array(
														'field' =>	'password', 
														'label'	=>	lang('auth_password'), 
														'rules'	=>	'required|trim|xss_clean|strtolower|min_length[4]', 
													), 
													array(
														'field' =>	'confirm_password', 
														'label'	=>	lang('auth_confirm_password'), 
														'rules'	=>	'required|trim|xss_clean|strtolower|min_length[4]|matches[password]', 
													), 
												), 
				);

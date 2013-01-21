<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	$autoload['packages'] = array();

	$autoload['libraries'] = array(
								'session', 
								'tag', 
								'parser', 
								'template', 
								'simpletags', 
								'form_validation', 
								'image_lib', 
								'debug', 
								'upload', 
								'email', 
								'MX2_Multilang_model', 
								'events', 
							);

	$autoload['helper'] = 	array(
								'url', 
								'html', 
								'array', 
								'text', 
								'email', 
								'language', 
								'cookie', 
								'input', 
								'file', 
								'settings/settings', 
							);

	$autoload['config'] = array('environment', 'languages', );

	$autoload['language'] = array();

	$autoload['model'] = array(
							'themes/themes_model', 
							'modules/modules_model', 
							'users/users_model', 
							'users/roles_model', 
							'settings/settings_model', 
						);

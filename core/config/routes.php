<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	/*
	| -------------------------------------------------------------------------
	| RESERVED ROUTES
	| -------------------------------------------------------------------------
	|
	| There area two reserved routes:
	|
	|	$route['default_controller'] = 'welcome';
	|
	| This route indicates which controller class should be loaded if the
	| URI contains no data. In the above example, the "welcome" class
	| would be loaded.
	|
	|	$route['404_override'] = 'errors/page_missing';
	|
	| This route will tell the Router what URI segments to use if those provided
	| in the URL cannot be matched to a valid route.
	|
	*/

	$route['default_controller']	= "pages";
	$route['404_override']			= "pages";

	if(file_exists(EXTPATH.'config/languages.php')) require EXTPATH.'config/languages.php';
	else require FCPATH.APPPATH.'config/languages.php';

	$langs_part = "";
	if($config['lang_switch_method'] == 'url') {
		foreach($config['supported_languages'] as $k => $v) {
			$langs_part .= $k."|";
		}

		$langs_part = "(".trim($langs_part, "|").")/";
	}

	$route[$langs_part.'edit-profile']			= 'users/edit';
	$route[$langs_part.'activate/([a-z0-9]+)']	= 'auth/activate/$'.(empty($langs_part) ? '1' : '2');
	$route[$langs_part.'(login|logout|register|activate|forgot_password|signin|signout|signup)'] = 'auth/$'.(empty($langs_part) ? '1' : '2');

	$route['admin/([a-zA-Z_-]+)/(:any)']	= '$1/admin/$2';
	$route['admin/(login|logout)']			= 'admin/auth/$1';
	$route['admin/([a-zA-Z_-]+)']			= '$1/admin';

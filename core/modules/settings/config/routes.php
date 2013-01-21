<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	$route['settings/admin/hooks/(:any)'] 	= "settings_hooks/$1";
	$route['settings/admin/hooks'] 			= "settings_hooks";

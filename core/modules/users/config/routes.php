<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	$route['users/admin/roles/(:any)'] 	= "users_roles/$1";
	$route['users/admin/roles'] 		= "users_roles";

	//$route['users/([a-z0-9-_]+)'] 		= "users/view/$1";

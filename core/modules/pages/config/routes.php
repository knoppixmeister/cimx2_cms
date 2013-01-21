<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	$route['pages/admin/preview/([a-z]+)'] 		= "pages_preview/create_preview/$1";

	$route['pages/admin/layouts/(:any)'] 		= "page_layouts/$1";
	$route['pages/admin/layouts'] 				= "page_layouts";

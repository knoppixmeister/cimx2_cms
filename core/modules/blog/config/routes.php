<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	$route['blog/feed/(:any)']							=	"blog_feed/$1";
	$route['blog/feed']									=	"blog_feed";

	$route['blog/admin/preview/([a-z]+)'] 				=	"blog_preview/index/$1";

	$route['blog/admin/(settings|categories)/(:any)']	=	"blog_$1/$2";
	$route['blog/admin/(settings|categories)'] 			=	"blog_$1";

	$route['blog/(:num)/(:num)/([a-zA-Z0-9-_]+)'] 		=	"blog/view_by_date/$1/$2/$3";
	$route['blog/(:num)/(:num)']						=	"blog/view_by_date/$1/$2";

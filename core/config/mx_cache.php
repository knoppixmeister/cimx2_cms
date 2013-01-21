<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	$config['mx_cache_enabled']	=	TRUE;
	$config['cache_type']		=	"files";//files, apc, redis, ...
	$config['cache_dir']		=	APPPATH."cache/";

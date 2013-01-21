<?php 
	defined('BASEPATH') || exit('No direct script access allowed');

	$config['supported_languages'] = 	array(
											'en'	=>	array(
															'name' 		=>	'English', 
															'folder' 	=>	'en', 
														), 
										);

	$config['default_language']		=	'en';
	$config['lang_switch_method']	=	'url';	//'url' -> /../<some_page_addrr>
												//'get_param' -> ?lang=..
	$config['wrong_language']		=	'error';//or 'error'
												//or 'correct'
												//or 'redirect'
	$config['cookie_remember_lang']	=	TRUE;
	$config['lang_cookie_name']		=	"lang";
	$config['get_param_lang_name']	=	$config['lang_cookie_name'];

	$config['ignore_lang_paths']	=	array('admin', 'ajax', 'files', 'sitemap', );

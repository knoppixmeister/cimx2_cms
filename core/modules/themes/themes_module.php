<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Themes_Module extends Module {
		function __construct() {
			parent::__construct();
		}

		function get_info() {
			return 	array(
						'version' 			=>	"1.0", 
						'name'				=>	array(
													'en' => 'Themes', 
												), 
						'description' 		=>	array(
													'en' => 'Themes management module', 
												), 
						'author' 			=>	"JB", 
						'author_website'	=>	"http://swsynth.com", 
						'website'			=>	"http://swsynth.com", 
						'admin_menu_group'	=>	NULL, 
						'admin_menu'		=>	array(
													'url'	=>	admin_url('themes'), 
													'title'	=>	'Themes', 
												), 
						'is_system'			=>	TRUE, 
						'is_admin'			=>	TRUE, 
						'is_frontend'		=>	FALSE, 
					);
		}

		function install() {
			return TRUE;
		}

		function uninstall() {
			return TRUE;
		}
	}

<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Admin_Theme extends Theme {
		function __construct() {
			parent::__construct();
		}

		function get_info() {
			return 	array(
						'version' 		=>	"1.0", 
						'name'			=>	array(
												'en' => 'Admin', 
											), 
						'description' 	=>	array(
												'en' => 'Default admin theme', 
											), 
						'author' 		=>	"JB", 
						'author_website'=>	"http://swsynth.com", 
						'website' 		=>	"http://swsynth.com", 
						'admin_theme' 	=>	TRUE, 
					);
		}

		function install() {
			return TRUE;
		}

		function uninstall() {
			return TRUE;
		}
	}

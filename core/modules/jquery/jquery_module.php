<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Jquery_Module extends Module {
		function __construct() {
			parent::__construct();
		}

		function get_info() {
			return 	array(
						'version'		=>	"1.0", 
						'name'			=>	array(
												'en' => 'JQuery', 
											), 
						'description' 	=>	array(
												'en' => 'JQuery module', 
											), 
						'author' 		=>	"JB", 
						'author_website'=>	"http://swsynth.com", 
						'website'		=>	"http://swsynth.com", 
						'is_system'		=>	TRUE, 
						'is_admin'		=>	FALSE, 
						'is_frontend'	=>	FALSE, 
					);
		}

		function install() {
			return TRUE;
		}

		function uninstall() {
			return TRUE;
		}
	}

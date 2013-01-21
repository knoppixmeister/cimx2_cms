<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Ajax_Module extends Module {
		function __construct() {
			parent::__construct();
		}

		function get_info() {
			return 	array(
						'version' 		=>	"1.0", 
						'name'			=> 	array(
												'en' => 'Ajax', 
											), 
						'description' 	=>	array(
												'en' => 'General ajax functions', 
											), 
						'author' 		=> 	"JB", 
						'author_website'=> 	"http://swsynth.com", 
						'website'		=>	"http://swsynth.com", 
						'is_system'		=>	TRUE, 
						'is_admin'		=>	FALSE, 
						'is_frontend'	=>	TRUE, 
					);
		}

		function install() {
			return TRUE;
		}

		function uninstall() {
			return TRUE;
		}
	}

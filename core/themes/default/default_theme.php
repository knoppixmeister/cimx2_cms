<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Default_Theme extends Theme {
		function __construct() {
			parent::__construct();
		}

		function get_info() {
			return 	array(
						'version' 			=> "1.0", 
						'name'				=> 	array(
													'en' => 'Default', 
												),
						'description'		=>	array(
													'en' => 'Default theme', 
												),
						'author'			=>	"JB", 
						'author_website' 	=>	"http://swsynth.com", 
						'website'			=>	"http://swsynth.com", 
					);
		}

		function install() {
			return TRUE;
		}

		function uninstall() {
			return TRUE;
		}
	}

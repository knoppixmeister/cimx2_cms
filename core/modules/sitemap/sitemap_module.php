<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Sitemap_Module extends Module {
		function __construct() {
			parent::__construct();
		}

		function get_info() {
			return 	array(
						'version'			=>	"1.0", 
						'name'				=>	array(
													'en' => 'Sitemap', 
												), 
						'description'		=>	array(
													'en' => 'Sitemap module', 
												), 
						'author'			=>	"JB", 
						'author_website'	=>	"http://cimx2.com", 
						'website'			=>	"http://cimx2.com", 
						'is_system'			=>	TRUE, 
						'is_frontend'		=>	TRUE, 
						'is_admin'			=>	FALSE, 
					);
		}

		function install() {
			return TRUE;
		}

		function uninstall() {
			return TRUE;
		}
	}

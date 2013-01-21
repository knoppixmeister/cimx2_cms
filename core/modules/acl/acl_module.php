<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Acl_Module extends Module {
		function __construct() {
			parent::__construct();
		}

		function get_info() {
			return 	array(
						'version' 		=> "1.0", 
						'name'			=> 	array(
												'en' => 'ACL', 
											), 
						'description' 	=>  array(
												'en' => 'Access control lists management module', 
											), 
						'author' 		=> 	"JB", 
						'author_website'=> 	"http://swsynth.com", 
						'website'		=>	"http://swsynth.com", 
						'is_admin'		=>	TRUE, 
						'is_frontend'	=>	FALSE, 
					);
		}

		function install() {
			if($this->db->platform() == "mysql") {
				return TRUE;
			}
			elseif($this->db->platform() == "postgre") {
				return TRUE;
			}

			return FALSE;
		}

		function uninstall() {
			return TRUE;
		}
	}

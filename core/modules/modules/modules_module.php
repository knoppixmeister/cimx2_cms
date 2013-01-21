<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Modules_Module extends Module {
		function __construct() {
			parent::__construct();
		}

		function get_info() {
			return 	array(
						'version' 			=>	"1.0", 
						'name'				=>	array(
													'en' => 'Modules', 
												), 
						'description'		=>	array(
													'en' => 'Modules management module', 
												), 
						'author' 			=>	"JB", 
						'author_website' 	=>	"http://swsynth.com", 
						'website'			=>	"http://swsynth.com", 
						'admin_menu'		=>	array(
													'url'	=>	admin_url('modules'), 
													'title'	=>	'Modules', 
												), 
						'is_system'			=>	TRUE, 
						'is_admin'			=>	TRUE, 
						'is_frontend'		=>	FALSE, 
					);
		}

		function install() {
			if($this->db->platform() == "mysql") {
				$query1 = "	CREATE TABLE IF NOT EXISTS `modules` ( 
							  `id` int(11) NOT NULL AUTO_INCREMENT, 
							  `slug` varchar(255) NOT NULL, 
							  `version` varchar(255) NOT NULL, 
							  `admin_menu_group` text, 
							  `admin_menu` text, 
							  `enabled` tinyint(1) NOT NULL DEFAULT '0',
							  `is_system` tinyint(1) NOT NULL DEFAULT '0', 
							  `is_admin` tinyint(1) NOT NULL default '0', 
							  `is_frontend` tinyint(1) NOT NULL default '0', 
							  PRIMARY KEY (`id`), 
							  UNIQUE KEY `slug` (`slug`) 
							) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";

				return $this->db->query($query1) && $this->db->query($query2);
			}
			elseif($this->db->platform() == "postgre") {
				$query1 = "";

				$query2 = "";

				return TRUE;
			}

			return FALSE;
		}

		function uninstall() {
			return TRUE;
		}
	}

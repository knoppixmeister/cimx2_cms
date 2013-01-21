<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Contacts_Module extends Module {
		function __construct() {
			parent::__construct();
		}

		function get_info() {
			return 	array(
						'version'		=>	"1.0", 
						'name'			=>	array(
												'en' => 'Contacts', 
											), 
						'description'	=>	array(
												'en' => 'Contacts module', 
											), 
						'author'		=>	"JB (knoppixmeister@gmail.com)", 
						'author_website'=>	"http://swsynth.com", 
						'website'		=>	"http://swsynth.com", 
						'admin_menu'	=>	array(
												'url'	=>	admin_url('contacts'), 
												'title'	=>	'Contacts', 
											), 
						'is_system'		=>	TRUE, 
						'is_admin'		=>	TRUE, 
						'is_frontend'	=>	TRUE, 
					);
		}

		function install() {
			$this->dbforge->drop_table('contacts');

			if($this->db->platform() == "mysql") {
				return $this->db->query("	CREATE TABLE IF NOT EXISTS `contacts` (
											  `id` int(11) NOT NULL auto_increment, 
											  `name` text NOT NULL, 
											  `email` varchar(255) NOT NULL, 
											  `phone` varchar(50), 
											  `subject` text NOT NULL, 
											  `text` text NOT NULL, 
											  `ip` varchar(16) NOT NULL, 
											  `created_time` int(11) NOT NULL, 
											  PRIMARY KEY  (`id`)
											) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");
			}
			elseif($this->db->platform() == "postgre") {
				$query = "";

				return FALSE;
			}

			return FALSE;
		}

		function uninstall() {
			return $this->dbforge->drop_table('contacts');
		}
	}

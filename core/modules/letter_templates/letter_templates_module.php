<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Letter_templates_module extends Module {
		function __construct() {
			parent::__construct();
		}

		function get_info() {
			return 	array(
						'version' 		=>	"2.0", 
						'name'			=>	array(
												'en' => 'Letter templates', 
											), 
						'description' 	=>	array(
												'en' => 'Letter templates management module', 
											), 
						'author' 		=>	"JB", 
						'author_website'=>	"http://swsynth.com", 
						'website'		=>	"http://swsynth.com", 
						'admin_menu'	=>	array(
												'url'	=>	admin_url('letter_templates'), 
												'title'	=>	'Letter templates', 
											), 
						'is_system'		=>	TRUE, 
						'is_admin'		=>	TRUE, 
						'is_frontend'	=>	FALSE, 
					);
		}

		function install() {
			$this->dbforge->drop_table('letter_templates');

			if($this->db->platform() == "mysql") {
				$query = "	CREATE TABLE IF NOT EXISTS `letter_templates` (
							  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
							  `name` text NOT NULL,
							  `slug` text NOT NULL,
							  `language` varchar(10) NOT NULL,
							  `description` text,
							  `subject` text,
							  `body` text,
							  `modified_by` int(11) NOT NULL,
							  `modified_time` int(11) NOT NULL,
							  `created_by` int(11) NOT NULL,
							  `created_time` int(11) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
			}
			elseif($this->db->platform() == "postgre") {
				return TRUE;
			}

			return $this->db->query($query);
		}

		function uninstall() {
			return $this->dbforge->drop_table('letter_templates');
		}
	}

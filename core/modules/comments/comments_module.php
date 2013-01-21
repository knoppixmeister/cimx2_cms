<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Comments_Module extends Module {
		function __construct() {
			parent::__construct();
		}

		function get_info() {
			return 	array(
						'version' 		=>	"1.0", 
						'name'			=>	array(
												'en' => 'Comments', 
											), 
						'description' 	=>	array(
												'en' => 'Comments management module', 
											), 
						'author' 		=>	"JB", 
						'author_website'=>	"http://swsynth.com", 
						'website'		=>	"http://swsynth.com", 
						'admin_menu'	=> 	array(
												'url' 	=>	admin_url('comments'), 
												'title' =>	'Comments', 
											), 
						'is_system'		=>	TRUE, 
						'is_admin'		=>	TRUE, 
					);
		}

		function install() {
			$this->dbforge->drop_table('comments');

			$query1 = "	CREATE TABLE IF NOT EXISTS `comments` (
						  `id` int(11) NOT NULL auto_increment, 
						  `module` text NOT NULL, 
						  `module_id` int(11) NOT NULL, 
						  `title` text NOT NULL, 
						  `text` text NOT NULL, 
						  `created_by` int(11) DEFAULT NULL, 
						  `created_time` int(11) NOT NULL, 
						  PRIMARY KEY (`id`) 
						) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";

			return $this->db->query($query1);
		}

		function uninstall() {
			return $this->dbforge->drop_table('comments');
		}
	}

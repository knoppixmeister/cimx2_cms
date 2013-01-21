<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Users_Module extends Module {
		function __construct() {
			parent::__construct();
		}

		function get_info() {
			return 	array(
						'version' 		=>	"1.0", 
						'name'			=>	array(
												'en' => 'Users', 
											), 
						'description' 	=>	array(
												'en' => 'User management module', 
											), 
						'author' 		=>	"JB", 
						'author_website'=>	"http://cimx2.com", 
						'website'		=>	"http://cimx2.com", 
						'admin_menu'	=>	array(
												'url'	=>	admin_url('users'), 
												'title'	=>	array(
																'en' => 'Users', 
															), 
											), 
						'is_system'		=>	TRUE, 
						'is_admin'		=>	TRUE, 
						'is_frontend'	=>	TRUE, 
					);
		}

		function install() {
			if($this->db->platform() == "mysql") {
				$query1 = "	CREATE TABLE IF NOT EXISTS `user_info` (
							  `id` int(11) NOT NULL auto_increment,
							  `user_id` int(11) NOT NULL,
							  `sex` enum('male','female') default NULL,
							  `avatar_type` enum('gravatar','file') default NULL,
							  `avatar_path` text,
							  `birth_date` int(11) default NULL,
							  `phone` varchar(50) default NULL,
							  `skype` varchar(255) default NULL,
							  `msn` varchar(255) default NULL,
							  PRIMARY KEY (`id`), 
							  UNIQUE KEY `user_id` (`user_id`) 
							) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";

				$query2 = "	CREATE TABLE IF NOT EXISTS `users` (
							  `id` int(11) NOT NULL auto_increment,
							  `first_name` text,
							  `last_name` text,
							  `username` varchar(100) NOT NULL,
							  `password` varchar(32) NOT NULL,
							  `email` varchar(255) NOT NULL,
							  `role_id` int(11) NOT NULL,
							  `status` enum('active','disabled') NOT NULL,
							  `reset_code` varchar(32) default NULL,
							  `activated` tinyint(1) NOT NULL default '0',
							  `activation_code` varchar(32) default NULL,
							  `created_time` int(11) NOT NULL,
							  PRIMARY KEY  (`id`),
							  UNIQUE KEY `username` (`username`),
							  UNIQUE KEY `email` (`email`),
							  UNIQUE KEY `activation_code` (`activation_code`),
							  UNIQUE KEY `reset_code` (`reset_code`)
							) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";

				$quer3 = "	CREATE TABLE IF NOT EXISTS `user_roles` (
							  `id` int(11) NOT NULL auto_increment, 
							  `name` varchar(50) NOT NULL, 
							  `description` text, 
							  PRIMARY KEY (`id`), 
							  UNIQUE KEY code` (`code`)
							) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";

				$query4 = "	INSERT INTO `user_roles` (`name`, `description`) 
							VALUES 	('admin', 'Administrator'), 
									('user', 'User');";

				return 	$this->db->query($query1) && 
						$this->db->query($query2) && 
						$this->db->query($query3) && 
						$this->db->query($query4);
			}
			elseif($this->db->platform() == "postgre") {

				return TRUE;
			}

			return FALSE;
		}

		function uninstall() {
			return	$this->dbforge->drop_table('user_info') && 
					$this->dbforge->drop_table('users') && 
					$this->dbforge->drop_table('user_roles');
		}
	}

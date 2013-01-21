<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Blog_Module extends Module {
		function __construct() {
			parent::__construct();
		}

		function get_info() {
			return 	array(
						'version'		=>	"1.0", 
						'name'			=>	array(
												'en' => 'Blog', 
											), 
						'description' 	=>	array(
												'en' => 'Blog Multi Language (ML) version module', 
											), 
						'author' 		=>	"JB", 
						'author_website'=>	"http://swsynth.com", 
						'website'		=>	"http://swsynth.com", 
						'admin_menu'	=> 	array(
												'url'	=>	admin_url('blog'), 
												'title'	=>	'Blog', 
											), 
						'is_system'		=>	TRUE, 
						'is_admin'		=>	TRUE, 
						'is_frontend'	=>	TRUE, 
						'requires'		=>	array(
												'modules'	=> 	array(
																	array(
																		'slug'		=>	'multilang', 
																		'version'	=>	'1.0', 
																	), 
																), 
												'themes'	=> 	array(), 
											), 
					);
		}

		function install() {
			$query1 = "	CREATE TABLE IF NOT EXISTS `blog_settings` ( 
						  	`id` int(11) NOT NULL AUTO_INCREMENT, 
						  	`name` varchar(255) NOT NULL, 
						  	`value` text NOT NULL, 
							PRIMARY KEY (`id`), 
							UNIQUE KEY `name` (`name`) 
						) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";

			$query2 = "	CREATE TABLE IF NOT EXISTS `blog_categories` ( 
						  `id` int(11) NOT NULL AUTO_INCREMENT, 
						  `parent_id` int(11) NOT NULL DEFAULT '0', 
						  `slug` text NOT NULL, 
						  PRIMARY KEY (`id`) 
						) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";

			$query3 = "	CREATE TABLE IF NOT EXISTS `blog` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `category_id` int(11) DEFAULT NULL,
						  `slug` text NOT NULL,
						  `status` enum('draft','live','_preview','_auto_save') NOT NULL DEFAULT 'draft',
						  `comments_enabled` tinyint(1) NOT NULL DEFAULT '1',
						  `created_by` int(11) NOT NULL,
						  `created_time` int(11) NOT NULL,
						  PRIMARY KEY (`id`),
						  KEY `category_id` (`category_id`),
						  KEY `status` (`status`),
						  KEY `created_by` (`created_by`),
						  KEY `created_time` (`created_time`)
						) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";

			return	$this->db->query($query1) && 
					$this->db->query($query2) && 
					$this->db->query($query3);
		}

		function uninstall() {
			$this->db->query("	DELETE 
								FROM _texts 
								WHERE module = 'blog'");
			$this->db->query("	DELETE 
								FROM _texts 
								WHERE module = 'blog_categories'");

			return 	$this->dbforge->drop_table('blog') && 
					$this->dbforge->drop_table('blog_categories') && 
					$this->dbforge->drop_table('blog_settings');
		}
	}

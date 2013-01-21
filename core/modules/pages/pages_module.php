<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Pages_Module extends Module {
		function __construct() {
			parent::__construct();
		}

		function get_info() {
			return 	array(
						'version'		=>	"1.0", 
						'name'			=>	array(
												'en' => 'Pages', 
											), 
						'description' 	=>	array(
												'en' => 'Multilanguage (ML ver.) pages management module', 
											), 
						'author' 		=> 	"JB", 
						'author_website'=> 	"http://swsynth.com", 
						'website'		=>	"http://swsynth.com", 
						'admin_menu'	=> 	array(
												'url'	=>	admin_url('pages'), 
												'title'	=>	'Pages', 
											), 
						'is_system'		=>	TRUE, 
						'is_admin'		=>	TRUE, 
						'is_frontend'	=>	TRUE, 
						'requires'		=>	array(
												'modules'	=>	array(
																	array(
																		'slug'		=>	'multilang', 
																		'version'	=>	'1.0', 
																	), 
																), 
												//'themes'	=>	array(), 
											), 
					);
		}

		function install() {
			if($this->db->platform() == "mysql") {
				$query1 = "	CREATE TABLE IF NOT EXISTS `page_layouts` (
							  `id` int(11) NOT NULL auto_increment,
							  `title` text NOT NULL, 
							  `theme` text NOT NULL, 
							  `layout_file` text NOT NULL, 
							  `content` text NOT NULL, 
							  PRIMARY KEY  (`id`) 
							) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";

				$query2 = "	CREATE TABLE IF NOT EXISTS `pages` (
							  `id` int(11) NOT NULL AUTO_INCREMENT,
							  `parent_id` int(11) DEFAULT NULL,
							  `uri` text NOT NULL,
							  `slug` text NOT NULL,
							  `layout_id` int(11) NOT NULL,
							  `status` enum('draft','live','_preview','_auto_save') NOT NULL DEFAULT 'draft',
							  `is_default` tinyint(1) NOT NULL DEFAULT '0',
							  `css` text,
							  `javascript` text,
							  `visibility` enum('public','password','registered') NOT NULL DEFAULT 'public',
							  `password` text,
							  `publish_start_time` int(11) NOT NULL, 
							  `publish_end_time` int(11) DEFAULT NULL, 
							  `comments_enabled` tinyint(1) NOT NULL DEFAULT '0', 
							  `created_by` int(11) NOT NULL, 
							  `created_time` int(11) NOT NULL, 
							  PRIMARY KEY (`id`) 
							) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";

				return 	$this->db->query($query1) && 
						$this->db->query($query2);
			}
			elseif($this->db->platform() == "postgre") {
				return TRUE;
			}

			return FALSE;
		}

		function uninstall() {
			return 	$this->dbforge->drop_table('page_layouts') && 
					$this->dbforge->drop_table('pages');
		}
	}

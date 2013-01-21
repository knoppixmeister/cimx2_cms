<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Multilang_Module extends Module {
		function __construct() {
			parent::__construct();
		}

		function get_info() {
			return 	array(
						'version'		=>	"1.0", 
						'name'			=>	array(
												'en' =>	'Multilanguage base', 
											), 
						'description' 	=>	array(
												'en' =>	'Multilanguage base tables & func management module', 
											), 
						'author' 		=> 	"JB", 
						'author_website'=> 	"http://swsynth.com", 
						'website'		=>	"http://swsynth.com", 
						'is_system'		=>	TRUE, 
						'is_admin'		=>	FALSE, 
						'is_frontend'	=>	FALSE, 
					);
		}

		function install() {
			$this->dbforge->drop_table('_texts');

			if($this->db->platform() == "mysql") {
				$query = "	CREATE TABLE IF NOT EXISTS `_texts` (
							  `id` int(10) unsigned NOT NULL auto_increment, 
							  `module` varchar(255) NOT NULL, 
							  `module_record_id` int(11) NOT NULL, 
							  `field` varchar(255) NOT NULL, 
							  `language` varchar(20) NOT NULL, 
							  `text` text NOT NULL, 
							  PRIMARY KEY (`id`) 
							) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";

				return $this->db->query($query);
			}
			elseif($this->db->platform() == "postgre") {
				$query = "";

				return TRUE;
						//$this->db->query($query);
			}

			return FALSE;
		}

		function uninstall() {
			return $this->dbforge->drop_table('_texts');
		}
	}

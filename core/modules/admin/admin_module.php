<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Admin_Module extends Module {
		function __construct() {
			parent::__construct();
		}

		function get_info() {
			return 	array(
						'version' 		=> "1.0", 
						'name'			=> 	array(
												'en' => 'Admin', 
											), 
						'description' 	=>  array(
												'en' => 'Admin (dashboard) module', 
											), 
						'author' 		=> 	"JB", 
						'author_website'=> 	"http://swsynth.com", 
						'website'		=>	"http://swsynth.com", 
						'is_system'		=>	TRUE, 
						'is_admin'		=>	TRUE, 
						'is_frontend'	=>	FALSE, 
					);
		}

		function install() {
			$this->dbforge->drop_table('ci_mx2_sessions');

			if($this->db->platform() == "mysql") {
				$query1 = "	CREATE TABLE IF NOT EXISTS `ci_mx2_sessions` (
							  `session_id` varchar(40) NOT NULL default '0', 
							  `ip_address` varchar(16) NOT NULL default '0', 
							  `user_agent` text NOT NULL, 
							  `last_activity` int(10) unsigned NOT NULL default '0', 
							  `user_data` text default NULL, 
							  PRIMARY KEY (`session_id`) 
							) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

				return $this->db->query($query1);
			}
			elseif($this->db->platform() == "postgre") {
				$query1 = "	CREATE TABLE ci_mx2_sessions (
								session_id character varying(40) DEFAULT 0 NOT NULL, 
								ip_address character varying(16) DEFAULT 0 NOT NULL, 
								user_agent text NOT NULL, 
								last_activity integer DEFAULT 0 NOT NULL, 
								user_data text 
							);";

				$query2 = "	ALTER TABLE ONLY ci_mx2_sessions 
							ADD CONSTRAINT ci_mx2_sessions_pkey PRIMARY KEY (session_id);";

				return 	$this->db->query($query1) && 
						$this->db->query($query2);
			}

			return FALSE;
		}

		function uninstall() {
			return $this->dbforge->drop_table('ci_mx2_sessions');
		}
	}

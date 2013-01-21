<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Settings_Module extends Module {
		function __construct() {
			parent::__construct();
		}

		function get_info() {
			return 	array(
						'version'			=>	"1.0", 
						'name'				=>	array(
													'en' => 'Settings', 
												), 
						'description'		=>	array(
													'en' => 'Settings module', 
												), 
						'author'			=>	"JB", 
						'author_website'	=>	"http://swsynth.com", 
						'website'			=>	"http://swsynth.com", 
						'is_system'			=>	TRUE, 
						'is_frontend'		=>	FALSE, 
						'is_admin'			=>	TRUE, 
						'admin_menu'		=>	array(
													'url'	=>	admin_url('settings'), 
													'title'	=>	'Settings', 
												), 
					);
		}

		function install() {
			if($this->db->platform() == "mysql") {
				return $this->db->query("	CREATE TABLE IF NOT EXISTS `settings` (
											  `id` int(11) NOT NULL auto_increment,
											  `name` varchar(255) NOT NULL,
											  `value` text NOT NULL,
											  PRIMARY KEY  (`id`),
											  UNIQUE KEY `name` (`name`)
											) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");
			}
			elseif($this->db->platform() == "postgre") {
				$query 	=	"CREATE TABLE settings (
							    id integer NOT NULL, 
							    name character varying(255) NOT NULL, 
							    value text 
							);

							CREATE SEQUENCE settings_id_seq 
							    START WITH 1
							    INCREMENT BY 1
							    NO MAXVALUE
							    NO MINVALUE
							    CACHE 1;

							ALTER SEQUENCE settings_id_seq OWNED BY settings.id;

							ALTER TABLE settings ALTER COLUMN id SET DEFAULT nextval('settings_id_seq'::regclass);

							ALTER TABLE ONLY settings ADD CONSTRAINT settings_pkey PRIMARY KEY (id);";

				return $this->db->query($query);
			}

			return FALSE;
		}

		function uninstall() {
			return $this->dbforge->drop_table('settings');
		}
	}

<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Files_Module extends Module {
		function __construct() {
			parent::__construct();
		}

		function get_info() {
			return 	array(
						'version' 		=>	"1.0", 
						'name'			=>	array(
												'en' => 'Files', 
											), 
						'description' 	=>	array(
												'en' => 'Files management module', 
											), 
						'author' 		=>	"JB", 
						'author_website'=>	"http://swsynth.com", 
						'website'		=>	"http://swsynth.com", 
						'admin_menu'	=>	array(
												'url'	=>	admin_url('files'), 
												'title'	=>	'Files', 
											), 
						'is_system'		=>	TRUE, 
						'is_admin'		=>	TRUE, 
						'is_frontend'	=>	TRUE, 
					);
		}

		function install() {
			if($this->db->platform() == "mysql") {
				$query1 = "	CREATE TABLE IF NOT EXISTS `files` (
							  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
							  `folder_id` int(11) DEFAULT NULL,
							  `parent_file_id` int(11) DEFAULT NULL,
							  `file_name` text NOT NULL,
							  `title` text,
							  `description` text,
							  `file_size` int(11) NOT NULL,
							  `file_mime_type` text NOT NULL,
							  `image_width` int(11) DEFAULT NULL,
							  `image_height` int(11) DEFAULT NULL,
							  `download_count` int(11) NOT NULL DEFAULT '0',
							  `created_time` int(11) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";

				$query2 = "	CREATE TABLE IF NOT EXISTS `files_folders` (
							  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
							  `parent_id` int(11) NOT NULL,
							  `slug` text NOT NULL,
							  `name` text NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";

				return $this->db->query($query1) && $this->db->query($query2);
			}
			elseif($this->db->platform() == "postgre") {
				$query = "	CREATE TABLE files (
							    id integer NOT NULL,
							    folder_id integer,
							    parent_file_id integer,
							    file_name text NOT NULL,
							    title text NOT NULL,
							    description text,
							    file_size integer NOT NULL,
							    file_mime_type text NOT NULL,
							    image_width integer,
							    image_height integer,
							    download_count integer DEFAULT 0 NOT NULL,
							    created_time integer NOT NULL
							);

							CREATE SEQUENCE files_id_seq
							    START WITH 1
							    INCREMENT BY 1
							    NO MINVALUE
							    NO MAXVALUE
							    CACHE 1;

							ALTER SEQUENCE files_id_seq OWNED BY files.id;

							ALTER TABLE files ALTER COLUMN id SET DEFAULT nextval('files_id_seq'::regclass);

							ALTER TABLE ONLY files ADD CONSTRAINT files_pkey PRIMARY KEY (id);

							CREATE TABLE files_folders (
							    id integer NOT NULL,
							    parent_id integer NOT NULL,
							    slug text NOT NULL,
							    name text NOT NULL
							);

							CREATE SEQUENCE files_folders_id_seq
							    START WITH 1
							    INCREMENT BY 1
							    NO MINVALUE
							    NO MAXVALUE
							    CACHE 1;

							ALTER SEQUENCE files_folders_id_seq OWNED BY files_folders.id;

							ALTER TABLE files_folders ALTER COLUMN id SET DEFAULT nextval('files_folders_id_seq'::regclass);

							ALTER TABLE ONLY files_folders
							    ADD CONSTRAINT files_folders_pkey PRIMARY KEY (id);";

				foreach(explode(';', $query) as $q) {
					$this->db->query($q);
				}

				return TRUE;
			}

			return FALSE;
		}

		function uninstall() {
			return	$this->dbforge->drop_table('files_folders') && 
					$this->dbforge->drop_table('files');
		}
	}

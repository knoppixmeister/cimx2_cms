<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Files_folders_model extends MX2_Model {
		protected $_root_folder = 	array(
										'id'		=>	0, 
										'parent_id'	=>	-1, 
										'slug'		=>	'/', 
										'name'		=>	'/', 
									);
		public $_folders_options_tree = array(0 => '/', );

		function __construct() {
			parent::__construct();

			$this->load->model('files/files_model');//DON'T DELETE THIS!
		}

		function folder_content_by_id($folder_id=0, $limit=30, $offset=0, $content=array('files', 'folders', )) {
			$res = array();

			if(in_array('folders', $content)) {
				$folders = $this->order_by('id', 'DESC')
								->get_many_by('parent_id', $folder_id);
				foreach($folders as $f) {
					$res[] = 	array(
									'type'	=>	'folder', 
									'data'	=>	$f, 
								);
				}
			}

			if(in_array('files', $content)) {
				$files = $this->files_model->order_by('id', 'DESC')
											->get_many_by('folder_id', $folder_id);
				foreach($files as $f) {
					$res[] = 	array(
									'type'	=>	'file', 
									'data'	=>	$f, 
								);
				}
			}

			return $res;
		}

		function get_folders_tree($parent_id=0) {
			$res = array();

			$folders = $this->get_many_by(array('parent_id' => $parent_id, ));
			foreach($folders as $f) {
				$res[] = array_merge($f, array('childs' => $this->get_folders_tree($f['id']), ));
			}

			if($parent_id == 0) $res = 	array('0' => array(
														'id' 		=>	0, 
														"parent_id" =>	"-1", 
											    		"slug" 		=>	"/", 
											    		"name" 		=>	"/", 
											    		"childs" 	=>	$res, 
											    	), 
										);

			return $res;
		}

		function get_folders_options_tree($parent_id=0, $padding=0) {
			$folders = $this->get_many_by(array('parent_id' => $parent_id, ));

			foreach($folders as $f) {
				$this->_folders_options_tree[$f['id']] = str_repeat("&nbsp;", $padding).$f['name'];

				$this->get_folders_options_tree($f['id'], $padding+3);
			}
		}

		function delete($id) {
			if(!$this->files_model->delete_by('folder_id', $id)) return FALSE;

			foreach($this->files_folders_model->get_many_by('parent_id', $id) as $f) {
				if(!$this->delete($f['id'])) return FALSE;
			}

			return parent::delete($id);
		}

		function get_folder_parents($folder_id) {
			$folder = $this->get($folder_id);

			if($folder_id == 0) return $this->_root_folder;
			else {
				$res =	array(
							'data' 		=>	$folder, 
							'parent' 	=>	$this->get_folder_parents($folder['parent_id']), 
						);
			}

			return $res;
		}

		function make_url($parent_folder_id, $folder_id=NULL, $folder_name=NULL) {
			if(!is_numeric($parent_folder_id)) $pf_url = "";
			else {
				$pf	= $this->get($parent_folder_id);

				$pf_url = $pf['url'];
			}

			if(!is_numeric($folder_id)) {
				if(empty($folder_name))	$f_url = "";
				else $f_url = url_title($folder_name);
			}
			else {
				$f = $this->get($folder_id);

				$f_url = $f['url'];
			}

			return $pf_url."/".$f_url;
		}
	}

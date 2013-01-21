<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Modules_model extends MX2_Model {
		public $locations;

		protected $_modules_data = array();

		function __construct() {
			parent::__construct();

			$this->locations = 	array(
									APPPATH."modules/", 
									EXTPATH."modules/", 
								);

			$_mods_data = $this->db->order_by('slug')
									->get($this->_table)
									->result_array();

			foreach($_mods_data as $_md) {
				$this->_modules_data[$_md['slug']] = $_md;
			}
		}

		function get_by_slug($slug) {
			if(empty($slug)) return NULL;

			$slug = strtolower($slug);

			return (isset($this->_modules_data[$slug]) ? $this->_modules_data[$slug] : NULL);
		}

		function get_all($type=NULL, $locations=NULL) {//type = 'system' | 'user'
			$result = array();

			$locations = $this->_validate_locations($locations);

			foreach($locations as $dir) {
				if(file_exists($dir) &&	$dh = opendir($dir)) {
					while(($file = readdir($dh)) !== FALSE) {
						if(!str_starts_with($file, '.') && filetype($dir.$file) == "dir") {
							if(file_exists($dir.$file."/".$file."_module".EXT)) {
								require_once $dir.$file."/".$file."_module".EXT;

								$module_class = ucfirst($file)."_Module";

								$module = new $module_class();

								$module_data = $this->get_by_slug($file);

								$module_info = $module->get_info();
								if($type == "user") {
									if(empty($module_info['is_system'])) {
										$result[] = array(
										        		'path' 			=> 	$dir, 
										        		'slug' 			=> 	$file, 
										        		'info'			=> 	$module_info,  
										        		'data'			=>	$module_data, 
													);
									}
								}
								elseif($type == "system") {
									if(!empty($module_info['is_system'])) {
										$result[] = array(
														'path' 			=> 	$dir, 
														'slug' 			=> 	$file, 
														'info'			=> 	$module_info, 
														'data'			=>	$module_data, 
													);
									}
								}
								else {
									$result[] = array(
													'path' 			=> 	$dir, 
													'slug' 			=> 	$file, 
													'info'			=> 	$module_info, 
													'data'			=>	$module_data, 
												);
								}
							}
						}
					}

					closedir($dh);
				}
				else continue;
			}

			return $result;
		}

		function install($slug, $locations=NULL) {
			$locations = $this->_validate_locations($locations);

			$dir = $this->_locate($slug);

			if(empty($dir)) return FALSE;

			require_once $dir.$slug."/".$slug."_module".EXT;

			$module_class = ucfirst($slug)."_Module";

			$module = new $module_class();

			$module_info = $module->get_info();

			return ($module->install() && 
					$this->modules_model->insert(
												array(
													'slug' 				=>	$slug, 
													'version'			=>	$module_info['version'], 
													'admin_menu_group'	=>	$module_info['admin_menu_group'], 
					        						'admin_menu'		=>	serialize($module_info['admin_menu']), 
													'is_system'			=>	(empty($module_info['is_system']) ? DB_FALSE : DB_TRUE), 
													'is_admin'			=>	(empty($module_info['is_admin']) ? DB_FALSE : DB_TRUE), 
													'is_frontend'		=>	(empty($module_info['is_frontend']) ? DB_FALSE : DB_TRUE), 
													'enabled' 			=>	DB_TRUE, 
												), 
												TRUE
											));

			return FALSE;
		}

		function uninstall($slug) {
			$slug = strtolower($slug);

			$dir = $this->_locate($slug, $this->_validate_locations($locations));

			if(empty($dir)) return FALSE;

			$m = $this->modules_model->get_by_slug($slug);
			if(empty($m) || $m['is_system'] == DB_TRUE) return FALSE;

			require_once $dir."/".$slug."/".$slug."_module".EXT;

			$module_class = ucfirst($slug)."_Module";

			$module = new $module_class();

			return ($module->uninstall() && 
					$this->modules_model->delete_by(array('slug' => $slug, )));
		}

		function deploy($zip_file, $module_path) {
			if(	empty($zip_file) || 
				!file_exists($zip_file) || 
				empty($module_path) || 
				!file_exists($module_path)) return FALSE;

			$unzip_dir = FCPATH.'public/uploads/modules/'.uniqid()."/";

			if(!file_exists($unzip_dir)) mkdir($unzip_dir, 0777, TRUE);

			$this->load->library('zip');

			$this->zip->unzip($zip_file, $unzip_dir);

			$objects = scandir($unzip_dir);
			foreach($objects as $object) {
				if($object != "." && $object != "..") {
					if(filetype($unzip_dir."/".$object) == "dir") {
						if(!$this->is_deployed($object)) rename($unzip_dir."/".$object, $module_path."/".$object);
						else return FALSE;
					}
				}
			}

			if(delete_files($unzip_dir, TRUE)) return TRUE;
			else return FALSE;
		}

		function undeploy($slug, $locations=NULL) {
			$slug = strtolower($slug);

			$dir = $this->_locate($slug, $this->_validate_locations($locations));
			if(!$dir) return FALSE;

			$m = $this->get_by_slug($slug);
			if(!empty($m) && $m['is_system'] == DB_TRUE) return FALSE;

			if(!$this->uninstall($slug)) return FALSE;

			if(delete_files($dir."/".$slug, TRUE)) return TRUE;
			else return FALSE;
		}

		function enable($slug, $enable=TRUE) {
			$slug = strtolower($slug);

			$m = $this->get_by_slug($slug);
			if(empty($m) || $m['is_system'] == DB_TRUE) return FALSE;

			return $this->modules_model->update_by(array('slug' => $slug, ), array('enabled' => ($enable ? DB_TRUE : DB_FALSE), ));
		}

		function is_deployed($slug, $locations=NULL) {
			$res = $this->_locate($slug);

			if(!empty($res)) return TRUE;
			else return FALSE;
		}

		function _locate($slug, $locations=NULL) {
			$locations = $this->_validate_locations($locations);

			foreach($locations as $dir) {
				if($dh = opendir($dir)) {
					while(($file = readdir($dh)) !== FALSE) {
						if(filetype($dir.$file) == "dir" && $file == $slug) {
							if(file_exists($dir.$file."/".$file."_module".EXT)) return $dir;
						}
					}
				}
				else return FALSE;
			}

			return FALSE;
		}

		function _validate_locations($locations) {
			if(empty($locations)) return $this->locations;
			elseif(is_string($locations)) return array($locations);
			elseif(is_array($locations)) return $locations;

			return FALSE;
		}
	}

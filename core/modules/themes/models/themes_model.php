<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Themes_model {
		protected $CI;

		public $_locations = null;

		function __construct() {
			$this->CI = & get_instance();

			$this->CI->load->model('settings/settings_model');

			$this->_locations = array(
									FCPATH.EXTPATH.'themes', 
									FCPATH.APPPATH."themes", 
								);
		}

		function get_all($type=NULL) {// 'frontend', 'admin'
			$result = array();

			$locations = $this->_validate_locations($this->_locations);

			foreach($locations as $dir) {
				if(file_exists($dir) &&	$dh = opendir($dir)) {
					while(($entry = readdir($dh)) !== FALSE) {
						if(filetype($dir."/".$entry) == "dir") {
							if(file_exists($dir."/".$entry."/".$entry."_theme".EXT)) {
								require_once $dir."/".$entry."/".$entry."_theme".EXT;

								$theme_class_name = ucfirst($entry)."_Theme";

								$theme = new $theme_class_name();

								$theme_info = $theme->get_info();

								if($type == "frontend") {
									if(empty($theme_info['admin_theme'])) {
										$def_theme = $this->CI->settings_model->get_by('name', 'frontend_theme');

										$result[] = array(
										        		'path'	=>	$dir, 
										        		'slug'	=>	$entry, 
										        		'info'	=>	$theme_info, 
										        		'is_default' => (!empty($def_theme) && $def_theme['value'] == $entry ? TRUE : FALSE), 
													);
									}
								}
								elseif($type == "admin") {
									if(!empty($theme_info['admin_theme'])) {
										$def_theme = $this->CI->settings_model->get_by('name', 'admin_theme');

										$result[] = array(
														'path'	=>	$dir, 
														'slug'	=>	$entry, 
														'info'	=>	$theme_info, 
														'is_default' => (!empty($def_theme) && $def_theme['value'] == $entry ? TRUE : FALSE), 
													);
									}
								}
								else {
									$result[] = array(
													'path'	=>	$dir, 
													'slug'	=>	$entry, 
													'info'	=>	$theme_info, 
												);
								}
							}
						}
					}

					closedir($dh);
				}
			}

			return $result;
		}

		function get_layouts($slug) {
			$slug = strtolower($slug);

			$res = array();

			$location = $this->_locate($slug);

			if($handle = opendir($location."/".$slug.'/layouts/')) {
				while(($file = readdir($handle)) !== FALSE) {
					if($file != "." && $file != "..") {
						if(is_file($location."/".$slug."/layouts/".$file)) $res[] = $file;
					}
				}

				closedir($handle);
			}

			return $res;
		}

		function deploy($theme_file, $theme_path) {
			$unpack_dir = FCPATH."public/uploads/themes/".uniqid()."/";

			if(!file_exists($unpack_dir)) mkdir($unpack_dir, 0777, TRUE);

			$this->CI->zip->unzip($theme_file, $unpack_dir);

			if($dh = opendir($unpack_dir)) {
				while(($file = readdir($dh)) !== FALSE) {
					if($file != '.' && $file != ".." &&	filetype($unpack_dir.$file) == "dir") {

						//parse and deploy theme dir
						if($th = opendir($unpack_dir.$file)) {
							while(($theme_dir = readdir($th)) !== FALSE) {
								if($theme_dir != '.' && $theme_dir != ".." && filetype($unpack_dir.$file."/".$theme_dir) == "dir") {
									if($theme_dir == "public") {
										//parse and deploy theme public dir

										if(file_exists(FCPATH."public/themes/".$file)) delete_files(FCPATH."public/themes/".$file, TRUE);
										mkdir(FCPATH."public/themes/".$file);

										if($tph = opendir($unpack_dir.$file."/".$theme_dir)) {
											while(($dir = readdir($tph)) !== FALSE) {
												if(	$dir != '.' && 
													$dir != ".." && 
													filetype($unpack_dir.$file."/".$theme_dir."/".$dir) == "dir") 
												{
													rename(
														$unpack_dir.$file."/".$theme_dir."/".$dir, 
														FCPATH."public/themes/".$file."/".$dir 
													);
												}
											}

											closedir($tph);
										}
									}
									elseif($theme_dir == "theme") {
										//parse and deploy theme's theme dir

										if(file_exists($theme_path."/".$file)) delete_files($theme_path."/".$file, TRUE);
										mkdir($theme_path."/".$file);

										if($tth = opendir($unpack_dir.$file."/".$theme_dir)) {
											while(($entry = readdir($tth)) !== FALSE) {
												if(	$entry != '.' && 
													$entry != "..") 
												{
													rename(
														$unpack_dir.$file."/".$theme_dir."/".$entry, 
														$theme_path."/".$file."/".$entry 
													);
												}
											}

											closedir($tth);
										}
									}
								}
							}

							closedir($th);
						}

					}
				}

				closedir($dh);
			}

			delete_files($unpack_dir, TRUE);

			return TRUE;
		}

		function delete($slug) {
			$slug = strtolower($slug);

			if($slug == 'default' || $slug == 'admin') return FALSE;

			$locations = $this->_validate_locations($this->_locations);

			$theme_path = $this->_locate($slug);

			if(delete_files(FCPATH."public/themes/".$slug, TRUE) &&	delete_files($theme_path."/".$slug, TRUE)) return TRUE;
			else return FALSE;
		}

		function _locate($slug, $locations=NULL) {
			$locations = $this->_validate_locations($locations);

			foreach($locations as $dir) {
				if($dh = opendir($dir)) {
					while(($entry = readdir($dh)) !== FALSE) {
						if(filetype($dir."/".$entry) == "dir" && $entry == $slug) {
							if(file_exists($dir."/".$entry."/".$entry."_theme".EXT)) return $dir;
						}
					}
				}
				else return FALSE;
			}

			return FALSE;
		}

		function _validate_locations($locations) {
			if(empty($locations)) return $this->_locations;
			elseif(is_string($locations)) return array($locations);
			elseif(is_array($locations)) return $locations;

			return FALSE;
		}
	}

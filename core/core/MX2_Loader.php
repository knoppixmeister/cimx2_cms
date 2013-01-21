<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	require APPPATH."third_party/MX/Loader.php";

	class MX2_Loader extends MX_Loader {
		function __construct() {
			parent::__construct();
		}
		/*
		function language($langfile, $idiom = NULL, $return = FALSE, $add_suffix = TRUE, $alt_path = '') {		
			if(empty($idiom)) $idiom = CURRENT_LANGUAGE_FOLDER;

			$segments 	= explode('/', $langfile);

			$file 		= array_pop($segments);
			$path 		= ltrim(implode('/', $segments).'/', '/');

			if(file_exists(EXTPATH."language/".$path.$idiom."/".$file."_lang".EXT)) {
				return CI::$APP->lang->load(
											$file.EXT, 
											$path.$idiom, 
											$return, 
											$add_suffix, 
											EXTPATH 
										);
			}
			elseif(	file_exists(APPPATH."/language/".$idiom."/".$file."/".$file."_lang".EXT) || 
					file_exists(APPPATH."/modules/".$path."/language/".$idiom."/".$file."_lang".EXT) || 
					file_exists(EXTPATH."/modules/".$path."/language/".$idiom."/".$file."_lang".EXT)) 
			{
				return parent::language($langfile, $idiom, $return, $add_suffix, $alt_path, $this->_module);
			}
			else return;
		}
		*/
		function helper($helper) {
			$this->_ci_helper_paths = array(EXTPATH, APPPATH, BASEPATH);

			parent::helper($helper);
		}

		function library($library = '', $params = NULL, $object_name = NULL) {
			$this->_ci_library_paths = array(EXTPATH, APPPATH, BASEPATH);

			return parent::library($library, $params, $object_name);
		}

		function _ci_load_class($class, $params = NULL, $object_name = NULL) {
			$class = str_replace('.php', '', trim($class, '/'));

			$subdir = '';
			if(($last_slash = strrpos($class, '/')) !== FALSE) {
				// Extract the path
				$subdir = substr($class, 0, $last_slash + 1);

				// Get the filename from the path
				$class = substr($class, $last_slash + 1);
			}

			// We'll test for both lowercase and capitalized versions of the file name
			foreach(array(ucfirst($class), strtolower($class)) as $class) {
				foreach(array(EXTPATH, APPPATH, ) as $subpath) {
					$subclass = $subpath.'libraries/'.$subdir.config_item('subclass_prefix').$class.'.php';

					// Is this a class extension request?
					if(file_exists($subclass)) {
						$baseclass = BASEPATH.'libraries/'.ucfirst($class).'.php';

						if(!file_exists($baseclass)) {
							log_message('error', "Unable to load the requested class: ".$class);
							show_error("Unable to load the requested class: ".$class);
						}

						// Safety:  Was the class already loaded by a previous call?
						if(in_array($subclass, $this->_ci_loaded_files)) {
							// Before we deem this to be a duplicate request, let's see
							// if a custom object name is being supplied.  If so, we'll
							// return a new instance of the object
							if(!is_null($object_name)) {
								$CI =& get_instance();
								if(!isset($CI->$object_name)) {
									return $this->_ci_init_class($class, config_item('subclass_prefix'), $params, $object_name);
								}
							}

							$is_duplicate = TRUE;
							log_message('debug', $class." class already loaded. Second attempt ignored.");

							return;
						}

						include_once($baseclass);
						include_once($subclass);
						$this->_ci_loaded_files[] = $subclass;

						return $this->_ci_init_class($class, config_item('subclass_prefix'), $params, $object_name);
					}
				}

				// Lets search for the requested library file and load it.
				$is_duplicate = FALSE;
				foreach($this->_ci_library_paths as $path) {
					$filepath = $path.'libraries/'.$subdir.$class.'.php';

					if(!file_exists($filepath)) continue ;

					// Safety:  Was the class already loaded by a previous call?
					if(in_array($filepath, $this->_ci_loaded_files)) {
						// Before we deem this to be a duplicate request, let's see
						// if a custom object name is being supplied.  If so, we'll
						// return a new instance of the object
						if(!is_null($object_name)) {
							$CI =& get_instance();
							if(!isset($CI->$object_name)) return $this->_ci_init_class($class, '', $params, $object_name);
						}

						$is_duplicate = TRUE;
						log_message('debug', $class." class already loaded. Second attempt ignored.");

						return;
					}

					include_once($filepath);
					$this->_ci_loaded_files[] = $filepath;

					return $this->_ci_init_class($class, '', $params, $object_name);
				}
			}

			// One last attempt.  Maybe the library is in a subdirectory, but it wasn't specified?
			if($subdir == '') {
				$path = strtolower($class).'/'.$class;

				return $this->_ci_load_class($path, $params);
			}

			// If we got this far we were unable to find the requested class.
			// We do not issue errors if the load call failed due to a duplicate request
			if ($is_duplicate == FALSE) {
				log_message('error', "Unable to load the requested class: ".$class);
				show_error("Unable to load the requested class: ".$class);
			}
		}
		
		function view($view, $vars = array(), $return = FALSE) {
			$segments 	= explode('/', $view);

			$file 		= array_pop($segments);
			$file_ext 	= strpos($file, '.') ? $file : $file.EXT;

			$path 		= ltrim(implode('/', $segments).'/', '/');

			if(is_file(EXTPATH."themes/".CURRENT_THEME."/views/".$path.$file_ext)) {
				$this->_ci_view_paths = array(EXTPATH."themes/".CURRENT_THEME."/views/" => TRUE)+$this->_ci_view_paths;
			}
			else {
				list($path, $_view) = Modules::find($view, $this->_module, 'views/');

				if($path != FALSE) {
					$this->_ci_view_paths = array($path => TRUE) + $this->_ci_view_paths;
					$view = $_view;
				}
			}

			return $this->_ci_load(array('_ci_view' => $view, '_ci_vars' => $this->_ci_object_to_array($vars), '_ci_return' => $return));
		}
	}

<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	require APPPATH."third_party/MX/Router.php";

	class MX2_Router extends MX_Router {
		function _validate_request($segments) {
			if(count($segments) == 0) return $segments;

			if(file_exists(EXTPATH.'config/languages.php')) require EXTPATH.'config/languages.php';
			else require APPPATH.'config/languages.php';

			if($config['lang_switch_method'] == 'url') {
				if(	!empty($segments[0]) && !in_array($segments[0], $config['ignore_lang_paths']) && 
					!in_array($segments[0], array('auth', 'users', ))) 
				{
					if(empty($segments[1]) || $segments[1] != 'admin') {
						array_shift($segments);
					}
				}

				if(count($segments) == 0) return $segments;
			}

			/* locate module controller */
			if($located = $this->locate($segments)) return $located;

			/* use a default 404_override controller */
			if(isset($this->routes['404_override']) AND $this->routes['404_override']) {
				$segments = explode('/', $this->routes['404_override']);

				if($located = $this->locate($segments)) return $located;
			}

			/* no controller found */
			show_404();
		}

		function _set_routing() {
			// Are query strings enabled in the config file?  Normally CI doesn't utilize query strings
			// since URI segments are more search-engine friendly, but they can optionally be used.
			// If this feature is enabled, we will gather the directory/class/method a little differently
			$segments = array();
			if(	config_item('enable_query_strings') === TRUE && 
				isset($_GET[config_item('controller_trigger')]))
			{
				if(isset($_GET[config_item('directory_trigger')])) {
					$this->set_directory(trim($this->uri->_filter_uri($_GET[config_item('directory_trigger')])));
					$segments[] = $this->fetch_directory();
				}

				if(isset($_GET[config_item('controller_trigger')])) {
					$this->set_class(trim($this->uri->_filter_uri($_GET[config_item('controller_trigger')])));
					$segments[] = $this->fetch_class();
				}

				if(isset($_GET[config_item('function_trigger')])) {
					$this->set_method(trim($this->uri->_filter_uri($_GET[config_item('function_trigger')])));
					$segments[] = $this->fetch_method();
				}
			}

			if(defined('ENVIRONMENT') && is_file(EXTPATH.'config/'.ENVIRONMENT.'/routes.php')) {
				require EXTPATH.'config/'.ENVIRONMENT.'/routes.php';
			}
			elseif(is_file(EXTPATH.'config/routes.php')) require EXTPATH.'config/routes.php';
			elseif(defined('ENVIRONMENT') AND is_file(APPPATH.'config/'.ENVIRONMENT.'/routes.php')) {
				require APPPATH.'config/'.ENVIRONMENT.'/routes.php';
			}
			elseif(is_file(APPPATH.'config/routes.php')) require APPPATH.'config/routes.php';

			$this->routes = ( ! isset($route) OR ! is_array($route)) ? array() : $route;
			unset($route);

			// Set the default controller so we can display it in the event
			// the URI doesn't correlated to a valid controller.
			$this->default_controller = (!isset($this->routes['default_controller']) || $this->routes['default_controller'] == '') ? FALSE : strtolower($this->routes['default_controller']);

			// Were there any query string segments?  If so, we'll validate them and bail out since we're done.
			if(count($segments) > 0) return $this->_validate_request($segments);

			// Fetch the complete URI string
			$this->uri->_fetch_uri_string();

			// Is there a URI string? If not, the default controller specified in the "routes" file will be shown.
			if($this->uri->uri_string == '') return $this->_set_default_controller();

			// Do we need to remove the URL suffix?
			$this->uri->_remove_url_suffix();

			// Compile the segments into an array
			$this->uri->_explode_segments();

			// Parse any custom routing that may exist
			$this->_parse_routes();

			// Re-index the segment array so that it starts with 1 rather than 0
			$this->uri->_reindex_segments();
		}

		function set_class($class) {
			$this->class = $class.config_item('controller_suffix');
		}
	}

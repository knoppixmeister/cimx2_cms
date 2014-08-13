<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Events {
		protected static $_listeners = array();

		function __construct(){
			self::_load_modules();
		}

		private static function _load_modules() {
			$CI = &get_instance();

			$is_system = TRUE;

			$CI->load->model('modules/modules_model');

			if(!$results = $CI->modules_model->get_all()) return FALSE;

			foreach($results as $r) {
				if(!$details_class = self::_spawn_class($r['slug'], !empty($r['info']['is_system']) ? $r['info']['is_system'] : false)) continue;
			}

			return TRUE;
		}

		private static function _spawn_class($slug, $is_system = FALSE) {
			$path = $is_system ? APPPATH : EXTPATH;

			$events_file = $path.'modules/'.$slug.'/events'.EXT;

			if(!is_file($events_file)) return FALSE;

			include_once $events_file;

			$class = ucfirst(strtolower($slug))."_events";

			return class_exists($class) ? new $class : FALSE;
		}

		static function register($event, array $callback) {
			$key = get_class($callback[0]).'::'.$callback[1];
			self::$_listeners[$event][$key] = $callback;

			log_message('debug', 'Events::register() - Registered "'.$key.' with event "'.$event.'"');
		}

		static function trigger($event, $data = '', $return_type = 'string') {
			log_message('debug', 'Events::trigger() - Triggering event "'.$event.'"');

			$calls = array();

			if(self::has_listeners($event)) {
				foreach(self::$_listeners[$event] as $listener) {
					if(is_callable($listener)) $calls[] = call_user_func($listener, $data);
				}
			}

			return self::_format_return($calls, $return_type);
		}

		protected static function _format_return(array $calls, $return_type) {
			log_message('debug', 'Events::_format_return() - Formating calls in type "'.$return_type.'"');

			switch($return_type) {
				case 'array':		return $calls;
									break;
				case 'json':		return json_encode($calls);
									break;
				case 'serialized':	return serialize($calls);
									break;
				case 'string':		$str = '';
									foreach($calls as $c) {
										$str .= $c;
									}

									return $str;

									break;
				default:			return $calls;
									break;
			}

			return NULL;
		}

		static function has_listeners($event) {
			log_message('debug', 'Events::has_listeners() - Checking if event "'.$event.'" has listeners.');

			if(isset(self::$_listeners[$event]) && count(self::$_listeners[$event]) > 0) return TRUE;

			return FALSE;
		}
	}

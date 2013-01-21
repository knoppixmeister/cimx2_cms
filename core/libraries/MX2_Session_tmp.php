<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class MX2_Session {
		function __construct($params = array()) {	
			ob_start();

			session_start();
		}

		function __call($method, $params = array()) {
			Debug::dump($method, $params);
		}

		function set_userdata($name, $value = "") {
			if(is_array($name)) {
				foreach($name as $k => $v) {
					$_SESSION[(string)$k] = $v;
				}
			}
			else {
				$_SESSION[$name] = $value;
			}
		}

		function unset_userdata($name) {
			if(isset($_SESSION[$name])) unset($_SESSION[$name]);
		}

		function userdata($item) {
			return isset($_SESSION[$item]) ? $_SESSION[$item] : NULL;
		}

		function flashdata($item) {
			return NULL;
		}

		function set_flashdata($item, $data) {
			
		}
	}

<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Tag {
		protected $attributes = array(); 

		static function locate_tag($slug) {
		}

		function set_attributes($data=array()) {
			$this->attributes =	array_merge($this->attributes, $data);
		}

		function get_attribute($key, $default=NULL) {	
			return (!empty($this->attributes[$key]) ? $this->attributes[$key] : $default);
		}

		function set_attribute($key, $value) {
			$this->attributes[$key] = $value;
		}

		function __get($key) {
			$CI = &get_instance();

			return $CI->$key;
		}
	}

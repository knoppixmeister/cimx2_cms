<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Settings_model extends MX2_Model {
		protected $_settings = array();

		function __construct() {
			parent::__construct();

			foreach(parent::get_all() as $s) {
				$this->_settings[$s['name']] = $s['value'];
			}
		}

		function __get($key) {
			if(isset($this->_settings[$key])) return $this->_settings[$key];
			else {
				$CI =& get_instance();

				return $CI->$key;
			}
		}
	}

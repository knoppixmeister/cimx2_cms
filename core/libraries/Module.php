<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	abstract class Module {
		function __construct() {
			$this->load->dbforge();

			log_message('debug', "Module Class Initialized");
		}

		abstract function get_info();

		abstract function install();

		abstract function uninstall();

		function __get($key) {
			$CI = & get_instance();

			return $CI->$key;
		}
	}

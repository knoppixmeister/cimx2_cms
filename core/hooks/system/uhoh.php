<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	function load_exceptions() {
		define('ABS_APPPATH', realpath(APPPATH) . '/');

		if(CI_VERSION >= '2.0') {
			define('ABS_SYSDIR', realpath(SYSDIR) . '/');

			load_class('Exceptions', 'core');		
		}
		else {
			define('ABS_SYSDIR', realpath(BASEPATH) . '/');

			load_class('Exceptions');
		}
	}

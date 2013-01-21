<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Modules_events {
		function __construct() {
			Events::register('module_uploaded', array($this, 'module_uploaded'));
			Events::register('module_installed', array($this, 'module_installed'));
		}

		function module_uploaded($module_data) {
		}

		function module_installed($module_data) {			
		}
	}

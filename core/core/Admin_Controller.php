<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Admin_Controller extends MX2_Controller {
		function __construct() {
			parent::__construct();

			$t = system_get_setting('admin_theme');

			if(empty($t)) show_error("Default admin theme is not set");

			define('ADMIN_THEME', $t);

			define('CURRENT_THEME', ADMIN_THEME);

			$this->template->add_theme_location(FCPATH.APPPATH.'themes/')
							->set_theme(CURRENT_THEME)
							->set_layout('login.php');
		}
	}

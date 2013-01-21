<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Admin_Auth_Controller extends MX2_Controller {
		function __construct() {
			parent::__construct();

			$u = $this->session->userdata('user');
			if(empty($u)) redirect(admin_url('login', TRUE));
			else {
				$this->data['user'] = $this->users_model->get($u);

				if($this->data['user']['role_id'] != 1) show_404();
			}

			$t = system_get_setting('admin_theme');

			if(empty($t)) show_error("Default admin theme is not set");

			define('ADMIN_THEME', $t);

			define('CURRENT_THEME', ADMIN_THEME);

			$this->template->add_theme_location(FCPATH.APPPATH.'themes/')
							->add_theme_location(FCPATH.EXTPATH.'themes/')
							->set_theme(ADMIN_THEME)
							->set_layout('default.php');
		}

		function index() {
			$this->template->build($this->data['module']."/admin/index", $this->data);
		}
	}

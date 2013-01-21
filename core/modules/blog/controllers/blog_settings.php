<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Blog_settings extends Admin_Auth_Controller {
		function __construct() {
			parent::__construct();
		}

		function index() {
			if(!$this->form_validation->run('blog_settings/index')) {
				$this->data['title'] = "Blog settings";

				$this->template->build('blog/admin/settings/index', $this->data);
			}
			else {
				foreach(config_item('blog_settings/index') as $f) {
					$this->blog_settings_model->save_setting($f['field'], get_post($f['field']));
				}

				$this->session->set_flashdata('success_msg', "Blog settings saved");

				redirect(admin_url('blog/settings'));
			}
		}
	}

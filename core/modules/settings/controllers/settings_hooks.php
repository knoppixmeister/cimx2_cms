<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Settings_hooks extends Admin_Auth_List_Controller {
		function __construct() {
			parent::__construct();

			$this->load->model('hooks_model');
		}

		function index() {
			$this->data['items'] = $this->hooks_model->get_all();

			//Debug::dump($this->data['items']);

			$this->template->build('settings/admin/hooks/index', $this->data);
		}

		function edit() {
		}

		function delete() {
			
			
			header("Location: ".base_url()."admin/".$this->data['module']."/hooks");
		}
	}

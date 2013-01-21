<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Users extends Frontend_Controller {
		function __construct() {
			parent::__construct();
		}

		function view($username=NULL) {
			//if(!is_numeric($id)) show_404();

			$this->data['user_data'] = $this->users_model->get_by('username', $username);

			if(empty($this->data['user_data'])) show_404();

			$this->template->build('users/view', $this->data);
		}

		function edit() {
			$u = $this->session->userdata('user');
			if(empty($u) || !is_numeric($u)) redirect('login');
			else $this->data['user'] = $this->users_model->get($u);

			$this->template->build('users/edit', $this->data);
		}
	}

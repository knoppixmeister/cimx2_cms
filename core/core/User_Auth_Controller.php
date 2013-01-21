<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class User_Auth_Controller extends Frontend_Controller {
		function __construct() {
			parent::__construct();

			$u = $this->session->userdata('user');
			if(empty($u) || !is_numeric($u)) redirect('login');
			else {
				$this->data['user'] = $this->users_model->get($u);

				if(empty($this->data['user'])) {
					$this->session->unset_userdata('user');

					redirect('login');
				}
			}
		}
	}

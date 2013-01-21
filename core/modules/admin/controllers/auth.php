<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Auth extends Admin_Controller {
		function __construct() {
			parent::__construct();
		}

		function login() {
			$u = $this->session->userdata('user');
			if(!empty($u)) redirect(admin_url('', TRUE));

			if(!$this->form_validation->run('admin/auth/login')) {
				$this->template->build('admin/admin/auth/login');
			}
			else {
				$u = $this->users_model->get_by('username', get_post('username', TRUE));

				$this->session->set_userdata('user', $u['id']);

				redirect(admin_url('', TRUE));
			}
		}

		function logout() {
			$this->session->unset_userdata('user');

			redirect(admin_url('', TRUE));
		}

		function _admin_auth_check($password) {
			$u = $this->users_model->get_by(
										array(
											'username' 	=>	get_post('username'), 
											'password' 	=>	md5($password), 
											'role_id' 	=>	1, 
											'status'	=>	'active', 
											'activated'	=>	DB_TRUE, 
										)
									);

			if(empty($u)) {
				$this->form_validation->set_message(
											__FUNCTION__, 
											'Wrong username or password' 
										);

				return FALSE;
			}

			return TRUE;
		}
	}

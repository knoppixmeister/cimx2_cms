<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Auth extends Frontend_Controller {
		function __construct() {
			parent::__construct();
		}

		function login() {
			$this->data['title'] 	=	lang('auth_signin');

			$this->data['next']		=	urldecode(get_post('next', TRUE));

			$s = system_get_setting('allow_auth');
			if(empty($s) || $s == DB_FALSE) show_404();

			$u = $this->session->userdata('user');
			if(!empty($u)) {
				if(!empty($this->data['next'])) header("Location: ".$this->data['next']);
				else redirect('');
			}

			$identifier = array();

			$s = system_get_setting('login_by');
			if(empty($s) || $s == "email") {
				$identifier[] = array(
									'field' =>	'user_id', 
									'label' =>	lang('auth_email'), 
									'rules' =>	'required|trim|xss_clean|strtolower|valid_email', 
								);
			}
			else {
				if($s == "username") {
					$identifier[] = array(
										'field' =>	'user_id', 
										'label' =>	lang('auth_username'), 
										'rules' =>	'required|trim|xss_clean|strtolower', 
									);
				}
				elseif($s == "both") {
					$identifier[] = array(
										'field' =>	'user_id', 
										'label' =>	lang('auth_both'), 
										'rules' =>	'required|trim|xss_clean|strtolower', 
									);
				}
			}

			$this->data['auth_type'] = $s;

			$checks = array_merge($identifier, array(
													array(
														'field'	=>	'password', 
														'label'	=>	lang('auth_password'), 
														'rules'	=>	'required|trim|xss_clean|callback__user_auth_check['.$s.']', 
													), 
													array(
														'field'	=>	'remember_me', 
														'label'	=>	lang('auth_remember_me'), 
														'rules'	=>	'xss_clean', 
													), 
													array(
														'field'	=>	'next', 
														'label'	=>	'', 
														'rules'	=>	'xss_clean', 
													), 
												)
										);

			$this->form_validation->set_rules($checks);

			if(!$this->form_validation->run()) {
				$this->template->build('auth/login', $this->data); 
			}
			else {
				if($s == 'both') show_404();

				$u = $this->users_model->get_by(array($s => get_post('user_id', TRUE), ));

				$remember_me = get_post('remember_me', TRUE);		
				if(!empty($remember_me)) $this->session->sess_expire_on_close = FALSE;
				else $this->session->sess_expire_on_close = TRUE;

				$this->session->set_userdata('user', $u['id']);

				if(!empty($this->data['next'])) header("Location: ".$this->data['next']);
				else redirect('');
			}
		}

		function signin() {
			$this->login();
		}

		function logout() {
			$this->data['next'] = urldecode(get_post('next', TRUE));

			$this->session->unset_userdata('user');

			if(!empty($this->data['next'])) {
				header("Location: ".$this->data['next']);
				die();
			}
			else redirect('');
		}

		function signout() {
			$this->logout();
		}

		function register() {
			$s = system_get_setting('allow_register');
			if(empty($s) || $s == DB_FALSE) show_404();

			$this->data['title'] = lang('auth_register');

			$this->data['next'] = get_post('next', TRUE);

			if(!$this->form_validation->run('auth/register')) {
				$this->template->build('auth/register', $this->data);
			}
			else {
				$code = md5(uniqid().time().get_post('email').get_post('username'));

				$u = $this->users_model->insert(
											array(
												'first_name'		=>	get_post('first_name'), 
												'last_name'			=>	get_post('last_name'), 
												'username' 			=>	get_post('username'), 
												'password' 			=>	md5(get_post('password', TRUE)), 
												'email' 			=>	get_post('email'), 
												'role_id' 			=>	2, 
												'status' 			=>	'active', 
												'created_time' 		=>	time(), 
												'activation_code'	=>	$code, 
												'ip'				=>	$_SERVER['REMOTE_ADDR'], 
											), 
											TRUE 
										);
				if($u) {
					//upadate user info.
					$u = $this->users_model->get($u);//DON'T DELETE THIS.

					if(Events::trigger('user_register_email_send', $u)) {
						if(!empty($this->data['next'])) header("Location: ".$this->data['next']);
						else {
							$this->session->set_flashdata('msg', lang('auth_register_success'));

							redirect('register');
						}
					}
					else {
						log_message('error', 'Could not send activation e-mail.');

						show_error("Could not send activation e-mail. Error logged.");
					}
				}
				else {
					log_message('error', 'Could not write user data into DB.');

					show_error("Could not write user data into DB. Error logged.");
				}
			}
		}

		function forgot_password() {
			$s = system_get_setting('allow_auth');
			if(empty($s) || $s == DB_FALSE) show_404();

			$this->data['title'] = lang('auth_password_retrieval');

			if(!$this->form_validation->run('auth/forgot_password')) {
				$this->data['title'] = lang('auth_forgot_password');

				$this->template->build('auth/forgot_password', $this->data);
			}
			else {
				$u = $this->users_model->get_by('email', get_post('email', TRUE));

				$code = md5($u['id'].time().uniqid());

				$this->users_model->update($u['id'], array('reset_code' => $code, ), TRUE);

				//update user data with reset code
				$u = $this->users_model->get_by('email', get_post('email', TRUE));//DON'T DELETE THIS.

				/*
				* [Love This Tune] Your new password
				*
				*
				* 	Username: proba3
				Password: V)&UU4Ft#2mL
				http://www.lovethistune.com/wp-login.php
				*/

				if(Events::trigger('forgot_password_email_send', $u)) {
					$this->session->set_flashdata('msg', lang('auth_check_email_link'));

					redirect('auth/forgot_password');
				}
				else {
					log_message('error', 'Could not send password reset e-mail.');

					show_error("Could not send password reset e-mail. Error logged.");
				}
			}
		}

		function activate($code=NULL) {
			$s = $this->settings_model->get_by('name', 'allow_auth');
			if(empty($s) || $s['value'] == DB_FALSE) show_404();

			if(!empty($code)) {
				if(!$this->_activation_code_check($code)) {
					$this->data['msg'] = lang('auth_activation_error');

					$this->template->build('auth/activate', $this->data);
				}
				else {
					$u = $this->users_model->get_by('activation_code', $code);

					$this->users_model->update($u['id'], array('activated' => DB_TRUE, ), TRUE);

					$this->session->set_flashdata('msg', lang('auth_activate_success'));

					redirect("login");
				}
			}
			else {
				if(!$this->form_validation->run('auth/activate')) {
					$this->template->build('auth/activate', $this->data);
				}
				else {
					$u = $this->users_model->get_by('activation_code', get_post('code'));

					$this->users_model->update($u['id'], array('activated' => DB_TRUE, ), TRUE);

					$this->session->set_flashdata('msg', lang('auth_activate_success'));

					redirect('login');
				}
			}
		}

		function password_reset($code=NULL) {
			if(empty($code)) redirect("");

			if(!$this->_reset_code_check($code)) redirect("login");

			if(!$this->form_validation->run('auth/password_reset')) {
				$this->data['code'] = $code;

				$this->data['title'] = lang('auth_password_change');

				$this->template->build('auth/password_reset', $this->data);
			}
			else {
				$this->users_model->update_by(
										array('reset_code' => $code), 
										array(
											'reset_code'	=>	NULL, 
											'password'		=>	md5(get_post('password', TRUE)), 
										)
									);

				$this->session->set_flashdata('msg', lang('auth_password_changed'));

				redirect('login');
			}
		}

		function check_data() {
			if(!is_ajax()) redirect("");

			header('Content-Type: application/json');

			$type = get_post('type', TRUE);
			$data = get_post('data', TRUE);

			$type = strtolower($type);

			if($type == "email") {
				if(valid_email($data)) {
					$u = $this->users_model->get_by('email', $data);

					if($u) e(json_encode(array('status' => 'ok', 'message' => 'user exist', )));
					else e(json_encode(array('status' => 'err', 'message' => 'user does not exist', )));
				}
				else e(json_encode(array('status' => 'err', 'message' => 'wrong e-mail format', )));
			}
			elseif($type == "username") {
				$username = strtolower($data);

				$u = $this->users_model->get_by('username', $username);

				if($u) e(json_encode(array('status' => 'ok', 'message' => 'user exist', )));
				else e(json_encode(array('status' => 'err', 'message' => 'user does not exist', )));
			}
			else e(json_encode(array('status' => 'err', 'message' => '', )));
		}

		function _user_auth_check($password, $type) {
			$user_id = get_post('user_id', TRUE);

			if($type == "username") $get_by = array('username' => $user_id, );
			elseif($type == "email") $get_by = array('email' => $user_id, );
			elseif($type == "both") {
				//TODO: 
			}
			else {
				$this->form_validation->set_message(__FUNCTION__, 'wrong auth type');

				return FALSE;
			}

			$get_by = array_merge($get_by, 	array(
												'password'	=>	md5($password), 
												'status'	=>	'active', 
												'activated'	=>	DB_TRUE, 
											)
								);

			if(!$this->users_model->get_by($get_by)) {
				$this->form_validation->set_message(
											__FUNCTION__, 
											str_replace(
												':user_id:', 
												lang('auth_'.$type), 
												lang('auth_wrong_user_id_or_password') 
											)  
										);

				return FALSE;
			}

			return TRUE;
		}

		function _username_uniq_check($username) {
			$u = $this->users_model->get_by('username', $username);
			if(!empty($u)) {
				$this->form_validation->set_message(
											__FUNCTION__, 
											lang('auth_username_exist')	//'Sorry, that username already exists!'
										);

				return FALSE;
			}
			else return TRUE;
		}

		function _email_uniq_check($email) {
			$u = $this->users_model->get_by('email', $email);
			if(!empty($u)) {
				$this->form_validation->set_message(
											__FUNCTION__, 
											lang('auth_email_exist')//'Sorry, that email address is already used!'
										);

				return FALSE;
			}

			return TRUE;
		}

		function _email_exists_check($email) {
			$u = $this->users_model->get_by('email', $email);
			if(empty($u)) {
				$this->form_validation->set_message(
											__FUNCTION__, 
											lang('auth_email_no_user')//'ERROR: There is no user registered with that email address.'
										);

				return FALSE;
			}

			return TRUE;
		}

		function _activation_code_check($code) {
			$u = $this->users_model->get_by(
										array(
											'activation_code' 	=>	$code, 
											'activated' 		=>	DB_FALSE, 
											'email'				=>	get_post('email'), 
										)
									);
			if(empty($u)) {
				$this->form_validation->set_message(
											__FUNCTION__, lang('auth_activation_error') 
										);

				return FALSE;
			}

			return TRUE;
		}

		function _reset_code_check($code) {
			$u = $this->users_model->get_by('reset_code', $code);
			if(empty($u)) {
				$this->form_validation->set_message(
											__FUNCTION__, 
											lang('auth_wrong_reset_code') 
										);

				return FALSE;
			}

			return TRUE;
		}
	}

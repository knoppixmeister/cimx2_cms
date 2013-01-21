<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Admin extends Admin_Auth_List_Controller {
		function __construct() {
			parent::__construct();

			$this->load->helper(array('email', ));

			$this->load->model(
							array(
								'themes/themes_model', 
								'settings/settings_model', 
							)
						);
		}

		function index() {
			$this->form_validation->set_rules('frontend_opened', 	'Frontend opened',	'');
			$this->form_validation->set_rules('login_by', 			'Login By',			'required|trim');
			$this->form_validation->set_rules('admin_email', 		'Administrator e-mail',	'required|trim|valid_email');

			$this->form_validation->set_rules('default_user_role', 	'Default user role', 'required|numeric');

			$this->form_validation->set_rules('admin_theme', 		'Admin Theme',		'required|trim');

			if(!$this->form_validation->run()) {
				$themes = $this->themes_model->get_all('admin');

				$this->data['admin_themes'] = array();
				foreach($themes as $t) {
					$this->data['admin_themes'][$t['slug']] = $t['slug'];
				}

				$this->data['items'] = array();
				foreach($this->settings_model->get_all() as $s) {
					$this->data['items'][$s['name']] = $s['value'];
				}

				$this->data['title'] = "Settings";

				$this->template->build('settings/admin/index', $this->data);
			}
			else {
				$fe = get_post('frontend_opened');
				$fe	= !empty($fe) ? DB_TRUE : DB_FALSE;

				$data = array(
							'site_name'				=>	get_post('site_name'), 
							'admin_email'			=>	get_post('admin_email'), 
							'frontend_opened'		=>	$fe, 
							'date_format'			=>	get_post('date_format'), 
							'time_format'			=>	get_post('time_format'), 
							'items_per_page'		=>	get_post('items_per_page'), 
							"login_by"				=>	get_post('login_by'), 
							'allow_auth'			=>	get_post('allow_auth'), 
							'allow_register'		=>	get_post('allow_register'), 
							'default_user_role'		=>	get_post('default_user_role'), 
							'emailer_type'			=>	get_post('emailer_type'), 
							'emailer_send_from'		=>	get_post('emailer_send_from'), 
							"emailer_mailpath"		=>	get_post('emailer_mailpath'), 
							"emailer_smtp_server" 	=>	get_post('emailer_smtp_server'), 
							"emailer_smtp_port"		=>	get_post('emailer_smtp_port'), 
							"emailer_smtp_user"		=>	get_post('emailer_smtp_user'), 
							"emailer_smtp_pass"		=>	get_post('emailer_smtp_pass'), 
							"emailer_smtp_timeout" 	=>	get_post('emailer_smtp_timeout'), 
							"emailer_newline"		=>	get_post('emailer_newline'), 
							"admin_theme"			=>	get_post('admin_theme'), 
							"allowed_ip"			=>	'', 
							"allowed_domain"		=>	'', 
						);

				foreach($data as $k => $v) {
					$param = $this->settings_model->get_by('name', $k);
					if(empty($param)) {
						$this->settings_model->insert(array('name' => $k, 'value' => $v, ), TRUE);
					}
					else $this->settings_model->update_by(array('name' => $k, ), array('value' => $v, ));
				}

				$this->session->set_flashdata('success_msg', 'Settings saved');

				redirect(admin_url('settings'));
			}
		}

		function test_email() {
			if(!$this->input->is_ajax_request()) redirect(admin_url('settings', TRUE));

			$this->load->helper('settings/settings');

			$email = get_post('email');

			header("Content-Type: text/javascript; charset=utf-8");

			if(valid_email($email)) {
				$config['newline'] = "\r\n";

				$this->email->initialize($config)
							->from(system_get_setting('emailer_send_from'))
							->to($email)
							->subject(system_get_setting("site_name").' Test email')
							->message('Test e-mail message. <pre>'.print_r($this->email, TRUE)."</pre>");

				if(@$this->email->send()) {
					e(json_encode(array('status' => 'ok', 'message' => 'E-mail test success', )));
				}
				else e(json_encode(
							array(
								'status'	=>	'error', 
								'message'	=>	'Could not sent email.<br/>'.$this->email->print_debugger(), 
							)
						));

				$this->email->clear(TRUE);
			}
			else e(json_encode(array('status' => 'error', 'message' => 'Wrong e-mail format', )));
		}
	}

<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Contacts extends Frontend_Controller {
		public function __construct() {
			parent::__construct();

			$this->load->model('pages/pages_model');

			$this->load->library('email');

			//$this->load->config('recaptcha/recaptcha');
			//$this->load->library('recaptcha/recaptcha/recaptcha', config_item('recaptcha'));
		}

		public function index() {
			$this->data['meta_title'] = lang("contacts_contacts")." ".lang("contacts_contacts_form");

			if(!$this->form_validation->run()) {
				$this->template->build('contacts/index', $this->data);
			}
			else {
				$this->contacts_model->insert(
											array(
												'name'			=>	get_post('full_name', TRUE), 
												'email'			=>	get_post('email', TRUE), 
												'phone'			=>	get_post('phone', TRUE), 
												'subject'		=>	get_post('subject', TRUE), 
												'text'			=>	get_post('text', TRUE), 
												'ip'			=>	$_SERVER['REMOTE_ADDR'], 
												'created_time'	=>	time(), 
											), 
											TRUE 
										);

				$e = system_get_setting('admin_email');
				if(empty($e)) {
					log_message('error', 'Site administrator e-mail did not set');

					show_error('Error: contacts_2001. Error logged!');
				}

				//foreach(config_item('contacts_send_contacts_to') as $e) {
				$config['newline']    	= "\r\n";

				$this->data['full_name'] 	=	get_post('full_name', TRUE);
				$this->data['email'] 		=	get_post('email', TRUE);
				$this->data['subject']		=	get_post('subject', TRUE);
				$this->data['phone']		=	get_post('phone', TRUE);
				$this->data['text']			=	get_post('text', TRUE);

				$this->email->initialize($config)
							->from(system_get_setting('emailer_send_from'))//config_item("contacts_send_email_from")
							->to($e)
							->reply_to(
								get_post('email', TRUE), 
								get_post('full_name', TRUE) 
							)
							->subject('Contact form filled on '.base_url())
							->message($this->load->view('contacts/letter/index', $this->data, TRUE));

				if(@!$this->email->send()) {
					log_message('error', 'Could not send contacts e-mail. '.$this->email->print_debugger());

					show_error('Could not send message. Error logged!');
				}

				//$this->email->clear(TRUE);
				//}

				$this->session->set_flashdata('success_msg', lang('contacts_thank_you_for_email'));

				redirect('contacts');
			}
		}

		function _recaptcha_check($value) {
			if(!$this->recaptcha->check_respond()) {
				$this->form_validation->set_message(
											__FUNCTION__, 
											'Wrong recaptcha value'
										);

				return FALSE;
			}

			return TRUE;
		}
	}

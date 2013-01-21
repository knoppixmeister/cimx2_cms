<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Contacts_settings extends Admin_Auth_Controller {
		function __construct() {
			parent::__construct();
		}

		function index() {
			if(!$this->form_validation->run()) {
				$this->data['title'] = "Contacts settings";

				$this->data['send_from'] = config_item('contacts_send_email_from');

				$this->data['send_to'] = "";
				foreach(config_item('contacts_send_contacts_to') as $to) {
					$this->data['send_to'] .= $to."\r\n";
				}

				$this->template->build('contacts/admin/settings/index', $this->data);
			}
			else {

				$this->session->set_flashdata('success_msg', 'Data saved.');

				redirect(admin_url('contacts/settings'));
			}
		}
	}

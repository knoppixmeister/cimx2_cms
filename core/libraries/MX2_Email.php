<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class MX2_Email extends CI_Email {
		function __construct($config=array()) {
			parent::__construct();

			$this->load->model('settings/settings_model');

			$this->mailtype		= "html";
			$this->protocol 	= $this->settings_model->emailer_type;			// mail/sendmail/smtp
			$this->smtp_host	= $this->settings_model->emailer_smtp_server;	// SMTP Server.  Example: mail.earthlink.net
			$this->smtp_user	= $this->settings_model->emailer_smtp_user;		// SMTP Username
			$this->smtp_pass	= $this->settings_model->emailer_smtp_pass;		// SMTP Password
			$this->smtp_port	= $this->settings_model->emailer_smtp_port;		// SMTP Port
			$this->smtp_timeout	= $this->settings_model->emailer_smtp_timeout;	// SMTP Timeout in seconds
			$this->newline		= "\r\n";
		}

		function __get($key) {
			$CI = & get_instance();

			return $CI->$key;
		}
	}

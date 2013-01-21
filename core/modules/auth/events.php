<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Auth_events {
		protected $CI;

		function __construct() {
			$this->CI = &get_instance();

			$this->CI->load->helper('settings/settings');

			Events::register('forgot_password_email_send', array($this, 'forgot_password_email_send'));
			Events::register('user_registered_email_send', array($this, 'user_registered_email_send'));
		}

		function forgot_password_email_send($u) {
			$msg = "Hi!<br/>
					<br/>
					Someone has asked to reset the password for the following site and username.<br/>
					<br/>
					".base_url()."<br/>
					<br/>
					Username: ".$u['username']."<br/>
					<br/>
					To reset your password visit the following address, otherwise just ignore this email and nothing 
					will happen.<br/>
					<br/>
					".site_url('auth/password_reset/'.$u['reset_code'], TRUE);

			$config['newline'] = "\r\n";

			$this->CI->email->initialize($config)
							->from(system_get_setting('emailer_send_from'))
							->to($u['email'])
							->subject(system_get_setting('site_name').' - Password Reset')
							->message($msg);

			if(@$this->CI->email->send()) return TRUE;
			else {
				log_message('error', 'Could not send forgotten password email. '.$this->CI->email->print_debugger());

				return FALSE;
			}
		}

		function user_register_email_send($user) {
			$msg = 'Thank you for registering at '.system_get_setting('site_name').'
					Before we can activate your account, please complete the registration process by clicking on 
					the following link:<br/>
					<br/>
					<a href="'.site_url('auth/activate/'.$user['activation_code']).'">'.site_url('auth/activate/'.$user['activation_code']).'</a><br/>
					<br/>
					In case your email program does not recognize the above link as, 
					please direct your browser to the following URL and enter the activation code:<br/>
					<br/>
					<a href="'.site_url('auth/activate/').'">'.site_url('auth/activate').'</a><br/>
					<br/>
					E-mail: '.$user['email'].'<br/>
					Activation code: '.$user['activation_code'].'<br/>
					<br/>
					<br/>
					'.system_get_setting('site_name');//TODO: add site name here or remake e-mail to managed e-email templates

			$config['newline'] = "\r\n";

			$this->CI->email->initialize($config)
							->from(system_get_setting('emailer_send_from'))
							->to($user['email'])
							->subject(system_get_setting('site_name').' - Account Activation')
							->message($msg);

			if(@$this->CI->email->send()) return TRUE;
			else {
				log_message('error', $this->CI->email->print_debugger());

				return FALSE;
			}
		}
	}

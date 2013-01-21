<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	$config = 	array(
					'contacts/index' => array(
						array(
							'field'	=>	'full_name', 
							'label' =>	'lang:contacts_your_name', 
							'rules' =>	'required|trim|xss_clean', 
						), 
						array(
							'field'	=>	'email', 
							'label' =>	'lang:contacts_email', 
							'rules' =>	'required|trim|xss_clean|strtolower|valid_email', 
						), 
						array(
							'field'	=>	'phone', 
							'label' =>	'lang:contacts_phone', 
							'rules' =>	'required|trim|strtolower|xss_clean', 
						), 
						array(
							'field'	=>	'subject', 
							'label' =>	'lang:contacts_subject', 
							'rules' =>	'required|trim|xss_clean', 
						), 
						array(
							'field'	=>	'text', 
							'label' =>	'lang:contacts_message_text', 
							'rules' =>	'required|trim|xss_clean', 
						), 
						/*
						array(
							'field'	=>	'recaptcha_response_field', 
							'label' =>	'lang:contacts_check_code', 
							'rules' =>	'required|callback__recaptcha_check', 
						), 
						*/
					), 
					'contacts_settings/index' => 	array(
						array(
							'field'	=>	'send_from', 
							'label' =>	'Send messages from', 
							'rules' =>	'required|trim|xss_clean|valid_email', 
						), 
						array(
							'field'	=>	'send_to',
							'label' =>	'Send messages to',
							'rules' =>	'required|trim|xss_clean',
						), 
					), 
				);

<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class MX2_Form_validation extends CI_Form_validation {
		public $CI;

		function __construct($rules = array()) {
			parent::__construct($rules);
		}

		function run($group = '') {
			if(empty($_POST) ||	count($_POST) == 0) return FALSE;

			if(count($this->_field_data) == 0) {
				if(count($this->_config_rules) == 0) {
					$module = $this->CI->router->fetch_module();

					$res = Modules::find('form_validation', $module, 'config/');
					if($res[0] === FALSE) {
						log_message('error', 'No form validation rules anywhere. Module: '.$module);

						return FALSE;
					}

					$this->_config_rules = $this->CI->load->config($module.'/form_validation', TRUE);
				}
				
				// Is there a validation rule for the particular URI being accessed?
				$uri = ($group == '') ? trim($this->CI->uri->ruri_string(), '/') : $group;

				if($uri != '' AND isset($this->_config_rules[$uri])) {
					$this->set_rules($this->_config_rules[$uri]);
				}
				else $this->set_rules($this->_config_rules);

				// We're we able to set the rules correctly?
				if(count($this->_field_data) == 0) {
					log_message('error', "Unable to find validation rules: ".$uri);

					return FALSE;
				}
			}

			$this->CI->lang->load('form_validation');

			// Cycle through the rules for each field, match the
			// corresponding $_POST item and test for errors
			foreach($this->_field_data as $field => $row) {
				// Fetch the data from the corresponding $_POST array and cache it in the _field_data array.
				// Depending on whether the field name is an array or a string will determine where we get it from.

				if($row['is_array']) {
					$this->_field_data[$field]['postdata'] = $this->_reduce_array($_POST, $row['keys']);
				}
				else {
					if(isset($_POST[$field]) AND $_POST[$field] != "") {
						$this->_field_data[$field]['postdata'] = $_POST[$field];
					}
				}

				$this->_execute($row, explode('|', $row['rules']), $this->_field_data[$field]['postdata']);
			}

			$total_errors = count($this->_error_array);

			if($total_errors > 0) $this->_safe_form_data = TRUE;

			$this->_reset_post_array();

			if($total_errors == 0) return TRUE;

			return FALSE;
		}
		
		function alpha_dash_space($str) {
			return (!preg_match("/^([-a-z0-9 _\-])+$/i", $str)) ? FALSE : TRUE;
		}

		function valid_date_str($date_str) {
			return strtotime($date_str);
		}

		function valid_url($url) {
			return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
		}
	}

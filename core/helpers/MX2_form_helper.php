<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	function form_open($action = '', $attributes = '', $hidden = array()) {
		$CI = &get_instance();

		if($attributes == '') $attributes = 'method="post"';

		// If an action is not a full URL then turn it into one
		if($action && strpos($action, '://') === FALSE) {
			$action = $CI->config->site_url($action);
		}

		// If no action is provided then set to the current url
		$action OR $action = $CI->config->site_url($CI->uri->uri_string());

		$form = '<form action="'.$action.'"'._attributes_to_string($attributes, TRUE).">\n";

		if(	config_item('csrf_protection') === TRUE &&
			!(strpos($action, base_url()) === FALSE OR strpos($form, 'method="get"')))
		{
			$hidden[$CI->security->get_csrf_token_name()] = $CI->security->get_csrf_hash();
		}

		if(is_array($hidden) && count($hidden) > 0) {
			$form .= sprintf('<div style="display:none;">%s</div>', form_hidden($hidden));
		}

		return $form;
	}

	function form_email($data = '', $value = '', $extra = '') {
		$defaults = array('type' => 'email', 'name' => ((!is_array($data)) ? $data : ''), 'value' => $value, );

		return "<input "._parse_form_attributes($data, $defaults).$extra." />";
	}

<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	function system_get_setting($name, $default=NULL) {
		$CI = &get_instance();

		$CI->load->model('settings/settings_model');

		$s = $CI->settings_model->$name;

		return !empty($s) ? $s : $default;
	}

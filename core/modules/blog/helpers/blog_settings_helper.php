<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	function all_settings() {
		
	}

	function blog_get_setting($name, $default=NULL) {
		$CI = &get_instance();

		$CI->load->model('blog/blog_settings_model');

		$s = $CI->blog_settings_model->get_setting($name);

		return !empty($s) ? $s : $default;
	}

	function save_settings($name, $value) {
		
	}

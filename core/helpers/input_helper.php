<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	function get_post($value, $xss_check=FALSE) {
		return get_instance()->input->get_post($value, $xss_check);
	}

	function is_ajax() {
		return get_instance()->input->is_ajax_request();
	}

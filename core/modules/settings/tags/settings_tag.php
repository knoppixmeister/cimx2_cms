<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Settings_Tag extends Tag {
		function __construct() {
			$this->load->model('settings/settings_model');
		}

		function __get($key) {
			$key = strtolower($key);

			if(empty($key)) return NULL;

			$s = $this->settings_model->get_by('name', $key);
			if(!empty($s)) return $s['value'];
			else return NULL;
		}
	}

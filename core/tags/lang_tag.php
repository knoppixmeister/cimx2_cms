<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Lang_Tag extends Tag {
		function __call($name, $params) {
			get_instance()->load->helper('language');

			$lang = $this->get_attribute("lang", config_item("default_language"));

			return lang($name, $lang);
		}

		function line() {
			$name = $this->get_attribute("name");
			$lang = $this->get_attribute("lang", config_item("default_language"));

			return lang($name, $lang);
		}
	}

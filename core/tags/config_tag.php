<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Config_Tag extends Tag {
		function load_config() {
			$file = $this->get_attribute('name');

			return get_instance()->load->config($file);
		}

		function item() {
			$name = $this->get_attribute('name');

			return config_item($name);
		}
	}

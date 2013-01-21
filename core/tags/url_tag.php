<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Url_Tag extends Tag {
		function __construct() {
			$this->load->helper('url');
		}

		function base_url() {
			return base_url();
		}

		function base_url_lang() {
			return base_url_lang();
		}

		function site_url() {
			$uri = $this->get_attribute('uri', '');

			return site_url($uri);
		}
	}

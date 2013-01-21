<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Ajax extends Ajax_Controller {
		function __construct() {
			parent::__construct();
		}

		function url_title() {
			$this->load->helper('url');

			$title = get_post('title', TRUE);

			e(strtolower(url_title($title, "underscore")));
		}
	}

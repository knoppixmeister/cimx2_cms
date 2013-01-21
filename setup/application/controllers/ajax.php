<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Ajax extends CI_Controller {
		function __construct() {
			parent::__construct();
		}

		function test_database() {
			echo json_encode(array('result' => TRUE, 'message' => 'DB connection status OK!'));
		}
	}

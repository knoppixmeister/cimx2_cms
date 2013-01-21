<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Hooks_model extends CI_Model {
		public $points = array(
							'pre_system', 
							'pre_controller', 
							'post_controller_constructor', 
							'post_controller', 
							'display_override', 
							'cache_override', 
							'post_system', 
						);

		function __construct() {
			parent::__construct();
		}

		function get_all() {
			require FCPATH.APPPATH."config/hooks.php";

			return $hook;
		}

		function get_by_type($type) {
			require FCPATH.APPPATH."config/hooks.php";

			return $hook[$type];
		}
	}

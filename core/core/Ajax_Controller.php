<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Ajax_Controller extends MX2_Controller {
		function __construct() {
			parent::__construct();

			if(!is_ajax()) redirect('');
		}
	}

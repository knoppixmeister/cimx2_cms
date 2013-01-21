<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Admin extends Admin_Auth_List_Controller {
		function __construct() {
			parent::__construct();
		}

		function index() {
			$this->data['title'] = "Home dashboard";

			$this->template->build('admin/admin/index', $this->data);
		}
	}

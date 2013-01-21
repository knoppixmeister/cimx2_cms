<?php
	

	class Admin extends Admin_Auth_List_Controller {
		function __construct() {
			parent::__construct();
		}

		function index() {

			$this->template->build('acl/admin/index', $this->data);
		}
	}

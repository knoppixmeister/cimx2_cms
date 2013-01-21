<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Admin extends Admin_Auth_List_Controller {
		function __construct() {
			parent::__construct();
		}

		function _list($page=1) {
			$this->data['title'] = "Comments";

			parent::_list($page, FALSE, 10);
			
			$this->template->build('comments/admin/index', $this->data);
		}
	}

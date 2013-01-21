<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Frontend_List_Controller extends Frontend_Controller {
		function __construct() {
			parent::__construct();
		}

		function index() {
			$this->_list(1);
		}

		protected function _list($page=1, $do_output=TRUE, $per_page=2, $load_model=TRUE) {
			$this->data['page'] 	= max(1, (int)$page);
			$this->data['per_page'] = $per_page;

			$mod_name = $this->data['module']."_model";

			if($load_model)	$this->load->model($mod_name);

			$this->data['items'] = $this->$mod_name->order_by('id', 'DESC')
													->limit(
														$this->data['per_page'],
														$this->data['per_page']*$this->data['page']-$this->data['per_page']
													)
													->get_all();

			if($this->data['page'] > 1 && count($this->data['items']) == 0) show_404();

			$this->data['items_count'] = $this->$mod_name->count_all();

			$this->data['path'] = $this->data['module'];

			if($do_output) $this->template->build($this->data['module'].'/index', $this->data);
		}

		protected function _edit($id=NULL, $action="edit") {
			
			
			$this->template->build($this->data['module']."/edit", $this->data);
		}

		function edit() {
			$this->_edit(NULL, 'edit');
		}

		function add() {
			$this->_edit(NULL, 'add');
		}

		function create() {
			$this->_edit(NULL, 'add');
		}

		function page($page=NULL) {
			if(!is_numeric($page)) redirect($this->data['module']);

			$this->_list($page);
		}
	}

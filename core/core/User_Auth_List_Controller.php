<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class User_Auth_List_Controller extends User_Auth_Controller {
		function __construct() {
			parent::__construct();
		}

		function index() {
			$this->_list(1);
		}

		function page($page=1) {
			if(!is_numeric($page)) redirect(site_url($this->data['module']));

			$this->_list($page);
		}

		protected function _list($page=1, $do_output=TRUE, $per_page=30, $load_model=TRUE) {
			$this->data['page'] 	= max(1, (int)$page);
			$this->data['per_page'] = $per_page;

			$mod_name = $this->data['module']."_model";

			if($load_model) {
				$this->load->model($mod_name);

				$this->data['items'] = $this->$mod_name->order_by('id', 'DESC')
														->limit(
															$this->data['per_page'], 
															$this->data['per_page']*$this->data['page']-$this->data['per_page'] 
														)
														->get_all();

				if($this->data['page'] > 1 && count($this->data['items']) == 0) show_404();

				$this->data['items_count'] = $this->$mod_name->count_all();
			}

			if($do_output) $this->template->build($this->data['module'].'/index', $this->data);
		}

		protected function _edit($id=NULL, $action="edit") {
			if(get_post('cancel')) redirect($this->data['module']);

			$this->data['action'] = strtolower($action);
			if($this->data['action'] == "edit") {
				$this->data['action_url'] = site_url($this->data['module']."/edit/".$id);

				$mod_name = $this->data['module']."_model";

				$this->data['item'] = $this->$mod_name->get($id);

				if(empty($this->data['item'])) redirect($this->data['module']);
			}
			else $this->data['action_url'] = site_url($this->data['module']."/create");
		}

		function add() {
			$this->_edit(NULL, 'add');
		}

		function create() {
			$this->_edit(NULL, 'add');
		}

		function edit($id=NULL) {
			if(!is_numeric($id)) redirect($this->data['controller']);

			$this->_edit($id, 'edit');
		}

		function delete($id=NULL) {
			$mod_name = $this->data['module']."_model";

			$this->data['items'] = $this->$mod_name->delete($id);

			redirect($this->data['module']);
		}
	}

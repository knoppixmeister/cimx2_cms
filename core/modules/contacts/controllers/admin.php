<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Admin extends Admin_Auth_List_Controller {
		function __construct() {
			parent::__construct();
		}

		function _list($page=1) {
			if(get_post('delete')) {
				foreach(get_post('items') as $i) {
					if(is_numeric($i)) $this->contacts_model->delete($i);
				}

				redirect(admin_url('contacts'));
			}

			$this->data['page'] = max(1, (int)$page);

			$this->data['per_page'] = 10;

			$this->data['items'] 		= $this->contacts_model->order_by('id', 'DESC')
																->limit(
																	$this->data['per_page'], 
																	$this->data['page']*$this->data['per_page']-$this->data['per_page'] 
																)
																->get_all();

			if($this->data['page'] > 1 && empty($this->data['items'])) show_404();

			$this->data['items_count'] 	= $this->contacts_model->count_all();

			$this->data['title'] = "Contacts";

			$this->template->build('contacts/admin/index', $this->data);
		}

		function view($id=NULL) {
			$this->data['title'] = "Contact details";

			parent::_edit($id, 'edit');

			$this->template->build('contacts/admin/edit', $this->data);
		}
	}

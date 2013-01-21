<?php
	defined('BASEPATH') || exit('No direct script access allowed');	

	class Users_roles extends Admin_Auth_List_Controller {
		function __construct() {
			parent::__construct();
		}

		function _list($page=1) {
			$this->data['title']	=	"User roles";

			$this->data['page']		=	max(1, (int)$page);
			$this->data['per_page']	=	30;

			$mod_name = "roles_model";

			$this->data['items'] = $this->$mod_name->order_by('id', 'DESC')
													->limit(
														$this->data['per_page'], 
														$this->data['per_page']*$this->data['page']-$this->data['per_page'] 
													)
													->get_all();

			if($this->data['page'] > 1 && count($this->data['items']) == 0) show_404();

			$this->data['items_count'] = $this->$mod_name->count_all();

			$this->template->build('users/admin/roles/index', $this->data);
		}

		function _edit($id=NULL, $action="edit") {
			if(get_post('cancel')) redirect(admin_url('users/roles', TRUE));

			$mod_name = "roles_model";

			$this->data['action'] = strtolower($action);
			if($this->data['action'] == "edit") {
				$this->data['action_url'] = admin_url("users/roles/edit/".$id, TRUE);

				$this->data['item'] = $this->$mod_name->get($id);

				if(empty($this->data['item'])) redirect(admin_url('users/roles', TRUE));
			}
			else $this->data['action_url'] = admin_url("users/roles/create", TRUE);

			if(!$this->form_validation->run('users_roles/_edit')) {
				$this->data['title'] = "User roles. ".ucfirst($action)." role";
				
				$this->template->build('users/admin/roles/edit', $this->data);
			}
			else {
				$data = array(
							'name'			=> get_post('name'), 
							'description'	=> get_post('description'), 
						);

				if($this->data['action'] == "add") $id = $this->$mod_name->insert($data, TRUE);
				else $this->$mod_name->update($id, $data, TRUE);

				$this->session->set_flashdata('success_msg', "Data saved");

				if(get_post('save_exit')) redirect(admin_url('users/roles'));
				else redirect(admin_url('users/roles/edit/'.$id));
			}
		}

		function delete($id=NULL) {
			if(is_numeric($id) && $id > 2) {
				$this->users_model->delete_by('role_id', $id);

				$this->roles_model->delete($id);
			}

			redirect(admin_url('users/roles', TRUE));
		}
	}

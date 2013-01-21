<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Admin extends Admin_Auth_List_Controller {
		function __construct() {
			parent::__construct();
		}

		function _list($page=1) {
			$this->data['title'] = "Users";

			parent::_list(1);
		}
		
		function _edit($id=NULL, $action="edit") {
			parent::_edit($id, $action);

			$config = array(
						array(
							'field' =>	'first_name', 
							'label'	=>	'First Name', 
							'rules'	=>	'required|trim|max_length[255]', 
						), 
						array(
							'field' =>	'last_name', 
							'label'	=>	'Last Name', 
							'rules'	=>	'required|trim|max_length[255]', 
						), 
						array(
							'field' =>	'username', 
							'label'	=>	'Username', 
							'rules'	=>	'required|trim|strtolower|alpha_dash', 
						), 
						array(
							'field' =>	'email', 
							'label'	=>	'E-mail', 
							'rules'	=>	'required|trim|strtolower|valid_email', 
						), 
						array(
							'field' =>	'role', 
							'label'	=>	'Role', 
							'rules'	=>	'required|numeric', 
						), 
						array(
							'field' =>	'status', 
							'label'	=>	'Status', 
							'rules'	=>	'required|trim', 
						), 
					);

			$add_password_rules = 	array(
										array(
											'field' =>	'password', 
											'label'	=>	'Password', 
											'rules'	=>	'required|trim', 
										),
										array(
											'field' =>	'confirm_password', 
											'label'	=>	'Confirm Password', 
											'rules'	=>	'required|trim|matches[password]', 
										), 
									);

			$edit_password_rules = 	array(
										array(
											'field' =>	'password', 
											'label'	=>	'Password', 
											'rules'	=>	'trim|matches[confirm_password]', 
										), 
										array(
											'field' =>	'confirm_password', 
											'label'	=>	'Confirm Password', 
											'rules'	=>	'trim|matches[password]', 
										), 
									);

			if($action == "add") $config = array_merge($config, $add_password_rules);
			elseif($action == "edit") $config = array_merge($config, $edit_password_rules);

			$this->form_validation->set_rules($config);

			if(!$this->form_validation->run()) {
				$this->data['title'] = "Edit user";
				
				$this->data['roles'] = array('' => '', );
				foreach($this->roles_model->get_all() as $g) {
					$this->data['roles'][$g['id']] = $g['description'];
				}

				$this->template->build('users/admin/edit', $this->data);
			}
			else {
				$data = array(
							'first_name'	=>	get_post('first_name'), 
							'last_name' 	=>	get_post('last_name'), 
							'username' 		=>	get_post('username'), 
							'email' 		=>	get_post('email'), 
							'role_id'		=>	get_post('role'), 
							'status'		=>	get_post('status'), 
						);

				if($this->data['action'] == "add") {
					$data['created_time'] 	= time();
					$data['password'] 		= md5(get_post('password'));

					$id = $this->users_model->insert($data, TRUE);

					if($id) Events::trigger('user_created', $data);
				}
				else {
					$pwd = get_post('password');

					if(!empty($pwd)) $data['password'] = md5($pwd);

					$this->users_model->update($id, $data, TRUE);
				}

				$this->session->set_flashdata('success_msg', "Data saved");

				if(get_post('save_exit')) redirect(admin_url('users'));
				else redirect(admin_url('users/edit/'.$id));
			}
		}

		function delete($id=NULL) {
			if(is_numeric($id)) {
				if($this->data['user']['id'] == $id) $this->session->set_flashdata('error_msg', 'Could not delete yourself');
				else $this->users_model->delete($id);
			}

			redirect(admin_url('users', TRUE));
		}
	}

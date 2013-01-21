<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Admin extends Admin_Auth_List_Controller {
		function __construct() {
			parent::__construct();
		}

		function _list($page=1) {
			$this->data['title'] = "Letter templates";

			parent::_list($page);
		}

		function _edit($id=NULL, $action="edit") {
			parent::_edit($id, $action);

			$this->form_validation->set_rules('name',		'Name',			'required|trim|xss_clean');
			$this->form_validation->set_rules('slug', 		'Slug', 		'required|trim|strtolower|alpha_dash');
			$this->form_validation->set_rules('language', 	'Language', 	'required|trim|strtolower|alpha_dash');

			$this->form_validation->set_rules('subject', 	'Subject',		'');
			$this->form_validation->set_rules('body',		'Body',			'');

			if(!$this->form_validation->run()) {
				$this->data['title'] = ucfirst($this->data['action'])." letter template";

				$this->data['languages'] = array('' => '', );
				foreach(config_item('supported_languages') as $k => $v) {
					$this->data['languages'][$k] = $v['name'];
				}

				$this->template->enable_body_parser(FALSE)
								->build('letter_templates/admin/edit', $this->data);
			}
			else {
				$data = array(
							'name'			=>	get_post('name', TRUE), 
							'slug'			=>	get_post('slug', TRUE), 
							'language'		=>	get_post('language', TRUE), 
							'description'	=>	get_post('description', TRUE), 
							'subject'		=>	get_post('subject', TRUE), 
							'body'			=>	get_post('body', TRUE), 
							'modified_by'	=>	$this->data['user']['id'], 
							'modified_time'	=>	time(), 
						);

				if($this->data['action'] == "add") {
					$data['created_by']		= $this->data['user']['id'];
					$data['created_time'] 	= time();

					$id = $this->letter_templates_model->insert($data, TRUE);
				}
				else $this->letter_templates_model->update($id, $data, TRUE);

				$this->session->set_flashdata('success_msg', "Data saved");

				if(get_post('save_exit')) redirect(admin_url($this->data['module'])); 
				else redirect(admin_url($this->data['module']."/edit/".$id));
			}
		}
	}

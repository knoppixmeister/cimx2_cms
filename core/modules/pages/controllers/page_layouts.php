<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Page_layouts extends Admin_Auth_List_Controller {
		function __construct() {
			parent::__construct();

			$this->load->model('themes/themes_model');
		}

		function _list($page=1) {
			$this->data['page'] 	= max(1, (int)$page);
			$this->data['per_page'] = 30;

			$mod_name = "page_layouts_model";

			$this->load->model($mod_name);

			$this->data['items'] = $this->$mod_name->order_by('id', 'DESC')
													->limit(
														$this->data['per_page'],
														$this->data['per_page']*$this->data['page']-$this->data['per_page']
													)
													->get_all();

			if($this->data['page'] > 1 && count($this->data['items']) == 0) show_404();

			$this->data['items_count'] = $this->$mod_name->count_all();

			$this->data['title'] = "Pages layouts";

			$this->template->build('pages/admin/layouts/index', $this->data);
		}

		function _edit($id=NULL, $action="edit") {
			if(get_post('cancel')) redirect(admin_url('pages/layouts'));

			$mod_name = "page_layouts_model";

			$this->data['action'] = strtolower($action);
			if($this->data['action'] == "edit") {
				$this->data['action_url'] = admin_url('pages/layouts/edit/'.$id);

				$this->data['item'] = $this->$mod_name->get($id);

				if(empty($this->data['item'])) redirect(admin_url('pages/layouts'));
				
				$this->data['title'] = "Edit page layout";
			}
			else {
				$this->data['title'] = "Create page layout";
				
				$this->data['action_url'] = admin_url('pages/layouts/create');
			}

			$this->form_validation->set_rules('title',	'Title',		'required|trim|xss_clean');
			$this->form_validation->set_rules('theme',	'Theme',		'required|trim|alpha_dash');
			$this->form_validation->set_rules('layout',	'Layout file',	'required|trim');

			if(!$this->form_validation->run()) {
				//$t = $this->themes_model->get_by('is_default', DB_TRUE);

				$t = element('value', $this->settings_model->get_by('name', 'frontend_theme'));

				$this->data['themes'] = array($t => $t, );

				$this->data['layouts'] = array('' => '', );
				foreach($this->themes_model->get_layouts($t) as $l) {
					$this->data['layouts'][$l] = $l;
				}

				$this->template->enable_body_parser(FALSE)
								->build($this->data['module'].'/admin/layouts/edit', $this->data);
			}
			else {
				$data = array(
							'title'			=>	get_post('title', TRUE), 
							'theme' 		=>	get_post('theme', TRUE), 
							'layout_file' 	=>	get_post('layout'), 
							'content'		=>	get_post('content', TRUE), 
						);

				if($this->data['action'] == "add") $id = $this->$mod_name->insert($data, TRUE);
				else $this->$mod_name->update($id, $data, TRUE);

				$this->session->set_flashdata('success_msg', "Data saved");

				if(get_post('save_exit')) redirect(admin_url('pages/layouts'));
				else redirect(admin_url('pages/layouts/edit/'.$id));
			}
		}

		function delete($id=NULL) {
			$this->page_layouts_model->delete($id);

			redirect(admin_url('pages/layouts'));
		}
	}

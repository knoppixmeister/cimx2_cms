<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Admin extends Admin_Auth_List_Controller {
		function __construct() {
			parent::__construct();
		}

		function index() {
			$this->data['title']			= "Modules";

			$this->data['user_modules'] 	= $this->modules_model->get_all('user');
			$this->data['system_modules'] 	= $this->modules_model->get_all('system');

			$this->template->build('modules/admin/index', $this->data);
		}

		function upload() {
			if(get_post('cancel')) redirect(admin_url('modules', TRUE));

			$config['upload_path']		=	FCPATH.'public/uploads/modules/';

			if(!file_exists($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);

			$config['allowed_types'] 	=	'zip';
			$config['overwrite']		=	TRUE;

			$this->upload->initialize($config);

			if(!$this->upload->do_upload('module')) {
				$this->data['title'] = "Upload module";
				
				if($_FILES) $this->data['upload_errors'] = $this->upload->display_errors();

				$this->template->build('modules/admin/upload', $this->data);
			}
			else {
				$upload_data = $this->upload->data();

				if($this->modules_model->deploy($upload_data['full_path'], FCPATH.EXTPATH."modules/")) {
					$this->session->set_flashdata('success_msg', 'Module uploaded and deployed');
				}
				else $this->session->set_flashdata('error_msg', 'Module has not been uploaded');

				redirect(admin_url('modules', TRUE));
			}
		}

		function install($slug=NULL) {
			if($this->modules_model->install($slug)) {
				$this->session->set_flashdata('success_msg', 'Module installed!');
			}
			else $this->session->set_flashdata('error_msg', 'Module has not been istalled!');

			redirect(admin_url('modules', TRUE));
		}

		function uninstall($slug=NULL) {
			if($this->modules_model->uninstall($slug)) {
				$this->session->set_flashdata('success_msg', 'Module uninstalled!');
			}
			else $this->session->set_flashdata('error_msg', 'Module has not been unistalled!');

			redirect(admin_url('modules', TRUE));
		}

		function enable($slug=NULL) {
			if($this->modules_model->enable($slug)) {
				$this->session->set_flashdata('success_msg', 'Module enabled!');
			}
			else $this->session->set_flashdata('error_msg', 'Module has not been enabled!');

			redirect(admin_url('modules', TRUE));
		}

		function disable($slug=NULL) {
			if($this->modules_model->enable($slug, FALSE)) {
				$this->session->set_flashdata('success_msg', 'Module disabled!');
			}
			else $this->session->set_flashdata('error_msg', 'Module has not been disabled!');
			
			redirect(admin_url('modules', TRUE));
		}

		function undeploy($slug) {
			if($this->modules_model->undeploy($slug)) {
				$this->session->set_flashdata('success_msg', 'Module undeployed!');
			}
			else $this->session->set_flashdata('error_msg', 'Module has not been undeployed!');

			redirect(admin_url('modules', TRUE));
		}
	}

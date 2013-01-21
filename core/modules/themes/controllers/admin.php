<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Admin extends Admin_Auth_List_Controller {
		function __construct() {
			parent::__construct();
		}

		function _list($page=1) {
			$this->data['title'] = "Themes";

			$this->data['frontend_themes'] 	= $this->themes_model->get_all('frontend');
			$this->data['admin_themes'] 	= $this->themes_model->get_all('admin');

			$this->template->build('themes/admin/index', $this->data);
		}

		function set_frontend_default() {
			$theme =  get_post('theme');

			if(empty($theme)) redirect(admin_url('themes', TRUE));

			$s = $this->settings_model->get_by('name', 'frontend_theme');
			
			if(!empty($s)) $this->settings_model->update_by(array('name' => 'frontend_theme', ), array('value' => $theme, ));
			else {
				$this->settings_model->insert(
											array(
												'name'	=>	'frontend_theme', 
												'value'	=>	$theme, 
											), 
											TRUE 
										);
			}

			$this->session->set_flashdata('success_msg', 'Theme "'.$theme.'" set as default for frontend');

			redirect(admin_url('themes', TRUE));
		}

		function set_admin_default() {
			$theme =  get_post('theme');

			if(empty($theme)) redirect(admin_url('themes', TRUE));

			$s = $this->settings_model->get_by('name', 'admin_theme');

			if(!empty($s)) $this->settings_model->update_by(array('name' => 'admin_theme', ), array('value' => $theme, ));
			else {
				$this->settings_model->insert(
											array(
												'name'	=>	'admin_theme', 
												'value'	=>	$theme, 
											), 
											TRUE 
				);
			}

			$this->session->set_flashdata('success_msg', 'Theme "'.get_post('theme').'" set as default for admin panel');

			redirect(admin_url('themes', TRUE));
		}

		function delete($slug=NULL) {
			if($this->themes_model->delete($slug)) {
				$this->session->set_flashdata('success_msg', 'Theme "'.$slug.'" deleted');
			}
			else $this->session->set_flashdata('error_msg', 'Theme "'.$slug.' has not been deleted');

			redirect(admin_url('themes', TRUE));
		}

		function upload() {
			if(get_post('cancel')) redirect(admin_url('themes'));

			$config['upload_path'] 		= FCPATH.'public/uploads/themes/';

			if(!file_exists($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);

			$config['allowed_types'] 	= 'zip';
			$config['overwrite']		= TRUE;

			$this->upload->initialize($config);

			if(!$this->upload->do_upload('theme')) {
				$this->data['title'] = "Theme upload";

				if($_FILES) $this->data['upload_errors'] = $this->upload->display_errors();

				$this->template->build('themes/admin/upload', $this->data);
			}
			else {
				$upload_data = $this->upload->data();

				$this->themes_model->deploy($upload_data['full_path'], FCPATH.EXTPATH."themes");

				$this->session->set_flashdata('success_msg', 'Theme uploaded and deployed');

				redirect(admin_url('themes', TRUE));
			}
		}
	}

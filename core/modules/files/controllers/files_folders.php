<?php
	defined('BASEPATH') || exit('No direct script access allowed');

	class Files_folders extends Admin_Auth_List_Controller {
		function __construct() {
			parent::__construct();
		}

		function index() {
			$this->data['items'] = $this->files_folders_model->get_folders_tree();

			$this->template->build('files/admin/folders/index', $this->data);
		}

		function _edit($id=NULL, $action="edit") {
			if($action == "edit") $this->data['item'] = $this->files_folders_model->get($id);

			if(!is_ajax() && !$this->form_validation->run('file_folders/_edit')) {
				if($action == "add") $this->data['title'] = "Files. Create folder.";

				$this->files_folders_model->get_folders_options_tree(0, 2);

				$this->data['parent_folders'] = $this->files_folders_model->_folders_options_tree;

				$this->template->build('files/admin/folders/edit', $this->data);
			}
			else {
				$data = array(
							'parent_id'	=>	get_post('parent'), 
							'slug'		=>	url_title(get_post('name')), 
							'name'		=>	get_post('name'), 
						);

				if($action == "add") {
					$id = $this->files_folders_model->insert($data, TRUE);

					if(!is_ajax()) $this->session->set_flashdata('success_msg', 'Folder created');
				}
				else {
					$this->files_folders_model->update($id, $data, TRUE);

					if(!is_ajax()) $this->session->set_flashdata('success_msg', 'Folder data edited');
				}

				if(!is_ajax()) {
					if(get_post('save')) redirect(admin_url('files/folders/edit/'.$id));
					elseif(get_post('save_exit')) redirect(admin_url('files/folders/content/'.$this->data['item']['parent_id']));

				}
				else {
					header('Content-Type: application/json');

					e(json_encode(array("status" => "success", "message" => "Folder created.", )));
				}
			}
		}

		function content($id=NULL) {
			if(!is_numeric($id)) $id = 0;

			if($id > 0) $this->data['folder'] = $this->files_folders_model->get($id);
			else {
				$this->data['folder'] = array(
											'id' 		=>	0, 
											'parent_id'	=>	-1, 
											'name' 		=>	'/', 
											'slug'		=>	'/', 
										);
			}

			if(empty($this->data['folder'])) show_404();

			if(get_post('delete')) {
				$files = get_post('files');
				if(empty($files)) $files = array();

				foreach($files as $f) {
					if(is_numeric($f)) $this->files_model->delete($f);
				}

				$folders = get_post('folders');
				if(empty($folders)) $folders = array();
				foreach($folders as $f) {
					if(is_numeric($f)) $this->files_folders_model->delete($f);
				}

				redirect(admin_url('files/folders/content/'.$id));
			}

			$this->data['parents'] = $this->files_folders_model->get_folder_parents($id);

			$this->data['items'] = $this->files_folders_model->folder_content_by_id($id);

			$this->data['title'] = "Files. Folder content";
			
			$this->template->build('files/admin/folders/content', $this->data);
		}

		function delete($id=NULL) {
			$this->files_folders_model->delete($id);

			redirect(admin_url('files'));
		}

		function add_subfolder($parent_id=NULL) {
			
			
			$this->template->build('files/admin/folders/edit', $this->data);
		}
	}
